<?php

$id = intval($_REQUEST['id']);
$designation = $_REQUEST['designation'];
$type = $_REQUEST['type'];

include '../../conn.php';

$sql = "UPDATE `kiusc_designations` SET `designation`='$designation', `type`='$type'  WHERE id=$id";
@mysqli_query($conn,$sql);
echo json_encode(array(
	'id' => $id,
	'designation' => $designation,
	'type' => $type));
?>