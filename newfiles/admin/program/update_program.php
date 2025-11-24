<?php

$id = intval($_REQUEST['id']);
$name = $_REQUEST['name'];
$group = $_REQUEST['group'];
$session = $_REQUEST['session'];
$session_name = $_REQUEST['session_name'];
$dep_id = $_REQUEST['dep_id'];
$dep_name = $_REQUEST['dep_name'];
$degree_title_id = $_REQUEST['degree_title_id'];
$degree_title = $_REQUEST['degree_title'];

include '../../conn.php';

$sql = "UPDATE `kiusc_programs` SET `dep_id`='$dep_id',`name`='$name',`group`='$group',`session`='$session',
`session_name`='$session_name',`degree_title_id`='$degree_title_id' WHERE id=$id";
@mysqli_query($conn,$sql);
echo json_encode(array(
	'id' => $id,
	'name' => $name,
	'group' => $group,
	'session' => $session,
	'session_name' => $session_name,
	'dep_id' => $dep_id,
	'dep_name' => $dep_name,
	'degree_title_id' => $degree_title_id,
	'degree_title' => $degree_title));
?>