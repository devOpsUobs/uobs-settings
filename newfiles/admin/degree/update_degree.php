<?php

$id = intval($_REQUEST['id']);
$degree_title = $_REQUEST['degree_title'];

include '../../conn.php';

$sql = "UPDATE `kiusc_degrees` SET `degree_title`='$degree_title' WHERE id=$id";
@mysqli_query($conn,$sql);
echo json_encode(array(
	'id' => $id,
	'degree_title' => $degree_title));
?>