<?php

$degree_title = $_REQUEST['degree_title'];

include '../../conn.php';

$sql = "INSERT INTO `kiusc_degrees`(`id`, `degree_title`) VALUES (NULL,'$degree_title')";
@mysqli_query($conn,$sql);
echo json_encode(array(
	'id' => mysqli_insert_id($conn),
	'degree_title' => $degree_title));

?>