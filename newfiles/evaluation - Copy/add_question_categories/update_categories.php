<?php

$id = intval($_REQUEST['id']);
$name = $_REQUEST['name'];

include '../../conn.php';

$sql = "UPDATE `kiusc_eval_ques_category` SET `name`='$name' WHERE id=$id";
@mysqli_query($conn,$sql);
echo json_encode(array(
	'id' => $id,
	'name' => $name));
?>