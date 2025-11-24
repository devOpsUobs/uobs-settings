<?php

$id = intval($_REQUEST['id']);
$category = $_REQUEST['category'];
$description = $_REQUEST['description'];
$active = 0;
if(isset($_REQUEST['active']))
	$active = $_REQUEST['active'];


include '../../conn.php';

$sql = "UPDATE `uobs_stck_category` SET `category`='$category',`description`='$description',`active`='$active' WHERE id =$id";
ins_upd_del($sql);
echo json_encode(array(
	'id' => $id,
	'name' => $name,
	'description' => $description,
	'active' => $active
));
?>