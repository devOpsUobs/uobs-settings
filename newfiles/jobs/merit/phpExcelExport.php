<?php
$job_id = $_REQUEST['job_id'];


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

$objReader = PHPExcel_IOFactory::createReader('Excel5');
$objPHPExcel = PHPExcel_IOFactory::load("T_merit_list2.xlsx");
//$objPHPExcel = $objReader->load("T_transcript.xls");


$job = mysqli_query($conn,"SELECT * FROM `kiusc_jobs` WHERE id = '$job_id'");
$job = mysqli_fetch_assoc($job);

$objPHPExcel->getActiveSheet()->setcellValue('C4', $job['post']);

$applicant = mysqli_query($conn,"SELECT j.* FROM `kiusc_job_applicants` j
						join `kiusc_job_app_map` jp on j.id = jp.applicant_id WHERE jp.job_id = '$job_id'");

$criteria = mysqli_query($conn,"SELECT c.* FROM `kiusc_jobs` j join kiusc_job_criteria c on c.id = j.criteria_id  WHERE j.id = '$job_id'");
$criteria = mysqli_fetch_assoc($criteria);						
						
mysqli_query($conn,"DELETE FROM `kiusc_job_result`");

$sql = "INSERT INTO `kiusc_job_result`(`app_id`, `name`, `scc_total`, `scc_obt`, `scc_per`, `scc_points`, `hssc_total`, `hssc_obt`, `hssc_per`, `hssc_points`, `bachelor_total`, `bachelor_obt`, `bachelor_per`, `bachelor_points`, `master_total`, `master_obt`, `master_per`, `master_points`, `mphile_per`, `mphil_points`, `phd_points`, `publications`, `experience`, `total_accademics`, `accd_weightage`, `total_test`, `total_interview`, `g_total`, `remarks`) VALUES ("; 

while($app = mysqli_fetch_assoc($applicant))
{
	$sql_v = "";
	$remarks = "";
	$t_accd = 0;
	$g_total = 0;
	$third = "no";
	
	//// ssc ///
	$view = mysqli_query($conn,"SELECT * FROM `job_app_equ_qual` WHERE `app_id` = '".$app['id']."' and equivalent_to = 'ssc'");
	$view = mysqli_fetch_assoc($view);
	
	$sql_v .=  "'". $app['id'] . "',";
	$sql_v .=  "'". $app['name'] . "( " . $app['applicant_no'] . ")',";
	
	if($view['total_marks'] > 0)
	{
		$sql_v .=  "'". $view['total_marks'] . "',";
		$sql_v .=  "'". $view['obt_marks'] . "',";
	}
	else
	{
		$sql_v .=  "'". $view['total_gpa'] . "',";
		$sql_v .=  "'". $view['obt_gpa'] . "',";
	}
	
	$sql_v .=  "'". $view['percentage'] . "',";
	
	$temp = round($view['percentage'] / 100 * $criteria['ssc'],2);
	$sql_v .=  "'". $temp .  "',";
	
	$t_accd += $temp;
	
	if($view['division'] == '3rd')
		$third = "yes";
	
	//// hssc
	$view = mysqli_query($conn,"SELECT * FROM `job_app_equ_qual` WHERE `app_id` = '".$app['id']."' and equivalent_to = 'hssc'");
	$view = mysqli_fetch_assoc($view);
	
	if($view['total_marks'] > 0)
	{
		$sql_v .=  "'". $view['total_marks'] . "',";
		$sql_v .=  "'". $view['obt_marks'] . "',";
	}
	else
	{
		$sql_v .=  "'". $view['total_gpa'] . "',";
		$sql_v .=  "'". $view['obt_gpa'] . "',";
	}
	
	$sql_v .=  "'". $view['percentage'] . "',";
	
	$temp = round($view['percentage'] / 100 * $criteria['hssc'],2);
	$sql_v .=  "'". $temp . "',";
	
	$t_accd += $temp;
	
	if($view['division'] == '3rd')
		$third = "yes";
	
	//// bachelor
	$view = mysqli_query($conn,"SELECT * FROM `job_app_equ_qual` WHERE `app_id` = '".$app['id']."' and equivalent_to = 'bachelor'");
	$view = mysqli_fetch_assoc($view);
	
	if($view['app_id'])
	{
		if($view['total_marks'] > 0)
		{
			$sql_v .=  "'". $view['total_marks'] . "',";
			$sql_v .=  "'". $view['obt_marks'] . "',";
		}
		else
		{
			$sql_v .=  "'". $view['total_gpa'] . "',";
			$sql_v .=  "'". $view['obt_gpa'] . "',";
		}
		$sql_v .=  "'". $view['percentage'] . "',";
	
		$temp = round($view['percentage'] / 100 * $criteria['bachelor'],2);
		$sql_v .=  "'". $temp . "',";
	
		$t_accd += $temp;
	
		if($view['division'] == '3rd')
			$third = "yes";
	}
	else
	{
			$sql_v .=  "'0','0','0','0',";	
	}
	//// master
	$view = mysqli_query($conn,"SELECT * FROM `job_app_equ_qual` WHERE `app_id` = '".$app['id']."' and equivalent_to = 'master'");
	$view = mysqli_fetch_assoc($view);
	
	if($view['total_marks'] > 0)
	{
		$sql_v .=  "'". $view['total_marks'] . "',";
		$sql_v .=  "'". $view['obt_marks'] . "',";
	}
	else
	{
		$sql_v .=  "'". $view['total_gpa'] . "',";
		$sql_v .=  "'". $view['obt_gpa'] . "',";
	}
	$sql_v .=  "'". $view['percentage'] . "',";
	
	$temp = round($view['percentage'] / 100 * $criteria['master'],2);
	$sql_v .=  "'". $temp . "',";
	
	$t_accd += $temp;
	
	
	if($view['division'] == '3rd')
		$third = "yes";
	if($view['division'] == '2nd')
		$remarks .= 'Master 2nd Division';
		
	//// mphil
	$view = mysqli_query($conn,"SELECT * FROM `job_app_equ_qual` WHERE `app_id` = '".$app['id']."' and equivalent_to = 'mphil'");
	$view = mysqli_fetch_assoc($view);
	
	if($view['app_id'])
	{
		$sql_v .=  "'". $view['percentage'] . "',";
	
		$temp = round($view['percentage'] / 100 * $criteria['mphil'],2);
		$sql_v .=  "'". $temp . "',";
	
		$t_accd += $temp;
	}
	else
	{
		$sql_v .= "'0', " ;
		$sql_v .=  "'0',";
	}
	//////////
	//// Only used for lecturer hiring
	//////////////
	//// phd
	$view = mysqli_query($conn,"SELECT * FROM `job_app_equ_qual` WHERE `app_id` = '".$app['id']."' and equivalent_to = 'phd'");
	$no = mysqli_num_rows($view);
	
	if($no > 0)
	{
		$sql_v .=  "'10',";
	}
	else
		$sql_v .=  "'0',";
	
	/// publications
	
	$publ = mysqli_query($conn,"SELECT * FROM `kiusc_job_publications` WHERE applicant_id = '".$app['id']."' and countable = 'yes'");
	$no = mysqli_num_rows($publ);
	
	$publ_marks = $no * 2;
	
	if($publ_marks > 10)
		$publ_marks = 10;

	$sql_v .=  "'".$publ_marks."',";
	
	/// experience
	$exp = mysqli_query($conn,"SELECT sum(years) as years FROM `kiusc_job_experiences` WHERE `applicant_id` = '".$app['id']."' AND countable = 'yes'");
	$exp = mysqli_fetch_assoc($exp);
	
	$exp_marks = $exp['years'] * 1;
	
	if($exp_marks > 5)
		$exp_marks = 5;
	
	$sql_v .=  "'".$exp_marks."',";
	
	//$g_total += $exp_marks;
	
	
	///// total accademeics
	
	$sql_v .=  "'".$t_accd."',";
	
	///// accd weightage /////
	
	$sql_v .=  "'" . $t_accd ."',";
	
	$g_total += $t_accd;
	
	///// total test
	
		$sql_v .=  "'".$app['test_marks']."',";
		$g_total += $app['test_marks'];
	///// total interview
	
		$sql_v .=  "'".$app['interview']."',";
		$g_total += $app['interview'];
	//// g total
	
	if($app['is_eligible'] == 'no')
	{
		$sql_v .=  "'0',";
		$remarks .= ", Not Eligible: " . $app['reason'];
	}
	else
		$sql_v .=  "'".$g_total."',";

	///// remarks
	if($third == 'yes')
		$remarks .= ", 3rd Division";
		
	$sql_v .=  "'".$remarks."')";

	mysqli_query($conn,$sql.$sql_v);
}


$re = mysqli_query($conn,"SELECT * FROM `kiusc_job_result` order by g_total desc");

$s = 0;
$base = 7;
while($row = mysqli_fetch_assoc($re))
{
	$s++;
	$objPHPExcel->getActiveSheet()->setcellValue('A'.$base, $s);
	$objPHPExcel->getActiveSheet()->setcellValue('B'.$base, $row['name']);
	
	$objPHPExcel->getActiveSheet()->setcellValue('C'.$base, $row['scc_per']);
	$objPHPExcel->getActiveSheet()->setcellValue('D'.$base, $row['scc_points']);
	
	$objPHPExcel->getActiveSheet()->setcellValue('E'.$base, $row['hssc_per']);
	$objPHPExcel->getActiveSheet()->setcellValue('F'.$base, $row['hssc_points']);
	
	$objPHPExcel->getActiveSheet()->setcellValue('G'.$base, $row['bachelor_per']);
	$objPHPExcel->getActiveSheet()->setcellValue('H'.$base, $row['bachelor_points']);
	
	$objPHPExcel->getActiveSheet()->setcellValue('I'.$base, $row['master_per']);
	$objPHPExcel->getActiveSheet()->setcellValue('J'.$base, $row['master_points']);
	
	$objPHPExcel->getActiveSheet()->setcellValue('K'.$base, $row['mphile_per']);
	$objPHPExcel->getActiveSheet()->setcellValue('L'.$base, $row['mphil_points']);
	
	$objPHPExcel->getActiveSheet()->setcellValue('M'.$base, $row['accd_weightage']);
	
	$objPHPExcel->getActiveSheet()->setcellValue('N'.$base, $row['total_test']);
	
	$objPHPExcel->getActiveSheet()->setcellValue('O'.$base, $row['total_interview']);
	
	$objPHPExcel->getActiveSheet()->setcellValue('P'.$base, $row['g_total']);

	
	$objPHPExcel->getActiveSheet()->setcellValue('Q'.$base, $row['remarks']);
	
	$base++;
	
	$objPHPExcel->getActiveSheet()->insertNewRowBefore($base,1);
}


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

header('Location: downloadFile.php?r='.$job['post']);

