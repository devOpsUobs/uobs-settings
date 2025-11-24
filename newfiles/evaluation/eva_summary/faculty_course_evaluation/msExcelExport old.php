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
									where  es.eval_id='$evl_id' and es.eval_type_id=2 and p.dep_id='$department'");
$evl_count = mysqli_num_rows($eval_count);

if ($evl_count == 0) {

	echo '<font color=red> No record found in the Evaluation Summary for this Department.</font>';
	return;

}



$sem = mysqli_query($conn, "select s.* from kiusc_evaluation e JOIN kiusc_semesters s ON s.id = e.sem_id where e.id='$evl_id'");
$sem = mysqli_fetch_assoc($sem);

$semester = $sem['sem_name'];


$objPHPExcel = PHPExcel_IOFactory::load("FacultyCourseEvaluation.xlsx");

$faculty = mysqli_query($conn, "SELECT first_name,last_name,user_id FROM `kiusc_employees`  WHERE acc_department_id='$department' and is_active=1");





$columns_array = array('C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');




$name_for_download = 'Faculty Course Evaluation Report -' . $semester;
$i = 0;

while ($fac = mysqli_fetch_assoc($faculty)) {

	$eval_count_fac = mysqli_query($conn, "SELECT es.* FROM `kiusc_eval_std` es
									left join kiusc_course_offered co on co.id=es.c_offer_id
									where  es.eval_id='$evl_id' and es.eval_type_id=2 and co.fac_id = '" . $fac['user_id'] . "' ");
	$evl_count_fac = mysqli_num_rows($eval_count_fac);
	if ($evl_count_fac == 0) {
		continue;

	}


	$courses = mysqli_query($conn, "SELECT cf.* FROM `kiusc_course_offered` cf join kiusc_evaluation e on cf.sem_id = e.sem_id 
									WHERE cf.fac_id = '" . $fac['user_id'] . "' and e.id = '$evl_id' and cf.eva_cat_id !=5");
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

		//}
		//else
		//{
		//$objPHPExcel->getActiveSheet()->setTitle($fee_basic['std_name']);
		//}
		$objPHPExcel->setActiveSheetIndex($i);

		$objPHPExcel->getActiveSheet()->setcellValue('C2', $fac['first_name'] . ' ' . $fac['last_name']);
		$objPHPExcel->getActiveSheet()->setcellValue('C3', '');
		//$objPHPExcel->getActiveSheet()->setcellValue('A4', "The Quality Enhancement Cell, University of Baltistan, Skardu hereby acknowledges your services at University of Baltistan, Skardu. 
		//Your Evaluation report of the Semester (" . $semester . ") has been prepared under the students' Evaluation Data collected by this office. The following observations and recommendations are forwarded for kind perusal:");
		$objPHPExcel->getActiveSheet()->setcellValue('A4', "The courses listed below are evaluated through student feedback from those enrolled during the Semester (" . $semester . ") at the University of Baltistan, Skardu (UOBS).Detailed comments are provided from the top five students, selected based on their exam performance.Additionally, grades derived from students' responses to key closed-ended questions,as specified by the QEC/HEC, are included below.");

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

			echo "SELECT * FROM `kiusc_courses` c join kiusc_course_offered cf on c.id= cf.course_id WHERE cf.id = '" . $co['id'] . "' and cf.eva_cat_id !=5";

			$courseofrid[] = $co['id'];


			// Set serial number
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $sno);
			$objPHPExcel->getActiveSheet()->getStyle('A' . $row)->applyFromArray($styleArray); // Apply border

			$col = 1;

			// Set course name

			$course_name = mysqli_query($conn, "SELECT * FROM `kiusc_courses` c join kiusc_course_offered cf on c.id= cf.course_id WHERE cf.id = '" . $co['id'] . "' and cf.eva_cat_id !=5");
			$c_name = mysqli_fetch_assoc($course_name);

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $c_name['name']);

			$coursenames[] = $c_name['name'];



			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $c_name['name']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->applyFromArray($styleArray); // Apply border

			// Set faculty name
			$col++;
			$prog_name = mysqli_query($conn, "SELECT * FROM `kiusc_programs` WHERE id = '" . $co['prog_id'] . "'");
			$p_name = mysqli_fetch_assoc($prog_name);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $p_name['name'] . ' (' . $p_name['session_name'] . ')' . $p_name['group']);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->applyFromArray($styleArray); // Apply border

			$total = 0;
			$obt = 0;
			$answers = mysqli_query($conn, "SELECT * FROM `kiusc_eval_std` es 
                                        JOIN `kiusc_eval_questions` eq ON es.question_id=eq.id
                                        JOIN `kiusc_eval_ques_category` eqc on eqc.id=eq.cat_id 
                                        WHERE eqc.eval_type_id=2 and c_offer_id = '" . $co['id'] . "'");
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
				// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col2, $row, $ttl_reg_std);
				// $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col2, $row)->applyFromArray($styleArray); // Apply border

				// $col2++;
				// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col2, $row, $ttl_eval_std);
				// $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col2, $row)->applyFromArray($styleArray); // Apply border

				// $col2++;
				// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col2, $row, round($eva_std_percentage, 2));
				// $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col2, $row)->applyFromArray($styleArray); // Apply border

				$g_total += $total;
				$g_obt += $obt;
				$total_per += $per;

				$row++;
				$sno++;
			} else {
				//continue;
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
		$objPHPExcel->getActiveSheet()->setCellValue('A' . $row, "Faculty Comments");
		$objPHPExcel->getActiveSheet()->mergeCells('A' . $row . ':G' . $row);

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
		$courses_fac = mysqli_query($conn, "SELECT cf.* FROM `kiusc_course_offered` cf join kiusc_evaluation e on cf.sem_id = e.sem_id 
                                      WHERE cf.fac_id = '" . $fac['user_id'] . "' and e.id = '$evl_id' and cf.eva_cat_id !=5");

		while ($co = mysqli_fetch_assoc($courses_fac)) {
			// Get course name
			$course_name = mysqli_query($conn, "SELECT c.name FROM `kiusc_courses` c 
                                        join kiusc_course_offered cf on c.id= cf.course_id 
                                        WHERE cf.id = '" . $co['id'] . "' and cf.eva_cat_id !=5");
			$c_name = mysqli_fetch_assoc($course_name);



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
			$answers = mysqli_query($conn, "SELECT * FROM `kiusc_evaluation_std_comments`
                                    WHERE eval_type_id=2 and  c_offer_id = '" . $co['id'] . "' and emp_user_id='" . $fac['user_id'] . "'");
			$facsno = 1;



			while ($ans = mysqli_fetch_assoc($answers)) {
				$fac_comments = $ans['comments'];
				$objPHPExcel->getActiveSheet()->setCellValue('A' . $row, ''); // Blank faculty name for comments row
				$objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $facsno++); // Blank s.no for comments row
				$objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $fac_comments); // Set student comment
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
		$eval_ques_category = mysqli_query($conn, "SELECT * FROM `kiusc_eval_ques_category` WHERE `eval_type_id`=2");
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
			$fac_cat_sum_ans = 0;
			$fac_cat_sum_ques = 0;
			foreach ($courseofrid as $col_index => $cf_id) {

				$eval_fac_category = mysqli_query($conn, "SELECT count(question_id)*3 as sum_questions, sum(ans) as sum_ans FROM `kiusc_eval_std` estd
														join kiusc_eval_questions eq on eq.id=estd.question_id
														WHERE eq.cat_id='" . $ecat['id'] . "' and estd.eval_type_id=2 and c_offer_id = '" . $cf_id . "'");
				$eval_fac_cat = mysqli_fetch_assoc($eval_fac_category);
				$eval_fac_cat_count = mysqli_num_rows($eval_fac_category);
				$fac_cat_sum_ans = $eval_fac_cat['sum_ans'];
				$fac_cat_sum_ques = $eval_fac_cat['sum_questions'];
				// Define the border style
				$styleArray = array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN,
							'color' => array('argb' => 'FF000000'),
						),
					),

				);

				$percentage = round($fac_cat_sum_ans / $fac_cat_sum_ques * 100, 2);
				if ($eval_fac_cat_count > 0) {
					if ($percentage > 0) {

						$objPHPExcel->getActiveSheet()->setCellValue($columns_array[$col_index] . $row, $percentage);
					} else {
						$objPHPExcel->getActiveSheet()->setCellValue($columns_array[$col_index] . $row, "^NE");

					}
				} else {
					$objPHPExcel->getActiveSheet()->setCellValue($columns_array[$col_index] . $row, "^NQE");

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

unset($sheet1);
$objPHPExcel->removeSheetByIndex(0);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

header('Location: downloadFile.php?s=' . $name_for_download);
?>