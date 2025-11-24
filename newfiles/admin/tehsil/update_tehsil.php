<?php

$id = intval($_REQUEST['id']);
$name = $_REQUEST['name'];
$district_id = $_REQUEST['district_id'];
$district_name = $_REQUEST['district_name'];

include '../../conn.php';

$sql = "UPDATE `kiusc_tehsils` SET `district_id`='$district_id', `name`='$name' WHERE id=$id";
@mysqli_query($conn,$sql);
echo json_encode(array(
	'id' => $id,
	'name' => $name,
	'district_id' => $district_id,
	'district_name' => $district_name));
?>