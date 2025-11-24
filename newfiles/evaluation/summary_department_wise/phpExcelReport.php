<?php
include "../../common.php";
$dept_id = $_REQUEST['sel_dep_id']; 
$evl_id = $_REQUEST['evl_id'];

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
$objPHPExcel = $objReader->load("T_eval_summary.xls");


$dep = mysqli_query($conn,"select * from kiusc_departments where id =". $dept_id);
$dep = mysqli_fetch_assoc($dep);

$objPHPExcel->getActiveSheet()->setcellValue('A4', $dep['name']);

$faculty = mysqli_query($conn,'SELECT u.id, u.name as fac_name FROM `s04cf_users` u join s04cf_user_usergroup_map ugm on u.id = ugm.user_id join s04cf_usergroups g on ugm.group_id = g.id join kiusc_departments d on g.title = d.group WHERE u.block = 0 and d.id = '. $dept_id);

$row = 7;
$sno = 1;
while($fac = mysqli_fetch_assoc($faculty))
{
	//$objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
	$objPHPExcel->getActiveSheet()->setcellValue('A'.$row, $sno);
	$objPHPExcel->getActiveSheet()->setcellValue('B'.$row, $fac['fac_name']);
	
	$courses = mysqli_query($conn,"SELECT cf.* FROM `kiusc_course_offered` cf join kiusc_evaluation e on cf.sem_id = e.sem_id WHERE cf.fac_id = '".$fac['id']."' and e.id = '$evl_id'");
	
	$g_total = 0;
	$g_obt = 0;
	$col = 2; // 2 = C
	while($co = mysqli_fetch_assoc($courses))
	{
		$total = 0;
		$obt = 0;
		$answers = mysqli_query($conn,"SELECT * FROM `kiusc_eval_std` WHERE c_offer_id = '".$co['id']."'");
		while($ans = mysqli_fetch_assoc($answers))
		{
			$total += 3;
			// $obt += decrypt($ans['ans']);
			$obt += $ans['ans'];
		}
		
		$per = 0;
		if($total > 0)
			$per = round($obt / $total * 100,2);
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $per);
	
		$g_total += $total;
		$g_obt += $obt;
		
		$col++;
	}
	
	$g_per = 0;
	if($g_total > 0)
			$g_per = round($g_obt / $g_total * 100,2);
			
	$objPHPExcel->getActiveSheet()->setcellValue('I'.$row, $col-2);
	$objPHPExcel->getActiveSheet()->setcellValue('J'.$row, $g_per);
	
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
$toCell = PHPExcel_Cell::stringFromColumnIndex(9) . ($row - 1);

    $cellRange = $fromCell . ':' . $toCell;
	

$objPHPExcel->getActiveSheet()->getStyle($cellRange)->applyFromArray($styleArray);

//$objPHPExcel->getActiveSheet()->insertNewColumnBeforeByIndex($col, 1);
//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $lec['date']);	

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

header('Location: downloadFile.php?d='.$dep['name']);

?>
