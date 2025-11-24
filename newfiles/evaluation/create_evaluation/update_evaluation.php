<?php

$id = intval($_REQUEST['id']);
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

$sql = "UPDATE `kiusc_evaluation` SET `description`='$description', `start_date`='$start_date', `end_date`='$end_date', `sem_id`='$sem_id', `enable_std`='$enable_std',`enable_fac`='$enable_fac', `active`='$active' WHERE id=$id";
@mysqli_query($conn, $sql);
echo json_encode(array(
	'id' => $id,
	'description' => $description,
	'start_date' => $start_date,
	'end_date' => $end_date,
	'sem_name' => $sem_name,
	'enable_std' => $enable_std,
	'enable_fac' => $enable_fac,
	'active' => $active
));
?>