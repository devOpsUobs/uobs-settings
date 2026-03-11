<?php
ob_start();
$evl_id = $_REQUEST['evl_id'];
$department = $_REQUEST['sel_dep_id'];

require_once '../../../../libraries/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
include '../../../conn.php';
include "../../../common.php";

// Check if there are any evaluation records for the selected department and evaluation type
$eval_count = mysqli_query($conn, "SELECT es.* FROM `kiusc_eval_std` es
    LEFT JOIN kiusc_course_offered co ON co.id = es.c_offer_id
    LEFT JOIN kiusc_programs p ON p.id = co.prog_id
    WHERE es.eval_id = '$evl_id' AND es.eval_type_id = 1 AND p.dep_id = '$department'");
$evl_count = mysqli_num_rows($eval_count);

if ($evl_count == 0) {
    echo '<font color=red> No record found in the Evaluation Summary for this Department.</font>';
    return;
}

$objPHPExcel = PHPExcel_IOFactory::load("TeacherEvalReport.xlsx");

// Fetch the semester details
$sem = mysqli_query($conn, "SELECT s.* FROM kiusc_evaluation e 
    JOIN kiusc_semesters s ON s.id = e.sem_id WHERE e.id = '$evl_id'");
$sem = mysqli_fetch_assoc($sem);
$semester = $sem['sem_name'];

// Fetch faculty information
$faculty = mysqli_query($conn, "SELECT first_name, last_name, user_id FROM `kiusc_employees` 
    WHERE acc_department_id = '$department' AND is_active = 1");

$name_for_download = 'Evaluation Report - ' . $semester;
$i = 0;

while ($fac = mysqli_fetch_assoc($faculty)) {
    // Check if faculty has evaluations
    $eval_count_fac = mysqli_query($conn, "SELECT es.* FROM `kiusc_eval_std` es
        LEFT JOIN kiusc_course_offered co ON co.id = es.c_offer_id
        WHERE es.eval_id = '$evl_id' AND es.eval_type_id = 1 AND co.fac_id = '" . $fac['user_id'] . "'");
    $evl_count_fac = mysqli_num_rows($eval_count_fac);
    if ($evl_count_fac == 0) continue;

    // Fetch courses offered by faculty
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
        $objPHPExcel->getActiveSheet()->setCellValue('A4', "Evaluation report for the Semester ($semester):");

        // Fetch category headers dynamically
        $category_headers = mysqli_query($conn, "SELECT * FROM `kiusc_eval_ques_category` WHERE eval_type_id=1 AND active=1");
        $category_scores = [];
        $category_questions = [];
        
        // Set headers for each category and initialize scores array
        $headerRow = 6;
        $col = 3; // Starting column after course info
        while ($header = mysqli_fetch_assoc($category_headers)) {
            $short_name = $header['shortnmae'];
            $category_scores[$short_name] = 0; // Initialize score for each category
            $category_questions[$short_name] = 0; // Initialize question count for each category
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col++, $headerRow, $short_name);
        }
        
        // Add "Overall Participation Level" column
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $headerRow, "Overall Participation Level");

        $row = 7; // Data starting row
        $sno = 1;
        $total_courses = 0;
        $total_participated_std_percentage = 0;

        while ($co = mysqli_fetch_assoc($courses)) {
            // Fetch course and program details
            $course_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM `kiusc_courses` c
                JOIN kiusc_course_offered cf ON c.id = cf.course_id WHERE cf.id = '" . $co['id'] . "' AND cf.eva_cat_id != 5"));
            $program_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name, session_name, `group` FROM `kiusc_programs` WHERE id = '" . $co['prog_id'] . "'"));

            // Fill course and program information in row
            $col = 0;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col++, $row, $sno);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col++, $row, $course_name['name']);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col++, $row, $program_name['name'] . ' (' . $program_name['session_name'] . ')' . $program_name['group']);

            // Reset category scores and question counts for each course
            foreach ($category_scores as $cat => $score) {
                $category_scores[$cat] = 0;
                $category_questions[$cat] = 0;
            }

            // Calculate scores for each category
            $answers = mysqli_query($conn, "SELECT * FROM `kiusc_eval_std` es
                JOIN `kiusc_eval_questions` eq ON es.question_id = eq.id
                JOIN `kiusc_eval_ques_category` eqc ON eqc.id = eq.cat_id
                WHERE eqc.eval_type_id = 1 AND c_offer_id = '" . $co['id'] . "'");
            while ($ans = mysqli_fetch_assoc($answers)) {
                $cat_name = $ans['shortnmae'];
                $category_scores[$cat_name] += $ans['ans'];
                $category_questions[$cat_name]++;
            }

            // Insert each calculated category percentage in respective column
            foreach ($category_scores as $cat => $score) {
                if ($category_questions[$cat] == 0) $category_questions[$cat] = 1; // Avoid division by zero
                $percentage = round(($score / ($category_questions[$cat] * 3)) * 100, 2);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col++, $row, "$percentage%");
            }

            // Insert overall participation level
            $ttl_reg_std = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `kiusc_results` WHERE c_offer_id = '" . $co['id'] . "'"));
            $ttl_eval_std = mysqli_num_rows(mysqli_query($conn, "SELECT DISTINCT es.std_id FROM `kiusc_eval_std` es WHERE c_offer_id = '" . $co['id'] . "'"));
            $total_courses++;
            $std_participant_lvl = round(($ttl_eval_std / $ttl_reg_std) * 100, 2);
            $total_participated_std_percentage += $std_participant_lvl;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "$std_participant_lvl%");

            $row++;
            $sno++;
        }
		$objPHPExcel->setActiveSheetIndex(0);
    }
}


header("Content-Disposition: attachment; filename=$name_for_download.xlsx");
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');
?>
