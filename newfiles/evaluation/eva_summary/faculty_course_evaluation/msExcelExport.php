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
    WHERE es.eval_id = '$evl_id' AND es.eval_type_id = 1 AND p.dep_id = '$department'");
$evl_count = mysqli_num_rows($eval_count);

if ($evl_count == 0) {
    echo '<font color=red> No record found in the Evaluation Summary for this Department.</font>';
    return;
}

$objPHPExcel = PHPExcel_IOFactory::load("FacultyCourseEvaluation.xlsx");

$sem = mysqli_query($conn, "SELECT s.* FROM kiusc_evaluation e 
    JOIN kiusc_semesters s ON s.id = e.sem_id WHERE e.id = '$evl_id'");
$sem = mysqli_fetch_assoc($sem);
$semester = $sem['sem_name'];

$faculty = mysqli_query($conn, "SELECT first_name, last_name, user_id FROM `kiusc_employees` 
    WHERE acc_department_id = '$department' AND is_active = 1");

$name_for_download = 'Faculty Course Review and Evaluation Summary - ' . $semester;
$i = 0;

while ($fac = mysqli_fetch_assoc($faculty)) {
    $eval_count_fac = mysqli_query($conn, "SELECT es.* FROM `kiusc_eval_std` es
        LEFT JOIN kiusc_course_offered co ON co.id = es.c_offer_id
        WHERE es.eval_id = '$evl_id' AND es.eval_type_id = 2 AND co.fac_id = '" . $fac['user_id'] . "'");
    $evl_count_fac = mysqli_num_rows($eval_count_fac);
    if ($evl_count_fac == 0) continue;

    $courses = mysqli_query($conn, "SELECT cf.* FROM `kiusc_course_offered` cf
        JOIN kiusc_evaluation e ON cf.sem_id = e.sem_id
        WHERE cf.fac_id = '" . $fac['user_id'] . "' AND e.id = '$evl_id' AND cf.eva_cat_id != 5");
    $offer = mysqli_num_rows($courses);
    if ($offer > 0) {
        $i++;
        $sheet1 = $objPHPExcel->getActiveSheet()->copy();
        $sheet2 = clone $sheet1;

        $fac_name = $fac['first_name'] . ' ' . $fac['last_name'];
        if (strlen($fac_name) > 31) {
            $fac_name = substr($fac_name, 0, 28) . '...';
        }

        $sheet2->setTitle($fac_name);
        $objPHPExcel->addSheet($sheet2);
        unset($sheet2);
        unset($sheet1);

        $objPHPExcel->setActiveSheetIndex($i);
        $objPHPExcel->getActiveSheet()->setCellValue('C2', $fac['first_name'] . ' ' . $fac['last_name']);
        $objPHPExcel->getActiveSheet()->setCellValue('A4', "The Quality Enhancement Cell, University of Baltistan, Skardu presented the Course Evaluation Report based on Teacher’s Feedback for the Semester ($semester) The following observations and recommendations are forwarded for kind perusal:");

        $category_headers = mysqli_query($conn, "SELECT * FROM `kiusc_eval_ques_category` WHERE eval_type_id=2 AND active=1");
        $category_scores = [];
        $category_questions = [];

        $headerRow = 7;
        $col = 3;
        while ($header = mysqli_fetch_assoc($category_headers)) {
            $short_name = $header['shortnmae'];
            $category_scores[$short_name] = 0;
            $category_questions[$short_name] = 0;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col++, $headerRow, $short_name);
        }

        // Add "Total Score" column
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $headerRow, "T.Score");

        $row = 8;
        $sno = 1;
        $total_overall_percentage = 0;
        $valid_course_count = 0;

        while ($co = mysqli_fetch_assoc($courses)) {
            $course_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM `kiusc_courses` c
                JOIN kiusc_course_offered cf ON c.id = cf.course_id WHERE cf.id = '" . $co['id'] . "' AND cf.eva_cat_id != 5"));
            $program_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name, session_name, `group` FROM `kiusc_programs` WHERE id = '" . $co['prog_id'] . "'"));

            $col = 0;
            $total_category_percentage = 0;

            foreach ($category_scores as $cat => $score) {
                $category_scores[$cat] = 0;
                $category_questions[$cat] = 0;
            }

            $answers = mysqli_query($conn, "SELECT * FROM `kiusc_eval_std` es
                JOIN `kiusc_eval_questions` eq ON es.question_id = eq.id
                JOIN `kiusc_eval_ques_category` eqc ON eqc.id = eq.cat_id
                WHERE eqc.eval_type_id = 2 AND c_offer_id = '" . $co['id'] . "'");

            while ($ans = mysqli_fetch_assoc($answers)) {
                $cat_name = $ans['shortnmae'];
                $category_scores[$cat_name] += $ans['ans'];
                $category_questions[$cat_name]++;
            }

            foreach ($category_scores as $cat => $score) {
                if ($category_questions[$cat] == 0) $category_questions[$cat] = 1;
                $percentage = round(($score / ($category_questions[$cat] * 3)) * 100, 2);
                $total_category_percentage += $percentage;
            }

            if ($total_category_percentage == 0) continue;

            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col++, $row, $sno);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col++, $row, $course_name['name']);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col++, $row, $program_name['name'] . ' (' . $program_name['session_name'] . ')' . $program_name['group']);

            foreach ($category_scores as $cat => $score) {
                $percentage = round(($score / ($category_questions[$cat] * 3)) * 100, 2);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col++, $row, "$percentage");
            }

            $overall_percentage = round($total_category_percentage / count($category_scores), 2);
            $total_overall_percentage += $overall_percentage;
            $valid_course_count++;

            // Set value for Total Score
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "$overall_percentage");

            $row++;
            $sno++;
        }

        // Summary row at the end for all courses
        $overall_course_percentage = round($total_overall_percentage / $valid_course_count, 2);
        $comment = '';
        if ($overall_course_percentage < 50) {
            $comment = 'Needs improvement   (NIP)';
        } elseif ($overall_course_percentage >= 50 && $overall_course_percentage < 60) {
            $comment = 'Satisfactory   (SF)';
        } elseif ($overall_course_percentage >= 60 && $overall_course_percentage < 70) {
            $comment = 'Good   (G)';
        } elseif ($overall_course_percentage >= 70 && $overall_course_percentage < 80) {
            $comment = 'Very good   (VG)';
        } elseif ($overall_course_percentage >= 80 && $overall_course_percentage < 85) {
            $comment = 'Excellent   (EXL)';
        } elseif ($overall_course_percentage >= 85) {
            $comment = 'Exceptional   (EXP)';
        }

        $objPHPExcel->getActiveSheet()->setcellValue('A20', 'Cumulative Review Score');
        $objPHPExcel->getActiveSheet()->setcellValue('D20', $overall_course_percentage . ' (' . $comment . ')');

        $objPHPExcel->setActiveSheetIndex(0);
    }
}

header("Content-Disposition: attachment; filename=$name_for_download.xlsx");
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');
?>
