<?php
ob_start();

$evl_id = $_REQUEST['evl_id'];
$department = $_REQUEST['sel_dep_id'];

require_once '../../../../libraries/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
include '../../../conn.php';
include "../../../common.php";


$eval_count = mysqli_query($conn, "SELECT es.* FROM `kiusc_eval_std` es
									left join kiusc_course_offered co on co.id=es.c_offer_id
									left join kiusc_programs p on p.id=co.prog_id
									where  es.eval_id='$evl_id' and es.eval_type_id=3 and p.dep_id='$department'");
$evl_count = mysqli_num_rows($eval_count);

if ($evl_count == 0) {

	echo '<font color=red> No record found in the Evaluation Summary for this Department.</font>';
	return;

}

$objPHPExcel = PHPExcel_IOFactory::load("StudentCourseReport.xlsx");



$sem = mysqli_query($conn, "select s.* from kiusc_evaluation e JOIN kiusc_semesters s ON s.id = e.sem_id where e.id='$evl_id'");
$sem = mysqli_fetch_assoc($sem);

$semester = $sem['sem_name'];


$prog_name = mysqli_query($conn, "SELECT * FROM `kiusc_programs` where active=1 and dep_id='$department' ORDER BY dep_id asc");

$columns_array = array('C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');


$name_for_download = 'Student Course Evaluation Report -' . $semester;
$i = 0;

while ($prog = mysqli_fetch_assoc($prog_name)) {

	$eval_count_prog = mysqli_query($conn, "SELECT es.* FROM `kiusc_eval_std` es
									left join kiusc_course_offered co on co.id=es.c_offer_id
									left join kiusc_programs p on p.id=co.prog_id
									where  es.eval_id='$evl_id' and es.eval_type_id=3 and p.id='" . $prog['id'] . "'");
	$evl_count_prog = mysqli_num_rows($eval_count_prog);
	if ($evl_count_prog == 0) {
		continue;

	}


	$courses = mysqli_query($conn, "SELECT cf.* FROM `kiusc_course_offered` cf join kiusc_evaluation e on cf.sem_id = e.sem_id 
									WHERE cf.prog_id = '" . $prog['id'] . "' and e.id = '$evl_id' and cf.eva_cat_id !=5");
	$offer = mysqli_num_rows($courses);
	if ($offer > 0) {

		$i++;

		$sheet1 = $objPHPExcel->getActiveSheet()->copy();
		$sheet2 = clone $sheet1;


		$progname = $prog['name'] . ' ' . $prog['session_name'] . ' ' . $prog['group'];

		if (strlen($progname) > 31) {
			$progname = substr($progname, 0, 28) . '...';
		}


		$sheet2->setTitle($progname);
		$objPHPExcel->addSheet($sheet2);
		unset($sheet2);
		unset($sheet1);

		$objPHPExcel->setActiveSheetIndex($i);

		$objPHPExcel->getActiveSheet()->setcellValue('C2', $prog['name'] . ' ' . $prog['session_name'] . ' ' . $prog['group']);
		$objPHPExcel->getActiveSheet()->setcellValue('C3', '');
		//$objPHPExcel->getActiveSheet()->setcellValue('A4', "The Quality Enhancement Cell, University of Baltistan, Skardu hereby acknowledges your services at University of Baltistan, Skardu. Your Evaluation report of the Semester (" . $semester . ") has been prepared under the students' Evaluation Data collected by this office. The following observations and recommendations are forwarded for kind perusal:");
		$objPHPExcel->getActiveSheet()->setcellValue('A4', "The courses listed below are evaluated through student feedback from those enrolled during the (" . $semester . ") at the University of Baltistan, Skardu (UOBS). Detailed comments are provided from the top five students, selected based on their exam performance. Additionally, grades derived from students' responses to key closed-ended questions, as specified by the QEC/HEC, are included below.");

		$g_total = 0;
		$g_obt = 0;
		$total_per = 0;
		// 2 = C
		$row = 8;
		$sno = 1;

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


		$courseofrid = array();
		$coursenames = array();
		while ($co = mysqli_fetch_assoc($courses)) {

			$courseofrid[] = $co['id'];



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

				$coursenames[] = $c_name['name'];



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

						// Update total and obtained values 3 means total marks 3
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

		unset($styleArray);

		if ($per > 0) {


			$row++;
			$row++;
			$row++;
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $row, "Top Five Students Comments");
			$objPHPExcel->getActiveSheet()->mergeCells('A' . $row . ':K' . $row);

			$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);

			$objPHPExcel->getActiveSheet()->getStyle('A' . $row)->applyFromArray($styleArray);

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
				// $faculty = mysqli_query($conn, "SELECT u.name FROM s04cf_users u
				//                     join kiusc_course_offered cf on cf.fac_id=u.id
				//                     WHERE cf.id='" . $co['id'] . "'");
				// $fac = mysqli_fetch_assoc($faculty);

				//$facultyCourse = $c_name['name'] . ' ( ' . $fac['name'] . ' ) ';

				// Set serial number, course name, and faculty name in the row
				$objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sno);
				$objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $c_name['name']);
				$objPHPExcel->getActiveSheet()->mergeCells('B' . $row . ':G' . $row);

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
				$objPHPExcel->getActiveSheet()->getStyle('C' . $row . ':G' . $row)->applyFromArray($styleArray);

				// Optionally, unset the style array to free memory
				unset($styleArray);

				$row++; // Move to the next row for student comments


				// Get top 5 student comments
				$answers = mysqli_query($conn, "SELECT e.*, r.total 
												FROM kiusc_evaluation_std_comments e
												JOIN kiusc_results r ON e.c_offer_id  = r.c_offer_id
												WHERE e.eval_type_id = 3 
												AND e.c_offer_id = '" . $co['id'] . "'
												GROUP BY e.std_id
												ORDER BY r.total DESC
												LIMIT 5");
				// $answers = mysqli_query($conn, "SELECT * FROM `kiusc_evaluation_std_comments`
				//                     WHERE eval_type_id=3 and  c_offer_id = '" . $co['id'] . "' LIMIT 5");
				$stdsno = 1;



				while ($ans = mysqli_fetch_assoc($answers)) {
					$std_comments = $ans['comments'];
					$objPHPExcel->getActiveSheet()->setCellValue('A' . $row, ''); // Blank faculty name for comments row
					$objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $stdsno++); // Blank s.no for comments row
					$objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $std_comments); // Set student comment
					$objPHPExcel->getActiveSheet()->mergeCells('C' . $row . ':G' . $row);
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
					$objPHPExcel->getActiveSheet()->getStyle('C' . $row . ':G' . $row)->applyFromArray($styleArray);

					// Optionally, unset the style array to free memory
					unset($styleArray);

					$row++; // Move to the next row for the next comment
				}

				$sno++; // Increment serial number
			}
			$row++;
			$row++;
			$row++;

			$objPHPExcel->getActiveSheet()->setCellValue('A' . $row, "Sno");
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $row, "Category Name");
			$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'FF000000'),
					),
				),
			);

			$objPHPExcel->getActiveSheet()->getStyle('A' . $row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('B' . $row)->applyFromArray($styleArray);



			foreach ($coursenames as $col_index => $cname) {
				$objPHPExcel->getActiveSheet()->setCellValue($columns_array[$col_index] . $row, $cname);

				$styleArray = array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN,
							'color' => array('argb' => 'FF000000'),
						),
					),
				);

				// Apply the border style to cells A, B, and merged C:K
				$objPHPExcel->getActiveSheet()->getStyle($columns_array[$col_index] . $row)->applyFromArray($styleArray);

				// Optionally, unset the style array to free memory
				unset($styleArray);
			}



			$row++;

			$sno = 1;
			$eval_ques_category = mysqli_query($conn, "SELECT * FROM `kiusc_eval_ques_category` WHERE `eval_type_id`=3");
			while ($ecat = mysqli_fetch_assoc($eval_ques_category)) {


				// Set serial number, course name, and faculty name in the row
				$objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sno);
				$objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $ecat['name']);
				$styleArray = array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN,
							'color' => array('argb' => 'FF000000'),
						),
					),
				);

				$objPHPExcel->getActiveSheet()->getStyle('A' . $row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyle('B' . $row)->applyFromArray($styleArray);



				$percentage = 0;
				$std_cat_sum_ans = 0;
				$std_cat_sum_ques = 0;
				foreach ($courseofrid as $col_index => $cf_id) {

					$eval_std_category = mysqli_query($conn, "SELECT count(question_id)*3 as sum_questions, sum(ans) as sum_ans FROM `kiusc_eval_std` estd
														join kiusc_eval_questions eq on eq.id=estd.question_id
														WHERE eq.cat_id='" . $ecat['id'] . "' and estd.eval_type_id=3 and c_offer_id = '" . $cf_id . "'");
					$eval_std_cat = mysqli_fetch_assoc($eval_std_category);
					$std_cat_sum_ans = $eval_std_cat['sum_ans'];
					$std_cat_sum_ques = $eval_std_cat['sum_questions'];
					// Define the border style
					$styleArray = array(
						'borders' => array(
							'allborders' => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN,
								'color' => array('argb' => 'FF000000'),
							),
						),

					);

					$percentage = round($std_cat_sum_ans / $std_cat_sum_ques * 100, 2);
					if ($percentage > 0) {

						$objPHPExcel->getActiveSheet()->setCellValue($columns_array[$col_index] . $row, $percentage);
					} else {
						$objPHPExcel->getActiveSheet()->setCellValue($columns_array[$col_index] . $row, "^NE");

					}
					//$objPHPExcel->getActiveSheet()->getStyle($columns_array[$col_index] . $row)->applyFromArray($styleArray);
					// Set custom width for the column
					$objPHPExcel->getActiveSheet()->getColumnDimension($columns_array[$col_index])->setWidth(30); // Set custom width

					// Set custom height for the row
					$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(40); // Set custom height

					$objPHPExcel->getActiveSheet()->getStyle($columns_array[$col_index] . $row)->applyFromArray($styleArray);


					// Optionally, unset the style array to free memory
					unset($styleArray);

				}




				// Optionally, unset the style array to free memory
				unset($styleArray);

				$row++; // Move to the next row for student comments

				$sno++; // Increment serial number
			}
		}
		$row++;
		$row++;
		$row++;

		//signature strt

		$columnStartIndex = 4; // 'H' is the 8th column, so index is 6
		$columnEndIndex = 6;   // 'I' is the 9th column, so index is 7

		// Set the value in column H and merge with column I in the specified row
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($columnStartIndex, $row, "Additional Director QEC");

		// Merge cells H and I in the specified row
		$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($columnStartIndex, $row, $columnEndIndex, $row);

		// Apply styles: bold, italic, and underline
		$objPHPExcel->getActiveSheet()
			->getStyleByColumnAndRow($columnStartIndex, $row)
			->applyFromArray([
				'font' => [
					'bold' => true,
					'italic' => true,
					'underline' => true,
				]
			]);

		// Increase the row height
		$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(30); // Adjust the height as needed
		// Set the width of columns H and I
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($columnStartIndex)->setWidth(12); // Adjust the width as needed
		$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($columnEndIndex)->setWidth(12);   // Adjust the width as needed
		//signature end





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