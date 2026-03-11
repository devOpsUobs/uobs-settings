<?php 
ob_start();
$evl_id = $_REQUEST['evl_id'];
$department = $_REQUEST['sel_dep_id'];

require_once '../../../../libraries/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
include '../../../conn.php';
include "../../../common.php";

$eval_count = mysqli_query($conn, "SELECT es.* FROM `kiusc_eval_std` es
    LEFT JOIN kiusc_course_offered co ON co.id = es.c_offer_id
    LEFT JOIN kiusc_programs p ON p.id = co.prog_id
    WHERE es.eval_id = '$evl_id' 
    AND es.eval_type_id = 1 
    AND p.dep_id = '$department'");

if (mysqli_num_rows($eval_count) == 0) {
    echo '<font color=red>No record found in the Evaluation Summary for this Department.</font>';
    return;
}

$objPHPExcel = PHPExcel_IOFactory::load("TeacherEvalReport.xlsx");

// Get Semester Name
$sem = mysqli_query($conn, "SELECT s.* FROM kiusc_evaluation e 
    JOIN kiusc_semesters s ON s.id = e.sem_id 
    WHERE e.id = '$evl_id'");
$sem = mysqli_fetch_assoc($sem);
$semester = $sem['sem_name'];

$faculty = mysqli_query($conn, "SELECT first_name, last_name, user_id 
    FROM `kiusc_employees` 
    WHERE acc_department_id = '$department' 
    AND is_active = 1");

$name_for_download = 'Teacher Evaluation Report - ' . $semester;
$i = 0;

while ($fac = mysqli_fetch_assoc($faculty)) {

    // Faculty-wise evaluation record check
    $eval_count_fac = mysqli_query($conn, "SELECT es.* FROM `kiusc_eval_std` es
        LEFT JOIN kiusc_course_offered co ON co.id = es.c_offer_id
        WHERE es.eval_id = '$evl_id' 
        AND es.eval_type_id = 1 
        AND co.fac_id = '" . $fac['user_id'] . "'");

    if (mysqli_num_rows($eval_count_fac) == 0) continue;

    // Courses offered
    $courses = mysqli_query($conn, "SELECT cf.* FROM `kiusc_course_offered` cf
        JOIN kiusc_evaluation e ON cf.sem_id = e.sem_id
        WHERE cf.fac_id = '" . $fac['user_id'] . "' 
        AND e.id = '$evl_id' 
        AND cf.eva_cat_id != 5");

    if (mysqli_num_rows($courses) == 0) continue;

    $i++;

    // Create new sheet for faculty
    $sheet1 = $objPHPExcel->getActiveSheet()->copy();
    $sheet2 = clone $sheet1;

    $fac_name = $fac['first_name'] . ' ' . $fac['last_name'];
    if (strlen($fac_name) > 31) {
        $fac_name = substr($fac_name, 0, 28) . '...';
    }

    $sheet2->setTitle($fac_name);
    $objPHPExcel->addSheet($sheet2);

    $objPHPExcel->setActiveSheetIndex($i);
    $active = $objPHPExcel->getActiveSheet();

    // Header
    $active->setCellValue('C2', $fac_name);
    $active->setCellValue('A4', 
        "The Quality Enhancement Cell, University of Baltistan, Skardu hereby acknowledges your services. 
        Your Evaluation report for Semester ($semester) has been prepared from students' Evaluation Data.");

    // Category Headers
    $category_headers = mysqli_query($conn, "SELECT * FROM `kiusc_eval_ques_category` 
        WHERE eval_type_id = 1 AND active = 1");

    $category_scores = [];
    $category_questions = [];

    $headerRow = 7;
    $col = 3;
    while ($header = mysqli_fetch_assoc($category_headers)) {
        $short_name = $header['shortnmae'];
        $category_scores[$short_name] = 0;
        $category_questions[$short_name] = 0;
        $active->setCellValueByColumnAndRow($col++, $headerRow, $short_name);
    }

    // Extra Columns
    $active->setCellValueByColumnAndRow($col, $headerRow, "T.Score");
    $active->setCellValueByColumnAndRow($col+1, $headerRow, "TS");
    $active->setCellValueByColumnAndRow($col+2, $headerRow, "SPT");

    // Variables
    $row = 8;
    $sno = 1;
    $total_overall_percentage = 0;
    $total_participated_std_percentage = 0;
    $valid_course_count = 0;

    $english_total_percentage = 0;
    $english_course_count = 0;

    while ($co = mysqli_fetch_assoc($courses)) {

        // Course Name
        $course_name = mysqli_fetch_assoc(mysqli_query($conn, 
            "SELECT name FROM kiusc_courses c
             JOIN kiusc_course_offered cf ON c.id = cf.course_id 
             WHERE cf.id = '" . $co['id'] . "'"));

        // Program
        $program_name = mysqli_fetch_assoc(mysqli_query($conn, 
            "SELECT name, session_name, `group` 
             FROM kiusc_programs WHERE id = '" . $co['prog_id'] . "'"));

        // Reset category values
        foreach ($category_scores as $cat => $score) {
            $category_scores[$cat] = 0;
            $category_questions[$cat] = 0;
        }

        // Answers
        $answers = mysqli_query($conn, "SELECT * FROM `kiusc_eval_std` es
            JOIN `kiusc_eval_questions` eq ON es.question_id = eq.id
            JOIN `kiusc_eval_ques_category` eqc ON eqc.id = eq.cat_id
            WHERE eqc.eval_type_id = 1 
            AND c_offer_id = '" . $co['id'] . "'");

        $total_category_percentage = 0;

        while ($ans = mysqli_fetch_assoc($answers)) {
            $cat_name = $ans['shortnmae'];
            $category_scores[$cat_name] += $ans['ans'];
            $category_questions[$cat_name]++;
        }

        foreach ($category_scores as $cat => $score) {
            if ($category_questions[$cat] == 0) $category_questions[$cat] = 1;
            $percentage = round(($score / ($category_questions[$cat] * 3)) * 100, 2);
            $total_category_percentage += $percentage;

            if ($cat == 'EMI') {
                $english_total_percentage += $percentage;
                $english_course_count++;
            }
        }

        if ($total_category_percentage == 0) continue;

        // Registered & Participated Students
        $ttl_reg_std = mysqli_num_rows(mysqli_query($conn, 
            "SELECT * FROM `kiusc_results` WHERE c_offer_id = '" . $co['id'] . "'"));

        $ttl_eval_std = mysqli_num_rows(mysqli_query($conn, 
            "SELECT DISTINCT es.std_id FROM `kiusc_eval_std` es WHERE c_offer_id = '" . $co['id'] . "'"));

        $std_participant_lvl = round(($ttl_eval_std / $ttl_reg_std) * 100, 2);

        // ⛔ Skip this course if participation < 80%
        if ($std_participant_lvl < 80) {
            continue;
        }

        // Overall
        $overall_percentage = round($total_category_percentage / count($category_scores), 2);

        // Print Row
        $col = 0;
        $active->setCellValueByColumnAndRow($col++, $row, $sno);
        $active->setCellValueByColumnAndRow($col++, $row, $course_name['name']);
        $active->setCellValueByColumnAndRow($col++, $row, 
            $program_name['name'] . ' (' . $program_name['session_name'] . ') ' . $program_name['group']);

        foreach ($category_scores as $cat => $score) {
            $percentage = round(($score / ($category_questions[$cat] * 3)) * 100, 2);
            $active->setCellValueByColumnAndRow($col++, $row, "$percentage");
        }

        $active->setCellValueByColumnAndRow($col, $row, "$overall_percentage");
        $active->setCellValueByColumnAndRow($col+1, $row, "$ttl_reg_std");
        $active->setCellValueByColumnAndRow($col+2, $row, "$std_participant_lvl");

        $total_overall_percentage += $overall_percentage;
        $total_participated_std_percentage += $std_participant_lvl;
        $valid_course_count++;

        $row++;
        $sno++;
    }

    // Summary
    $overall_course_percentage = $valid_course_count > 0 ?
        round($total_overall_percentage / $valid_course_count, 2) : 0;

    $english_avg_percentage = $english_course_count > 0 ?
        round($english_total_percentage / $english_course_count, 2) : 0;

    $total_participation_level = $valid_course_count > 0 ?
        round($total_participated_std_percentage / $valid_course_count, 2) : 0;

    // Comments
    if ($overall_course_percentage < 50) $comment = 'Needs improvement (NIP)';
    elseif ($overall_course_percentage < 60) $comment = 'Satisfactory (SF)';
    elseif ($overall_course_percentage < 70) $comment = 'Good (G)';
    elseif ($overall_course_percentage < 80) $comment = 'Very good (VG)';
    elseif ($overall_course_percentage < 85) $comment = 'Excellent (EXL)';
    else $comment = 'Exceptional (EXP)';

    // Summary Rows
    $active->setCellValue('A20', 'Comprehensive Teaching Proficiency');
    $active->setCellValue('D20', $overall_course_percentage . ' % (' . $comment . ')');

    $active->setCellValue('A21', 'English as Medium of Instruction');
    $active->setCellValue('D21', $english_avg_percentage . ' %');

    $active->setCellValue('A22', 'Student Participation Level (SPT)');
    $active->setCellValue('D22', $total_participation_level . ' %');

    $objPHPExcel->setActiveSheetIndex(0);
}

// Output File
header("Content-Disposition: attachment; filename=$name_for_download.xlsx");
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');

?>
