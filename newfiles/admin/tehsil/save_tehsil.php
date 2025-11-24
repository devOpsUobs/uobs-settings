<?php

$name = $_REQUEST['name'];
$district_id = $_REQUEST['district_id'];
$district_name = $_REQUEST['district_name'];

include '../../conn.php';

$sql = "INSERT INTO `kiusc_tehsils`(`id`, `name`, `district_id`) VALUES (NULL,'$name','$district_id')";
@mysqli_query($conn,$sql);
echo json_encode(array(
	'id' => mysqli_insert_id($conn),
	'name' => $name,
	'district_id' => $district_id,
	'district_name' => $district_name));

?>