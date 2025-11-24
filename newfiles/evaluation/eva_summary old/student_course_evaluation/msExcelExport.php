<?php
ob_start();

$evl_id = $_REQUEST['evl_id'];
// $eval_type_id = $_REQUEST['eval_type_id'];

require_once '../../../../libraries/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
include '../../../conn.php';
include "../../../common.php";

$objPHPExcel = PHPExcel_IOFactory::load("StudentCourseReport.xlsx");



$sem = mysqli_query($conn, "select s.* from kiusc_evaluation e JOIN kiusc_semesters s ON s.id = e.sem_id where e.id='$evl_id'");
$sem = mysqli_fetch_assoc($sem);

$semester = $sem['sem_name'];


$prog_name = mysqli_query($conn, "SELECT * FROM `kiusc_programs` where active=1 and dep_id=1 ORDER BY dep_id asc");



$name_for_download = 'Student Course Evaluation Report -' . $semester;
$i = 0;

while ($prog = mysqli_fetch_assoc($prog_name)) {


	$courses = mysqli_query($conn, "SELECT cf.* FROM `kiusc_course_offered` cf join kiusc_evaluation e on cf.sem_id = e.sem_id 
									WHERE cf.prog_id = '" . $prog['id'] . "' and e.id = '$evl_id' and cf.eva_cat_id !=5");
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

		$progname = $prog['name'] . ' ' . $prog['session_name'] . ' ' . $prog['group'];

		if (strlen($progname) > 31) {
			$progname = substr($progname, 0, 28) . '...';
		}

		$sheet2->setTitle($progname);
		$objPHPExcel->addSheet($sheet2);
		unset($sheet2);
		unset($sheet1);

		//}
		//else
		//{
		//$objPHPExcel->getActiveSheet()->setTitle($fee_basic['std_name']);
		//}
		$objPHPExcel->setActiveSheetIndex($i);

		$objPHPExcel->getActiveSheet()->setcellValue('C2', $prog['name'] . ' ' . $prog['session_name'] . ' ' . $prog['group']);
		$objPHPExcel->getActiveSheet()->setcellValue('C3', '');
		$objPHPExcel->getActiveSheet()->setcellValue('A4', "The Quality Enhancement Cell, University of Baltistan, Skardu hereby acknowledges your services at University of Baltistan, Skardu. Your Evaluation report of the Semester (" . $semester . ") has been prepared under the students' Evaluation Data collected by this office. The following observations and recommendations are forwarded for kind perusal:");

		$g_total = 0;
		$g_obt = 0;
		$total_per = 0;
		// 2 = C
		$row = 8;
		$sno = 1;

		$cat1 = 0;
		$cat2 = 0;
		$cat3 = 0;
		$cat4 = 0;
		$cat5 = 0;
		$cat6 = 0;
		$cat7 = 0;
		$cat8 = 0;
		$cat9 = 0;
		$cat1_questions = 0;
		$cat3_questions = 0;
		$cat4_questions = 0;
		$cat2_questions = 0;
		$cat5_questions = 0;
		$cat6_questions = 0;
		$cat7_questions = 0;
		$cat8_questions = 0;
		$cat9_questions = 0;

		$total_courses = 0;
		$ttl_reg_std = 1;
		$total_participated_std_percentage = 0;
		$eva_std_percentage = 0;
		// Define the border style
		$styleArray = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('argb' => 'FF000000'),
				),
			),
		);

		while ($co = mysqli_fetch_assoc($courses)) {

			$total_registered_std = mysqli_query($conn, "SELECT * FROM `kiusc_results` where c_offer_id = '" . $co['id'] . "'");
			$ttl_reg_std = mysqli_num_rows($total_registered_std);

			if ($ttl_reg_std != 0) {

				$total_eval_std = mysqli_query($conn, "SELECT distinct(es.std_id) FROM `kiusc_eval_std` es 
                                                JOIN `kiusc_eval_questions` eq ON es.question_id=eq.id 
                                                JOIN `kiusc_eval_ques_category` eqc on eqc.id=eq.cat_id 
                                                WHERE c_offer_id = '" . $co['id'] . "'");
				$ttl_eval_std = mysqli_num_rows($total_eval_std);

				if ($ttl_eval_std > 0) {
					$total_courses++;
					$eva_std_percentage = (($ttl_eval_std / $ttl_reg_std) * 100);
					$total_participated_std_percentage = $total_participated_std_percentage + round($eva_std_percentage, 2);
				} else {
					$eva_std_percentage = 0;
				}

				if ($eva_std_percentage == 0) {
					continue;
				}

				// Set serial number
				$objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sno);
				$objPHPExcel->getActiveSheet()->getStyle('A' . $row)->applyFromArray($styleArray); // Apply border

				$col = 1;

				// Set course name
				$course_name = mysqli_query($conn, "SELECT * FROM `kiusc_courses` c join kiusc_course_offered cf on c.id= cf.course_id WHERE cf.id = '" . $co['id'] . "' and cf.eva_cat_id !=5");
				$c_name = mysqli_fetch_assoc($course_name);
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $c_name['name']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->applyFromArray($styleArray); // Apply border

				// Set faculty name
				$col++;
				$faculty = mysqli_query($conn, "SELECT u.name FROM s04cf_users u
                                        join kiusc_course_offered cf on cf.fac_id=u.id
                                        WHERE cf.id='" . $co['id'] . "'");
				$fac = mysqli_fetch_assoc($faculty);
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $fac['name']);
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->applyFromArray($styleArray); // Apply border

				$total = 0;
				$obt = 0;
				$answers = mysqli_query($conn, "SELECT * FROM `kiusc_eval_std` es 
                                        JOIN `kiusc_eval_questions` eq ON es.question_id=eq.id
                                        JOIN `kiusc_eval_ques_category` eqc on eqc.id=eq.cat_id 
                                        WHERE eqc.eval_type_id=3 and c_offer_id = '" . $co['id'] . "'");
				$count = mysqli_num_rows($answers);
				if ($count > 0) {
					while ($ans = mysqli_fetch_assoc($answers)) {
						// Calculate category-specific values
						// (Assuming you have these variables declared somewhere in the code)

						// Update total and obtained values
						$total += 3;
						$obt += $ans['ans'];
					}

					$per = 0;
					if ($total > 0)
						$per = round($obt / $total * 100, 2);

					$colstyle = $col + 1;
					$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($colstyle, $row)->applyFromArray($styleArray); // Apply border
					$colstyle++;
					$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($colstyle, $row)->applyFromArray($styleArray); // Apply border
					$colstyle++;
					$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($colstyle, $row)->applyFromArray($styleArray); // Apply border
					$colstyle++;
					$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($colstyle, $row)->applyFromArray($styleArray); // Apply border
					$colstyle++;
					$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($colstyle, $row)->applyFromArray($styleArray); // Apply border

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

					// Set additional columns for registered, evaluated, and percentage
					$col2++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col2, $row, $ttl_reg_std);
					$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col2, $row)->applyFromArray($styleArray); // Apply border

					$col2++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col2, $row, $ttl_eval_std);
					$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col2, $row)->applyFromArray($styleArray); // Apply border

					$col2++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col2, $row, round($eva_std_percentage, 2));
					$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col2, $row)->applyFromArray($styleArray); // Apply border

					$g_total += $total;
					$g_obt += $obt;
					$total_per += $per;

					$row++;
					$sno++;
				} else {
					// Handle case when there are no answers
					for ($i = 0; $i < 4; $i++) {
						$col++;
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '^NE');
						$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->applyFromArray($styleArray); // Apply border
					}

					// Set columns for registered, evaluated, and percentage
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $ttl_reg_std);
					$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->applyFromArray($styleArray); // Apply border

					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $ttl_eval_std);
					$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->applyFromArray($styleArray); // Apply border

					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, round($eva_std_percentage, 2));
					$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->applyFromArray($styleArray); // Apply border

					$row++;
					$sno++;
				}
			}
		}

		// Optionally, unset the style array to free memory
		unset($styleArray);


		$row++;
		$row++;

		//$row = 1; // Starting row number
		$sno = 1; // Serial number

		// Loop through courses
		$courses_progr = mysqli_query($conn, "SELECT cf.* FROM `kiusc_course_offered` cf join kiusc_evaluation e on cf.sem_id = e.sem_id 
                                      WHERE cf.prog_id = '" . $prog['id'] . "' and e.id = '$evl_id' and cf.eva_cat_id !=5");

		while ($co = mysqli_fetch_assoc($courses_progr)) {
			// Get course name
			$course_name = mysqli_query($conn, "SELECT c.name FROM `kiusc_courses` c 
                                        join kiusc_course_offered cf on c.id= cf.course_id 
                                        WHERE cf.id = '" . $co['id'] . "' and cf.eva_cat_id !=5");
			$c_name = mysqli_fetch_assoc($course_name);

			// Get faculty name
			$faculty = mysqli_query($conn, "SELECT u.name FROM s04cf_users u
                                    join kiusc_course_offered cf on cf.fac_id=u.id
                                    WHERE cf.id='" . $co['id'] . "'");
			$fac = mysqli_fetch_assoc($faculty);

			// Set serial number, course name, and faculty name in the row
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sno);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $fac['name']);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $c_name['name']);
			$objPHPExcel->getActiveSheet()->mergeCells('C' . $row . ':K' . $row);

			// Define the border style
			$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);

			// Apply the border style to cells A, B, and merged C:K
			$objPHPExcel->getActiveSheet()->getStyle('A' . $row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('B' . $row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('C' . $row . ':K' . $row)->applyFromArray($styleArray);

			// Optionally, unset the style array to free memory
			unset($styleArray);

			$row++; // Move to the next row for student comments

			// Get top 5 student comments
			$answers = mysqli_query($conn, "SELECT * FROM `kiusc_evaluation_std_comments`
                                    WHERE eval_type_id=3 and  c_offer_id = '" . $co['id'] . "' LIMIT 5");
			$stdsno = 1;



			while ($ans = mysqli_fetch_assoc($answers)) {
				$std_comments = $ans['comments'];
				$objPHPExcel->getActiveSheet()->setCellValue('A' . $row, ''); // Blank faculty name for comments row
				$objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $stdsno++); // Blank s.no for comments row
				$objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $std_comments); // Set student comment
				$objPHPExcel->getActiveSheet()->mergeCells('C' . $row . ':K' . $row);
				// Apply borders for this row
				// Define the border style
				$styleArray = array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN,
							'color' => array('argb' => 'FF000000'),
						),
					),
				);

				// Apply the border style to cells A, B, and merged C:K
				$objPHPExcel->getActiveSheet()->getStyle('A' . $row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyle('B' . $row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyle('C' . $row . ':K' . $row)->applyFromArray($styleArray);

				// Optionally, unset the style array to free memory
				unset($styleArray);

				$row++; // Move to the next row for the next comment
			}

			$sno++; // Increment serial number
		}

		// Optionally save or output the Excel file here

		// if ($ttl_reg_std > 1) {
		// 	// Merge cells from A to K in the specified row
		// 	$objPHPExcel->getActiveSheet()->mergeCells('A' . $row . ':C' . $row);

		// 	// Set the value in the merged cells
		// 	$objPHPExcel->getActiveSheet()->setCellValue('A' . $row, 'Top five students comments');


		// 	$objPHPExcel->getActiveSheet()->mergeCells('D' . $row . ':E' . $row);
		// 	$objPHPExcel->getActiveSheet()->setCellValue('D' . $row, 'Student 1');

		// 	$objPHPExcel->getActiveSheet()->mergeCells('F' . $row . ':G' . $row);
		// 	$objPHPExcel->getActiveSheet()->setCellValue('F' . $row, 'Student 2');

		// 	$objPHPExcel->getActiveSheet()->mergeCells('H' . $row . ':I' . $row);
		// 	$objPHPExcel->getActiveSheet()->setCellValue('H' . $row, 'Student 3');

		// 	$objPHPExcel->getActiveSheet()->mergeCells('J' . $row . ':K' . $row);
		// 	$objPHPExcel->getActiveSheet()->setCellValue('J' . $row, 'Student 4');

		// }
		// $row++;

		// $courses_progr = mysqli_query($conn, "SELECT cf.* FROM `kiusc_course_offered` cf join kiusc_evaluation e on cf.sem_id = e.sem_id 
		// 								WHERE cf.prog_id = '" . $prog['id'] . "' and e.id = '$evl_id' and cf.eva_cat_id !=5");
		// while ($co = mysqli_fetch_assoc($courses_progr)) {

		// 	$answers = mysqli_query($conn, "SELECT * FROM `kiusc_evaluation_std_comments`
		// 										WHERE eval_type_id=3 and  c_offer_id = '" . $co['id'] . "' LIMIT 5");
		// 	$count = mysqli_num_rows($answers);

		// 	//if ($count > 0) 
		// 	{

		// 		$objPHPExcel->getActiveSheet()->setcellValue('A' . $row, $sno);

		// 		$col = 1;


		// 		$course_name = mysqli_query($conn, "SELECT * FROM `kiusc_courses` c join kiusc_course_offered cf on c.id= cf.course_id WHERE cf.id = '" . $co['id'] . "' and cf.eva_cat_id !=5");
		// 		$c_name = mysqli_fetch_assoc($course_name);

		// 		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $c_name['name']);


		// 		$faculty = mysqli_query($conn, "SELECT u.name FROM s04cf_users u
		// 										join kiusc_course_offered cf on cf.fac_id=u.id
		// 										WHERE cf.id='" . $co['id'] . "'");
		// 		$fac = mysqli_fetch_assoc($faculty);



		// 		// $prog_name = mysqli_query($conn, "SELECT * FROM `kiusc_programs` WHERE id = '" . $co['prog_id'] . "'");
		// 		// $p_name = mysqli_fetch_assoc($prog_name);


		// 		$col++;
		// 		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $fac['name']);

		// 		$total = 0;
		// 		$obt = 0;



		// 		while ($ans = mysqli_fetch_assoc($answers)) {
		// 			$std_comments = $ans['comments'];
		// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col2 - 7, $row, $std_comments);


		// 		}

		// 		$row++;
		// 		$sno++;


		// 	}

		// }

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