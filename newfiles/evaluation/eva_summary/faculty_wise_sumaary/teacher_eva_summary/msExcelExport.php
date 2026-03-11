<?php
ob_start();
$evl_id = $_REQUEST['evl_id'];
$teacher_id = $_REQUEST['sel_faculty_id'];   // here faculty = teacher

require_once '../../../../../libraries/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
include '../../../../conn.php';
include "../../../../common.php";

/*--------------------------------------------------------------
   CHECK IF ANY RECORD EXISTS FOR THIS TEACHER
--------------------------------------------------------------*/
$eval_count = mysqli_query($conn, "
    SELECT es.*
    FROM kiusc_eval_std es
    LEFT JOIN kiusc_course_offered co ON co.id = es.c_offer_id
    WHERE es.eval_id = '$evl_id'
      AND es.eval_type_id = 1
      AND co.fac_id = '$teacher_id'
");

if (mysqli_num_rows($eval_count) == 0) {
    echo '<font color=red>No record found for this Teacher.</font>';
    return;
}

/*--------------------------------------------------------------
   LOAD TEMPLATE
--------------------------------------------------------------*/
$objPHPExcel = PHPExcel_IOFactory::load("TeacherEvalReport.xlsx");

/*--------------------------------------------------------------
   GET SEMESTER NAME
--------------------------------------------------------------*/
$sem = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT s.* 
    FROM kiusc_evaluation e 
    JOIN kiusc_semesters s ON s.id = e.sem_id 
    WHERE e.id = '$evl_id'
"));
$semester = $sem['sem_name'];

$name_for_download = "Teacher Evaluation Report - " . $semester;

/*--------------------------------------------------------------
   GET TEACHER INFORMATION
--------------------------------------------------------------*/
$teacher = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT first_name, last_name, user_id
    FROM kiusc_employees
    WHERE user_id = '$teacher_id'
      AND is_active = 1
"));

$teacher_fullname = $teacher['first_name'] . " " . $teacher['last_name'];

/*--------------------------------------------------------------
   GET TEACHER COURSES
--------------------------------------------------------------*/
$courses = mysqli_query($conn, "
    SELECT cf.*
    FROM kiusc_course_offered cf
    JOIN kiusc_evaluation e ON cf.sem_id = e.sem_id
    WHERE cf.fac_id = '$teacher_id'
      AND e.id = '$evl_id'
      AND cf.eva_cat_id != 5
");

/*--------------------------------------------------------------
   CREATE SHEET FOR TEACHER
--------------------------------------------------------------*/
$sheet_template = $objPHPExcel->getActiveSheet()->copy();
$sheet_teacher = clone $sheet_template;

$sheet_title = strlen($teacher_fullname) > 31
    ? substr($teacher_fullname, 0, 28) . "..."
    : $teacher_fullname;

$sheet_teacher->setTitle($sheet_title);
$objPHPExcel->addSheet($sheet_teacher);

$objPHPExcel->setActiveSheetIndex(1);
$sheet = $objPHPExcel->getActiveSheet();

/*--------------------------------------------------------------
   HEADER
--------------------------------------------------------------*/
$sheet->setCellValue('C2', $teacher_fullname);
$sheet->setCellValue('A4',
    "The Evaluation Report for Semester ($semester) is prepared based on student feedback."
);

/*--------------------------------------------------------------
   LOAD CATEGORY HEADERS
--------------------------------------------------------------*/
$category_headers = mysqli_query($conn, "
    SELECT * 
    FROM kiusc_eval_ques_category 
    WHERE eval_type_id = 1 AND active = 1
");

$category_scores = [];
$category_questions = [];

$row_header = 7;  
$col = 3;         

while ($cat = mysqli_fetch_assoc($category_headers)) {
    $short = $cat['shortnmae'];
    $category_scores[$short] = 0;
    $category_questions[$short] = 0;
    $sheet->setCellValueByColumnAndRow($col++, $row_header, $short);
}

/* extra columns */
$sheet->setCellValueByColumnAndRow($col, $row_header, "T.Score");
$sheet->setCellValueByColumnAndRow($col+1, $row_header, "TS");
$sheet->setCellValueByColumnAndRow($col+2, $row_header, "SPT");

$row = 8;
$sno = 1;

$total_overall_percentage = 0;
$total_participation = 0;
$valid_courses = 0;

$english_total = 0;
$english_count = 0;

/*--------------------------------------------------------------
   PROCESS EACH COURSE
--------------------------------------------------------------*/
while ($co = mysqli_fetch_assoc($courses)) {

    $course_name = mysqli_fetch_assoc(mysqli_query($conn, "
        SELECT name 
        FROM kiusc_courses c
        JOIN kiusc_course_offered cf ON c.id = cf.course_id
        WHERE cf.id = '".$co['id']."'
    "));

    $program = mysqli_fetch_assoc(mysqli_query($conn, "
        SELECT name, session_name, `group` 
        FROM kiusc_programs 
        WHERE id = '".$co['prog_id']."'
    "));

    /* RESET CATEGORY COUNTS */
    foreach ($category_scores as $c => $v) {
        $category_scores[$c] = 0;
        $category_questions[$c] = 0;
    }

    /* FETCH ANSWERS */
    $answers = mysqli_query($conn, "
        SELECT es.ans, eqc.shortnmae
        FROM kiusc_eval_std es
        JOIN kiusc_eval_questions eq ON es.question_id = eq.id
        JOIN kiusc_eval_ques_category eqc ON eqc.id = eq.cat_id
        WHERE eqc.eval_type_id = 1
          AND es.c_offer_id = '".$co['id']."'
    ");

    while ($ans = mysqli_fetch_assoc($answers)) {
        $cat = $ans['shortnmae'];
        $category_scores[$cat] += $ans['ans'];
        $category_questions[$cat]++;
    }

    /* CALCULATE CATEGORY % */
    $total_cat_percentage = 0;
    $col = 0;

    /* S.No, Course, Program */
    $sheet->setCellValueByColumnAndRow($col++, $row, $sno);
    $sheet->setCellValueByColumnAndRow($col++, $row, $course_name['name']);
    $sheet->setCellValueByColumnAndRow(
        $col++, $row,
        $program['name']." (".$program['session_name'].") ".$program['group']
    );

    foreach ($category_scores as $cat => $score) {

        if ($category_questions[$cat] == 0) $category_questions[$cat] = 1;

        $percentage = round(($score / ($category_questions[$cat]*3))*100, 2);
        $total_cat_percentage += $percentage;

        if ($cat == "EMI") {
            $english_total += $percentage;
            $english_count++;
        }

        $sheet->setCellValueByColumnAndRow($col++, $row, $percentage);
    }

    /* OVERALL SCORE */
    $overall = round($total_cat_percentage / count($category_scores), 2);

    /* STUDENTS */
    $ttl_reg = mysqli_num_rows(mysqli_query($conn,"
        SELECT * FROM kiusc_results WHERE c_offer_id='".$co['id']."'
    "));
    $ttl_eval = mysqli_num_rows(mysqli_query($conn,"
        SELECT DISTINCT std_id FROM kiusc_eval_std WHERE c_offer_id='".$co['id']."'
    "));

    $participation = round(($ttl_eval / $ttl_reg)*100, 2);

    $sheet->setCellValueByColumnAndRow($col,   $row, $overall);
    $sheet->setCellValueByColumnAndRow($col+1, $row, $ttl_reg);
    $sheet->setCellValueByColumnAndRow($col+2, $row, $participation);

    /* TOTALS */
    $total_overall_percentage += $overall;
    $total_participation += $participation;
    $valid_courses++;

    $row++;
    $sno++;
}

/*--------------------------------------------------------------
   SUMMARY
--------------------------------------------------------------*/
$final_overall = round($total_overall_percentage / $valid_courses, 2);
$final_participation = round($total_participation / $valid_courses, 2);
$english_avg = $english_count > 0 ? round($english_total / $english_count, 2) : 0;

/* Rating */
$rating = "";
if ($final_overall < 50) $rating = "Needs Improvement (NIP)";
elseif ($final_overall < 60) $rating = "Satisfactory (SF)";
elseif ($final_overall < 70) $rating = "Good (G)";
elseif ($final_overall < 80) $rating = "Very Good (VG)";
elseif ($final_overall < 85) $rating = "Excellent (EXL)";
else $rating = "Exceptional (EXP)";

$sheet->setCellValue('A20', 'Comprehensive Teaching Proficiency');
$sheet->setCellValue('D20', $final_overall . " % ($rating)");

$sheet->setCellValue('A21', 'English as Medium of Instruction');
$sheet->setCellValue('D21', $english_avg . " %");

$sheet->setCellValue('A22', 'Student Participation Level');
$sheet->setCellValue('D22', $final_participation . " %");


/*--------------------------------------------------------------
   OUTPUT FILE
--------------------------------------------------------------*/
header("Content-Disposition: attachment; filename=$name_for_download.xlsx");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');
?>
