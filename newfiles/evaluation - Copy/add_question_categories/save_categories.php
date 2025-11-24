<?php

$name = $_REQUEST['name'];

include '../../conn.php';

$sql = "INSERT INTO `kiusc_eval_ques_category`(`id`, `name`) VALUES (NULL,'$name')";
@mysqli_query($conn,$sql);
echo json_encode(array(
	'id' => mysqli_insert_id($conn),
	'name' => $name));

?>