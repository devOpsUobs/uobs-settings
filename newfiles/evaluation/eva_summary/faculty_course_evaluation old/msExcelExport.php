<?php
ob_start();
$evl_id = $_REQUEST['evl_id'];
// $eval_type_id = $_REQUEST['eval_type_id'];

require_once '../../../../libraries/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
include '../../../conn.php';
include "../../../common.php";

$objPHPExcel = PHPExcel_IOFactory::load("facultycourseevaluation.xlsx");



$sem = mysqli_query($conn, "select s.* from kiusc_evaluation e JOIN kiusc_semesters s ON s.id = e.sem_id where e.id='$evl_id'");
$sem = mysqli_fetch_assoc($sem);

$semester = $sem['sem_name'];

$faculty = mysqli_query($conn, 'SELECT id, name FROM `s04cf_users` WHERE block = 0');


$name_for_download = 'Course Evaluation by Teaching Faculty Report -' . $semester;
$i = 0;

while ($fac = mysqli_fetch_assoc($faculty)) {

	$courses = mysqli_query($conn, "SELECT cf.* FROM `kiusc_course_offered` cf join kiusc_evaluation e on cf.sem_id = e.sem_id 
									WHERE cf.fac_id = '" . $fac['id'] . "' and e.id = '$evl_id' and cf.eva_cat_id !=5");
	$offer = mysqli_num_rows($courses);
	if ($offer > 0) {

		$i++;
		//if($i != 0)
		//{
		$sheet1 = $objPHPExcel->getActiveSheet()->copy();
		$sheet2 = clone $sheet1;
		// add title
		// if (strlen($fac['name']) > 31) {
		// 	$title = substr($fac['name'], 0, 31);
		// }

		// Optionally sanitize the title (remove invalid characters)
		//$title = preg_replace('/[\\?*:\\/\\[\\]]/', '', $title);

		// end title code

		$sheet2->setTitle($fac['name']);
		$objPHPExcel->addSheet($sheet2);
		unset($sheet2);
		unset($sheet1);

		//}
		//else
		//{
		//$objPHPExcel->getActiveSheet()->setTitle($fee_basic['std_name']);
		//}
		$objPHPExcel->setActiveSheetIndex($i);

		$objPHPExcel->getActiveSheet()->setcellValue('C2', $fac['name']);
		$objPHPExcel->getActiveSheet()->setcellValue('C3', '');
		$objPHPExcel->getActiveSheet()->setcellValue('A4', "The Quality Enhancement Cell, University of Baltistan, Skardu hereby acknowledges your services at University of Baltistan, Skardu. Your Evaluation report of the Semester (" . $semester . ") has been prepared under the students' Evaluation Data collected by this office. The following observations and recommendations are forwarded for kind perusal:");

		$g_total = 0;
		$g_obt = 0;
		$total_per = 0;
		// 2 = C
		$row = 7;
		$sno = 1;



		$total_courses = 0;
		//$ttl_reg_std = 1;
		//$total_participated_std_percentage = 0;
		//$eva_std_percentage = 0;
		while ($co = mysqli_fetch_assoc($courses)) {



			$total_courses++;

			$objPHPExcel->getActiveSheet()->setcellValue('A' . $row, $sno);

			$col = 1;

			$course_name = mysqli_query($conn, "SELECT * FROM `kiusc_courses` c join kiusc_course_offered cf on c.id= cf.course_id WHERE cf.id = '" . $co['id'] . "' and cf.eva_cat_id !=5");
			$c_name = mysqli_fetch_assoc($course_name);

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $c_name['name']);

			$prog_name = mysqli_query($conn, "SELECT * FROM `kiusc_programs` WHERE id = '" . $co['prog_id'] . "'");
			$p_name = mysqli_fetch_assoc($prog_name);

			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $p_name['name'] . ' (' . $p_name['session_name'] . ')' . $p_name['group']);

			$total = 0;
			$obt = 0;

			$answers = mysqli_query($conn, "SELECT * FROM `kiusc_eval_std` es 
												JOIN `kiusc_eval_questions` eq ON es.question_id=eq.id
												JOIN `kiusc_eval_ques_category` eqc on eqc.id=eq.cat_id 
												WHERE eqc.eval_type_id=2 and c_offer_id = '" . $co['id'] . "'");
			$count = mysqli_num_rows($answers);
			if ($count > 0) {
				while ($ans = mysqli_fetch_assoc($answers)) {
					$total += 3;
					$obt += $ans['ans'];
				}

				$per = 0;
				if ($total > 0)
					$per = round($obt / $total * 100, 2);

				if ($per < 50) {
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $per);
					$col2 = $col + 4;
				} elseif ($per >= 50 && $per < 60) {
					$col = $col + 2;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $per);
					$col2 = $col + 3;
				} elseif ($per >= 60 && $per < 80) {
					$col = $col + 3;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $per);
					$col2 = $col + 2;
				} elseif ($per >= 80 && $per < 90) {
					$col = $col + 4;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $per);
					$col2 = $col + 1;
				} elseif ($per >= 90) {
					$col = $col + 5;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $per);
					$col2 = $col;
				}

				$col2++;
				$evaluation_fac_comments = mysqli_query($conn, "SELECT * FROM `kiusc_evaluation_std_comments`
												WHERE eval_type_id=2 and c_offer_id = '" . $co['id'] . "'");
				$fac_comt = mysqli_fetch_assoc($evaluation_fac_comments);
				$faccomment = $fac_comt['comments'];
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col2, $row, $faccomment);
				$col2++;
				// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col2, $row, $ttl_eval_std);
				// $col2++;
				//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col2, $row, round($eva_std_percentage, 2));

				$g_total += $total;
				$g_obt += $obt;


				$total_per += $per;

				$row++;
				$sno++;
			} else {
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '^NE');
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '^NE');
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '^NE');
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '^NE');
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '^NE');
				$col++;
				// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $ttl_reg_std);
				// $col++;
				// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $ttl_eval_std);
				// $col++;
				//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, round($eva_std_percentage, 2));

				$row++;
				$sno++;
			}
			//}
		}

		$row++;
		// echo $feedback;
		// return;


		////////  end refrence
		///////////////  Style ///////////

		$fromCell = PHPExcel_Cell::stringFromColumnIndex(0) . 11;
		$toCell = PHPExcel_Cell::stringFromColumnIndex(16) . ($row);

		$cellRange = $fromCell . ':' . $toCell;


		$objPHPExcel->getActiveSheet()->getStyle($cellRange)->getFont()->applyFromArray(
			array(
				'name' => 'Arial',
				'size' => 10
			)
		);

		$objPHPExcel->getActiveSheet()->getStyle("B11:B" . $row)->getAlignment()->applyFromArray(
			array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
			)
		);


		//////////  End style //////////


		$objPHPExcel->setActiveSheetIndex(0);
	}
}
unset($sheet1);
$objPHPExcel->removeSheetByIndex(0);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

header('Location: downloadFile.php?s=' . $name_for_download);
?>