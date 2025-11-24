<?php


/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

//date_default_timezone_set('Europe/London');

/** PHPExcel_IOFactory */
//require_once dirname(__FILE__) . '/../Classes/PHPExcel/IOFactory.php';
require_once '../../../../libraries/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
include '../../../../newfiles/conn.php';


//echo date('H:i:s') , " Load from Excel5 template" , EOL;
$objReader = PHPExcel_IOFactory::createReader('Excel5');
$objPHPExcel = $objReader->load("employee_reports.xls");


$objPHPExcel->getActiveSheet()->setcellValue('B4', 'Verified Profiles');
$row = 5;
$sno = 1;
$employees = mysqli_query($conn, "SELECT * FROM `kiusc_employees` where employment_nature !='Visiting' and verified=1");
//$employees = mysqli_query($conn, "SELECT * FROM `kiusc_employees` where employment_nature !='Visiting' and completed=1 and verified=0");
while($emp = mysqli_fetch_assoc($employees))
{
	$emp_id = $emp['id'];
	$pic_status = $emp['picture'];
		
	$objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
	$objPHPExcel->getActiveSheet()->setcellValue('A'.$row, $sno);
	$objPHPExcel->getActiveSheet()->setcellValue('B'.$row, $emp["first_name"] .' '. $emp["last_name"]);
	$objPHPExcel->getActiveSheet()->setcellValue('C'.$row, $emp["fname"]);
	$objPHPExcel->getActiveSheet()->setcellValue('D'.$row, $emp["cnic"]);
	$objPHPExcel->getActiveSheet()->setcellValue('E'.$row, $emp["employment_scale"]);
	$objPHPExcel->getActiveSheet()->setcellValue('F'.$row, $emp["pay_scale"]);
	$objPHPExcel->getActiveSheet()->setcellValue('G'.$row, $emp["employment_nature"]);
	$objPHPExcel->getActiveSheet()->setcellValue('H'.$row, $emp["employee_categories"]);
	// if($pic_status == "")
	// {
	// 	$objPHPExcel->getActiveSheet()->setcellValue('E'.$row, 'Profile Does Not Updated');
	// }
	// else
	// {
	// 	$objPHPExcel->getActiveSheet()->setcellValue('E'.$row, 'Profile Updated');
	// }
	// $designations = mysqli_query($conn,"SELECT * FROM `kiusc_emp_designations` where emp_id='$emp_id'");
	// $desg = mysqli_num_rows($designations);
	// if($desg > 0)
	// {
	// 	$objPHPExcel->getActiveSheet()->setcellValue('F'.$row, 'Designation Updated');
	// }
	// else
	// {
	// 	$objPHPExcel->getActiveSheet()->setcellValue('F'.$row, 'Designation Doest Not Updated');
	// }
	// $educations = mysqli_query($conn,"SELECT * FROM `kiusc_emp_educations` where emp_id='$emp_id'");
	// $edu = mysqli_num_rows($educations);
	// if($edu > 0)
	// {
	// $objPHPExcel->getActiveSheet()->setcellValue('G'.$row, 'Education Updated');
	// }
	// else
	// {
	// $objPHPExcel->getActiveSheet()->setcellValue('G'.$row, 'Education Doest Not Updated');
	// }

	$row++;
	$sno++;
}
$row++;
$objPHPExcel->getActiveSheet()->setcellValue('B'.$row, 'In-completed Profiles');
$row++;
$sno = 1;
$employees = mysqli_query($conn, "SELECT * FROM `kiusc_employees` where employment_nature !='Visiting' and completed=0 and verified=0");
while($emp = mysqli_fetch_assoc($employees))
{
	$emp_id = $emp['id'];
	$pic_status = $emp['picture'];
		
	$objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
	$objPHPExcel->getActiveSheet()->setcellValue('A'.$row, $sno);
	$objPHPExcel->getActiveSheet()->setcellValue('B'.$row, $emp["first_name"] .' '. $emp["last_name"]);
	$objPHPExcel->getActiveSheet()->setcellValue('C'.$row, $emp["fname"]);
	$objPHPExcel->getActiveSheet()->setcellValue('D'.$row, $emp["cnic"]);
	$objPHPExcel->getActiveSheet()->setcellValue('E'.$row, $emp["employment_scale"]);
	$objPHPExcel->getActiveSheet()->setcellValue('F'.$row, $emp["pay_scale"]);
	$objPHPExcel->getActiveSheet()->setcellValue('G'.$row, $emp["employment_nature"]);
	$objPHPExcel->getActiveSheet()->setcellValue('H'.$row, $emp["employee_categories"]);

	// if($pic_status == "")
	// {
	// 	$objPHPExcel->getActiveSheet()->setcellValue('E'.$row, 'Profile Does Not Updated');
	// }
	// else
	// {
	// 	$objPHPExcel->getActiveSheet()->setcellValue('E'.$row, 'Profile Updated');
	// }
	// $designations = mysqli_query($conn,"SELECT * FROM `kiusc_emp_designations` where emp_id='$emp_id'");
	// $desg = mysqli_num_rows($designations);
	// if($desg > 0)
	// {
	// 	$objPHPExcel->getActiveSheet()->setcellValue('F'.$row, 'Designation Updated');
	// }
	// else
	// {
	// 	$objPHPExcel->getActiveSheet()->setcellValue('F'.$row, 'Designation Doest Not Updated');
	// }
	// $educations = mysqli_query($conn,"SELECT * FROM `kiusc_emp_educations` where emp_id='$emp_id'");
	// $edu = mysqli_num_rows($educations);
	// if($edu > 0)
	// {
	// $objPHPExcel->getActiveSheet()->setcellValue('G'.$row, 'Education Updated');
	// }
	// else
	// {
	// $objPHPExcel->getActiveSheet()->setcellValue('G'.$row, 'Education Doest Not Updated');
	// }

	$row++;
	$sno++;
}
$row++;
$objPHPExcel->getActiveSheet()->setcellValue('B'.$row, 'Completed Profiles');
$row++;
$sno = 1;
$employees = mysqli_query($conn, "SELECT * FROM `kiusc_employees` where employment_nature !='Visiting' and completed=1 and verified=0");

//$employees = mysqli_query($conn, "SELECT * FROM `kiusc_employees` where employment_nature !='Visiting' and verified=1");
while($emp = mysqli_fetch_assoc($employees))
{
	$emp_id = $emp['id'];
	$pic_status = $emp['picture'];
		
	$objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
	$objPHPExcel->getActiveSheet()->setcellValue('A'.$row, $sno);
	$objPHPExcel->getActiveSheet()->setcellValue('B'.$row, $emp["first_name"] .' '. $emp["last_name"]);
	$objPHPExcel->getActiveSheet()->setcellValue('C'.$row, $emp["fname"]);
	$objPHPExcel->getActiveSheet()->setcellValue('D'.$row, $emp["cnic"]);
	$objPHPExcel->getActiveSheet()->setcellValue('E'.$row, $emp["employment_scale"]);
	$objPHPExcel->getActiveSheet()->setcellValue('F'.$row, $emp["pay_scale"]);
	$objPHPExcel->getActiveSheet()->setcellValue('G'.$row, $emp["employment_nature"]);
	$objPHPExcel->getActiveSheet()->setcellValue('H'.$row, $emp["employee_categories"]);
	// if($pic_status == "")
	// {
	// 	$objPHPExcel->getActiveSheet()->setcellValue('E'.$row, 'Profile Does Not Updated');
	// }
	// else
	// {
	// 	$objPHPExcel->getActiveSheet()->setcellValue('E'.$row, 'Profile Updated');
	// }
	// $designations = mysqli_query($conn,"SELECT * FROM `kiusc_emp_designations` where emp_id='$emp_id'");
	// $desg = mysqli_num_rows($designations);
	// if($desg > 0)
	// {
	// 	$objPHPExcel->getActiveSheet()->setcellValue('F'.$row, 'Designation Updated');
	// }
	// else
	// {
	// 	$objPHPExcel->getActiveSheet()->setcellValue('F'.$row, 'Designation Doest Not Updated');
	// }
	// $educations = mysqli_query($conn,"SELECT * FROM `kiusc_emp_educations` where emp_id='$emp_id'");
	// $edu = mysqli_num_rows($educations);
	// if($edu > 0)
	// {
	// $objPHPExcel->getActiveSheet()->setcellValue('G'.$row, 'Education Updated');
	// }
	// else
	// {
	// $objPHPExcel->getActiveSheet()->setcellValue('G'.$row, 'Education Doest Not Updated');
	// }

	$row++;
	$sno++;
}

////////////////////


$styleArray = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);

$fromCell = PHPExcel_Cell::stringFromColumnIndex(0) . 6;
$toCell = PHPExcel_Cell::stringFromColumnIndex(4) . ($row-1);

    $cellRange = $fromCell . ':' . $toCell;
	

$objPHPExcel->getActiveSheet()->getStyle($cellRange)->applyFromArray($styleArray);

//$objPHPExcel->getActiveSheet()->insertNewColumnBeforeByIndex($col, 1);
//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $lec['date']);	

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

header('Location: downloadFile.php?fac=Report');

?>
