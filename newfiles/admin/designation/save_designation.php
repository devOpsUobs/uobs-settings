<?php

$designation = $_REQUEST['designation'];
$type = $_REQUEST['type'];

include '../../conn.php';

$sql = "INSERT INTO `kiusc_designations`(`id`, `designation`, `type`) VALUES (NULL,'$designation','$type')";
@mysqli_query($conn,$sql);
echo json_encode(array(
	'id' => mysqli_insert_id($conn),
	'designation' => $designation,
	'type' => $type));

?>