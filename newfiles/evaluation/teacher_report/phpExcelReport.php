<?php
ob_start();
include "../../common.php";
$dept_id = $_REQUEST['dept_id']; 
$sem_id = $_REQUEST['sem_id'];
$cf_id = $_REQUEST['cf_id'];


/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

//date_default_timezone_set('Europe/London');

/** PHPExcel_IOFactory */
//require_once dirname(__FILE__) . '/../Classes/PHPExcel/IOFactory.php';
require_once '../../../libraries/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
include '../../conn.php';

//echo date('H:i:s') , " Load from Excel5 template" , EOL;
$objReader = PHPExcel_IOFactory::createReader('Excel5');
$objPHPExcel = $objReader->load("T_teacher_report.xls");

$basic = mysqli_query($conn,"SELECT u.name as fac_name, c.name as course_name, s.sem_name, d.name as dep_name, p.name as prog_name, p.session FROM `kiusc_course_offered` cf join s04cf_users u on cf.fac_id = u.id join kiusc_courses c on cf.course_id = c.id join kiusc_semesters s on cf.sem_id = s.id join kiusc_programs p on cf.prog_id = p.id join kiusc_departments d on p.dep_id = d.id WHERE cf.id = '$cf_id'");

$basic = mysqli_fetch_assoc($basic);

$objPHPExcel->getActiveSheet()->setcellValue('C2', $basic['dep_name']);
$objPHPExcel->getActiveSheet()->setcellValue('G2', $basic['fac_name']);
$objPHPExcel->getActiveSheet()->setcellValue('C3', $basic['course_name']);
$objPHPExcel->getActiveSheet()->setcellValue('G3', $basic['sem_name']);
$objPHPExcel->getActiveSheet()->setcellValue('I3', $basic['prog_name']. "-". $basic['session']);


$cat_ids = array();
$cat_names = array();

$categories = mysqli_query($conn,"SELECT * FROM `kiusc_eval_ques_category`");
while($cat = mysqli_fetch_assoc($categories))
{
	$cat_ids[] = $cat['id'];
	$cat_names[] = $cat['name'];
}

$col = 1; // B = 1;
for($i = 0; $i<count($cat_names); $i++)
{
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 4, $cat_names[$i]);
	$col++;
}

$student = mysqli_query($conn,"select s.* from kiusc_students s join kiusc_results r on s.id = r.stud_id where c_offer_id = '$cf_id'");

$row = 6;
$sno = 1;
$cat_marks = array();
while($std = mysqli_fetch_assoc($student))
{
	$ex = mysqli_query($conn,"SELECT * FROM `kiusc_eval_std` WHERE `std_id`='".$std['id']."' and c_offer_id = '$cf_id'");
	$no_ex = mysqli_num_rows($ex);
	if($no_ex == 0)
		continue;
		
	$objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
	$objPHPExcel->getActiveSheet()->setcellValue('A'.$row, $sno);
	
	$g_total = 0;
	$g_obt = 0;
	$col = 1; // B = 1;
	
	for($i = 0; $i<count($cat_names); $i++)
	{	
		
		$answers = mysqli_query($conn,"SELECT es.* FROM `kiusc_eval_std` es join kiusc_eval_questions q on es.question_id = q.id WHERE c_offer_id = '$cf_id' and std_id = '".$std['id']."' and cat_id = '".$cat_ids[$i]."'"); // group by es.question_id
		
		$obt = 0;
		
		while($ans = mysqli_fetch_assoc($answers))
		{
			$g_total += 3;
			// $obt += decrypt($ans['ans']);
			$obt += $ans['ans'];
			if($sno == 1)
				$cat_marks[$i] += 3;
		}
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $obt);
		$g_obt += $obt;
		
		$col++;
	}
	
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $g_obt);
	$col++;
	
	$per = 0;
	if($g_total > 0)
		$per = round($g_obt/$g_total*100,2);
	
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $per);
	
	
	$row++;
	$sno++;
}

$styleArray = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);

$fromCell = PHPExcel_Cell::stringFromColumnIndex(0) . 7;
$toCell = PHPExcel_Cell::stringFromColumnIndex(8) . ($row - 1);

    $cellRange = $fromCell . ':' . $toCell;

$objPHPExcel->getActiveSheet()->getStyle($cellRange)->applyFromArray($styleArray);


$col = 1;
$row += 2;
for($i=0; $i<count($cat_names); $i++)
{
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $cat_marks[$i]);
	$col++;
}


//$objPHPExcel->getActiveSheet()->insertNewColumnBeforeByIndex($col, 1);
//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $lec['date']);	

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

header('Location: downloadFile.php?d='.$basic['course_name']);

?>
