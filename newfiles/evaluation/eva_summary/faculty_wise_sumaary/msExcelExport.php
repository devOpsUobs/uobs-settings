<?php 
ob_start();

$evl_id = $_REQUEST['evl_id'];
$faculty_id = $_REQUEST['sel_faculty_id'];   // NEW (faculty wise)

// excel + db
require_once '../../../../libraries/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
include '../../../conn.php';
include "../../../common.php";

// CHECK RECORDS FOR THIS FACULTY (NEW)
$eval_count = mysqli_query($conn, "
    SELECT es.* 
    FROM kiusc_eval_std es
    LEFT JOIN kiusc_course_offered co ON co.id = es.c_offer_id
    WHERE es.eval_id = '$evl_id'
      AND es.eval_type_id = 1
      AND co.fac_id = '$faculty_id'
");

if (mysqli_num_rows($eval_count) == 0) {
    echo '<font color=red>No evaluation record found for this Faculty.</font>';
    return;
}

$objPHPExcel = PHPExcel_IOFactory::load("TeacherEvalReport.xlsx");

// semester info
$sem = mysqli_query($conn, "
    SELECT s.* 
    FROM kiusc_evaluation e
    JOIN kiusc_semesters s ON s.id = e.sem_id 
    WHERE e.id = '$evl_id'
");
$sem = mysqli_fetch_assoc($sem);
$semester = $sem['sem_name'];


// GET FACULTY info (NEW)
$faculty = mysqli_query($conn, "
    SELECT first_name, last_name, user_id 
    FROM kiusc_employees 
    WHERE user_id = '$faculty_id'
      AND is_active = 1
");

$faculty = mysqli_fetch_assoc($faculty);
if (!$faculty) {
    echo "<font color=red>Faculty not found.</font>";
    return;
}

$name_for_download = 'Teacher Evaluation Report - ' . $semester;

$i = 0;

// Only ONE faculty – generate one sheet
$eval_count_fac = mysqli_query($conn, "
    SELECT es.* 
    FROM kiusc_eval_std es
    LEFT JOIN kiusc_course_offered co ON co.id = es.c_offer_id
    WHERE es.eval_id = '$evl_id'
      AND es.eval_type_id = 1
      AND co.fac_id = '$faculty_id'
");

if (mysqli_num_rows($eval_count_fac) > 0) {

    $courses = mysqli_query($conn, "
        SELECT cf.* 
        FROM kiusc_course_offered cf
        JOIN kiusc_evaluation e ON cf.sem_id = e.sem_id
        WHERE cf.fac_id = '$faculty_id'
          AND e.id = '$evl_id'
          AND cf.eva_cat_id != 5
    ");

    if (mysqli_num_rows($courses) > 0) {

        $i++;

        // Duplicate Template Sheet
        $sheet1 = $objPHPExcel->getActiveSheet()->copy();
        $sheet2 = clone $sheet1;

        $fac_name = $faculty['first_name'].' '.$faculty['last_name'];
        if (strlen($fac_name) > 31) {
            $fac_name = substr($fac_name, 0, 28) . '...';
        }

        $sheet2->setTitle($fac_name);
        $objPHPExcel->addSheet($sheet2);
        unset($sheet1);
        unset($sheet2);

        $objPHPExcel->setActiveSheetIndex($i);
        $objPHPExcel->getActiveSheet()->setCellValue('C2', $fac_name);
        $objPHPExcel->getActiveSheet()->setCellValue('A4',
            "The Quality Enhancement Cell, University of Baltistan, Skardu hereby acknowledges your services. " .
            "Your Evaluation report of Semester ($semester) has been prepared under student evaluation data."
        );

        // CATEGORY HEADERS
        $category_headers = mysqli_query($conn, "
            SELECT * 
            FROM kiusc_eval_ques_category 
            WHERE eval_type_id = 1 AND active = 1
        ");

        $category_scores = [];
        $category_questions = [];

        $headerRow = 7;
        $col = 3;

        while ($header = mysqli_fetch_assoc($category_headers)) {
            $short = $header['shortnmae'];
            $category_scores[$short] = 0;
            $category_questions[$short] = 0;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col++, $headerRow, $short);
        }

        // Additional Columns
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $headerRow, "T.Score");
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 1, $headerRow, "TS");
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 2, $headerRow, "SPT");

        $row = 8;
        $sno = 1;

        $total_overall = 0;
        $valid_courses = 0;
        $total_students = 0;
        $total_participated = 0;

        while ($co = mysqli_fetch_assoc($courses)) {

            // COURSE NAME
            $course = mysqli_fetch_assoc(mysqli_query($conn, "
                SELECT c.name 
                FROM kiusc_courses c 
                JOIN kiusc_course_offered cf ON c.id = cf.course_id 
                WHERE cf.id = '".$co['id']."'
            "));

            // PROGRAM NAME
            $program = mysqli_fetch_assoc(mysqli_query($conn, "
                SELECT name, session_name, `group` 
                FROM kiusc_programs 
                WHERE id = '".$co['prog_id']."'
            "));

            // Reset categories
            foreach ($category_scores as $cat => $val) {
                $category_scores[$cat] = 0;
                $category_questions[$cat] = 0;
            }

            // FETCH ANSWERS
            $answers = mysqli_query($conn, "
                SELECT * 
                FROM kiusc_eval_std es
                JOIN kiusc_eval_questions eq ON es.question_id = eq.id
                JOIN kiusc_eval_ques_category eqc ON eqc.id = eq.cat_id
                WHERE eqc.eval_type_id = 1
                  AND es.c_offer_id = '".$co['id']."'
            ");

            $total_category_per = 0;

            while ($ans = mysqli_fetch_assoc($answers)) {
                $cat = $ans['shortnmae'];
                $category_scores[$cat] += $ans['ans'];
                $category_questions[$cat]++;
            }

            // Skip blank categories
            foreach ($category_scores as $cat => $score) {
                if ($category_questions[$cat] == 0) $category_questions[$cat] = 1;
                $percentage = round(($score / ($category_questions[$cat] * 3)) * 100, 2);
                $total_category_per += $percentage;
            }

            if ($total_category_per == 0) continue;

            // WRITE ROW VALUES
            $col = 0;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col++, $row, $sno);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col++, $row, $course['name']);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col++, $row,
                $program['name']." (".$program['session_name'].") ".$program['group']
            );

            foreach ($category_scores as $cat => $score) {
                $percentage = round(($score / ($category_questions[$cat] * 3)) * 100, 2);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col++, $row, $percentage);
            }

            // OVERALL SCORE
            $overall = round($total_category_per / count($category_scores), 2);

            // STUDENT COUNTS
            $reg_std = mysqli_num_rows(mysqli_query($conn, "
                SELECT * FROM kiusc_results WHERE c_offer_id = '".$co['id']."'
            "));
            $eval_std = mysqli_num_rows(mysqli_query($conn, "
                SELECT DISTINCT std_id FROM kiusc_eval_std WHERE c_offer_id = '".$co['id']."'
            "));

            $participation = round(($eval_std / $reg_std) * 100, 2);

            // TOTALS
            $total_overall += $overall;
            $valid_courses++;
            $total_students += $reg_std;
            $total_participated += $eval_std;

            // Write final columns
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $overall);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 1, $row, $reg_std);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col + 2, $row, $participation);

            $row++;
            $sno++;
        }

        // Overall totals
        $avg_overall = round($total_overall / $valid_courses, 2);
        $avg_participation = round($total_participated / $total_students * 100, 2);

        $objPHPExcel->getActiveSheet()->setCellValue("A20", "Overall Teacher Proficiency");
        $objPHPExcel->getActiveSheet()->setCellValue("D20", $avg_overall." %");

        $objPHPExcel->getActiveSheet()->setCellValue("A22", "Student Participation Level");
        $objPHPExcel->getActiveSheet()->setCellValue("D22", $avg_participation." %");
    }
}

// download  
header("Content-Disposition: attachment; filename=$name_for_download.xlsx");
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');
?>
