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


$name_for_download = 'Evaluation Report -' . $semester;
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
		while ($co = mysqli_fetch_assoc($courses)) {


			$total_registered_std = mysqli_query($conn, "SELECT * FROM `kiusc_results` where c_offer_id = '" . $co['id'] . "'");
			$ttl_reg_std = mysqli_num_rows($total_registered_std);
			// if($ttl_reg_std=0)
			// 	$ttl_reg_std=1;
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
												WHERE c_offer_id = '" . $co['id'] . "'");
				$count = mysqli_num_rows($answers);
				if ($count > 0) {
					while ($ans = mysqli_fetch_assoc($answers)) {

						if ($ans['cat_id'] == 1) {
							$cat1_questions++;
							$cat1 = $cat1 + (int) decrypt($ans['ans']);
						} elseif ($ans['cat_id'] == 2) {
							$cat2_questions++;
							$cat2 = $cat2 + (int) decrypt($ans['ans']);
						} elseif ($ans['cat_id'] == 3) {
							$cat3_questions++;
							$cat3 = $cat3 + (int) decrypt($ans['ans']);
						} elseif ($ans['cat_id'] == 4) {
							$cat4_questions++;
							$cat4 = $cat4 + (int) decrypt($ans['ans']);
						} elseif ($ans['cat_id'] == 5) {
							$cat5_questions++;
							$cat5 = $cat5 + (int) decrypt($ans['ans']);

						} elseif ($ans['cat_id'] == 6) {
							$cat6_questions++;
							$cat6 = $cat6 + (int) decrypt($ans['ans']);

						} elseif ($ans['cat_id'] == 7) {
							$cat7_questions++;
							$cat7 = $cat7 + (int) decrypt($ans['ans']);

						} elseif ($ans['cat_id'] == 8) {
							$cat8_questions++;
							$cat8 = $cat8 + (int) decrypt($ans['ans']);

						} elseif ($ans['cat_id'] == 9) {
							$cat9_questions++;
							$cat9 = $cat9 + (int) decrypt($ans['ans']);


						}

						$total += 3;
						$obt += (int) decrypt($ans['ans']);
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
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col2, $row, $ttl_reg_std);
					$col2++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col2, $row, $ttl_eval_std);
					$col2++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col2, $row, round($eva_std_percentage, 2));

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
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $ttl_reg_std);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $ttl_eval_std);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, round($eva_std_percentage, 2));

					$row++;
					$sno++;
				}
			}
		}
		$comp_tech_prof = ($total_per / $total_courses);
		$comp_tech_prof = round($comp_tech_prof, 2);

		$std_participants_lvl = ($total_participated_std_percentage / $total_courses);
		$std_participant_lvl = round($std_participants_lvl, 2);
		// echo $cat1.'<br>'.($cat1_questions*3).'<br>';
		// echo ($cat1/($cat1_questions*3))*100;
		//return;
		$feedback = "";

		if ($cat1_questions == 0)
			$cat1_questions = 1;
		if ($cat2_questions == 0)
			$cat2_questions = 1;
		if ($cat3_questions == 0)
			$cat3_questions = 1;
		if ($cat4_questions == 0)
			$cat4_questions = 1;
		if ($cat5_questions == 0)
			$cat5_questions = 1;
		if ($cat6_questions == 0)
			$cat6_questions = 1;
		if ($cat7_questions == 0)
			$cat7_questions = 1;
		if ($cat8_questions == 0)
			$cat8_questions = 1;
		if ($cat9_questions == 0)
			$cat9_questions = 1;



		$cat1_quest = (($cat1 / ($cat1_questions * 3)) * 100);
		$t = 1;
		$eva_fb = mysqli_query($conn, "SELECT * FROM `kiusc_eval_feedback` where cat_id=1 and  min < '$cat1_quest' and max >= '$cat1_quest'");
		$evafb = mysqli_fetch_assoc($eva_fb);
		if ($cat1_quest > 0) {
			$feedback = $t . ') ' . $evafb['feedback'];
			$t++;
		}

		$cat2_quest = (($cat2 / ($cat2_questions * 3)) * 100);

		$eva_fb = mysqli_query($conn, "SELECT * FROM `kiusc_eval_feedback` where cat_id=2 and min <= '$cat2_quest' and max >= '$cat2_quest'");
		$evafb = mysqli_fetch_assoc($eva_fb);
		if ($cat2_quest > 0) {
			$feedback = $feedback . "\n" . $t . ") " . $evafb['feedback'];
			$t++;
		}

		$cat3_quest = (($cat3 / ($cat3_questions * 3)) * 100);
		$eva_fb = mysqli_query($conn, "SELECT * FROM `kiusc_eval_feedback` where cat_id=3 and min < '$cat3_quest' and max >= '$cat3_quest'");
		$evafb = mysqli_fetch_assoc($eva_fb);
		if ($cat3_quest > 0) {
			$feedback = $feedback . "\n" . $t . ') ' . $evafb['feedback'];
			$t++;
		}

		$cat4_quest = (($cat4 / ($cat4_questions * 3)) * 100);
		$eva_fb = mysqli_query($conn, "SELECT * FROM `kiusc_eval_feedback` where cat_id=4 and min < '$cat4_quest' and max >= '$cat4_quest'");
		$evafb = mysqli_fetch_assoc($eva_fb);
		if ($cat4_quest > 0) {
			$feedback = $feedback . "\n" . $t . ') ' . $evafb['feedback'];
			$t++;
		}

		$cat5_quest = (($cat5 / ($cat5_questions * 3)) * 100);
		$eva_fb = mysqli_query($conn, "SELECT * FROM `kiusc_eval_feedback` where cat_id=5 and min < '$cat5_quest' and max >= '$cat5_quest'");
		$evafb = mysqli_fetch_assoc($eva_fb);
		if ($cat5_quest > 0) {
			$feedback = $feedback . "\n" . $t . ') ' . $evafb['feedback'];
			$t++;
		}

		$cat6_quest = (($cat6 / ($cat6_questions * 3)) * 100);
		$eva_fb = mysqli_query($conn, "SELECT * FROM `kiusc_eval_feedback` where cat_id=6 and min < '$cat6_quest' and max >= '$cat6_quest'");
		$evafb = mysqli_fetch_assoc($eva_fb);
		if ($cat6_quest > 0) {
			$feedback = $feedback . "\n" . $t . ') ' . $evafb['feedback'];
			$t++;
		}

		$cat7_quest = (($cat7 / ($cat7_questions * 3)) * 100);
		$eva_fb = mysqli_query($conn, "SELECT * FROM `kiusc_eval_feedback` where cat_id=7 and min < '$cat7_quest' and max >= '$cat7_quest'");
		$evafb = mysqli_fetch_assoc($eva_fb);
		if ($cat7_quest > 0) {
			$feedback = $feedback . "\n" . $t . ') ' . $evafb['feedback'];
			$t++;
		}

		$cat8_quest = (($cat8 / ($cat8_questions * 3)) * 100);
		$eva_fb = mysqli_query($conn, "SELECT * FROM `kiusc_eval_feedback` where cat_id=8 and min < '$cat8_quest' and max >= '$cat8_quest'");
		$evafb = mysqli_fetch_assoc($eva_fb);
		if ($cat8_quest > 0) {
			$feedback = $feedback . "\n" . $t . ') ' . $evafb['feedback'];
			$t++;
		}

		$cat9_quest = (($cat9 / ($cat9_questions * 3)) * 100);
		$eva_fb = mysqli_query($conn, "SELECT * FROM `kiusc_eval_feedback` where cat_id=9 and min < '$cat9_quest' and max >= '$cat9_quest'");
		$evafb = mysqli_fetch_assoc($eva_fb);
		if ($cat9_quest > 0) {
			$feedback = $feedback . "\n" . $t . ') ' . $evafb['feedback'];
			$t++;
		}



		$row++;

		$std_part_comment = '';
		if ($std_participant_lvl <= 20) {
			$std_part_comment = 'Malfunctioning & motivation less   (MML)';
		} elseif ($std_participant_lvl > 20 && $std_participant_lvl < 60) {
			$std_part_comment = 'Needs improvement   (NIP)';
		} elseif ($std_participant_lvl >= 60 && $std_participant_lvl < 80) {
			$std_part_comment = 'Good   (G)';
		} elseif ($std_participant_lvl >= 80 && $std_participant_lvl < 90) {
			$std_part_comment = 'Very good   (VG)';
		} elseif ($std_participant_lvl >= 90 && $std_participant_lvl < 95) {
			$std_part_comment = 'Excellent   (EXL)';
		} elseif ($std_participant_lvl >= 95) {
			$std_part_comment = 'Outstanding   (OST)';
		}

		// $g_per = 0;
		// if($g_total > 0)
		// 		$g_per = round($g_obt / $g_total * 100,2);

		$comment = '';
		if ($comp_tech_prof < 40) {
			$comment = 'Fail   (F)';
		} elseif ($comp_tech_prof >= 40 && $comp_tech_prof < 50) {
			$comment = 'Needs improvement   (NIP)';
		} elseif ($comp_tech_prof >= 50 && $comp_tech_prof < 60) {
			$comment = 'Satisfactory   (SF)';
		} elseif ($comp_tech_prof >= 60 && $comp_tech_prof < 70) {
			$comment = 'Good   (G)';
		} elseif ($comp_tech_prof >= 70 && $comp_tech_prof < 80) {
			$comment = 'Very good   (VG)';
		} elseif ($comp_tech_prof >= 80 && $comp_tech_prof < 90) {
			$comment = 'Excellent   (EXL)';
		} elseif ($comp_tech_prof >= 90 && $comp_tech_prof < 95) {
			$comment = 'Outstanding   (OST)';
		} elseif ($comp_tech_prof >= 95) {
			$comment = 'Exceptional   (EXP)';
		}

		$objPHPExcel->getActiveSheet()->setcellValue('A' . $row, 'Comprehensive Teaching Proficiency');
		$objPHPExcel->getActiveSheet()->mergeCells('A' . $row . ':' . 'C' . $row);
		$objPHPExcel->getActiveSheet()->getStyle('A' . $row)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setcellValue('D' . $row, $comp_tech_prof . ' (' . $comment . ')');
		$objPHPExcel->getActiveSheet()->getStyle('D' . $row)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->mergeCells('D' . $row . ':' . 'J' . $row);

		$row++;
		$objPHPExcel->getActiveSheet()->setcellValue('A' . $row, 'Students’ Participation Level');
		$objPHPExcel->getActiveSheet()->getStyle('A' . $row)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->mergeCells('A' . $row . ':' . 'C' . $row);
		$objPHPExcel->getActiveSheet()->setcellValue('D' . $row, $std_participant_lvl . ' (' . $std_part_comment . ')');
		$objPHPExcel->getActiveSheet()->getStyle('D' . $row)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->mergeCells('D' . $row . ':' . 'J' . $row);

		// $i=0;
		// $row++;
		// for($i=$row; $i<16; $i++)
		// {
		// 	$objPHPExcel->getActiveSheet()->mergeCells('A'.$row .':'. 'J'.$row);
		// 	$row++;
		// }

		$row = 18;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('A', $row, 'Self-Generated Teaching Performance Feedback on SIS (based on Interrogative Proforma)');
		$row++;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('A', $row, $feedback);
		//$objPHPExcel->getActiveSheet()->mergeCells('A'.$row .':'. 'F'.$row);
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