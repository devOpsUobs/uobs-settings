<?php

$name = $_REQUEST['name'];

include '../../conn.php';

$sql = "INSERT INTO `kiusc_tel_categories`(`name`) VALUES ('$name')";
@mysqli_query($conn, $sql);
$id = mysqli_insert_id($conn);
echo json_encode(array(
	'id' => $id,
	'name' => $name));
?>