<?php

$description = $_REQUEST['description'];
$start_date = $_REQUEST['start_date'];
$end_date = $_REQUEST['end_date'];
$sem_id = $_REQUEST['sem_id'];

$enable_std = 0;
if (isset($_REQUEST['enable_std']))
	$enable_std = $_REQUEST['enable_std'];
$enable_fac = 0;
if (isset($_REQUEST['enable_fac']))
	$enable_fac = $_REQUEST['enable_fac'];

$active = 0;
if (isset($_REQUEST['active']))
	$active = $_REQUEST['active'];

include '../../conn.php';

$s = mysqli_query($conn, "select * from kiusc_semesters where id = '$sem_id'");
$s = mysqli_fetch_assoc($s);
$sem_name = $s['sem_name'];


$sql = "INSERT INTO `kiusc_evaluation`(`description`, `start_date`, `end_date`, `sem_id`, `enable_std`,`enable_fac`,`active`) VALUES ('$description', '$start_date', '$end_date', '$sem_id', '$enable_std','$enable_fac', '$active')";

@mysqli_query($conn, $sql);
echo json_encode(array(
	'id' => mysqli_insert_id($conn),
	'description' => $description,
	'start_date' => $start_date,
	'end_date' => $end_date,
	'sem_name' => $sem_name,
	'enable_std' => $enable_std,
	'enable_fac' => $enable_fac,
	'active' => $active
));

?>