<?php

$id = intval($_REQUEST['id']);

include '../../conn.php';

$cat = mysqli_query($conn, "SELECT * FROM `kiusc_tel_directory_cat` WHERE `cat_id` = '$id'");
$no_rows = mysqli_num_rows($cat);

if($no_rows < 1)
{
	$sql = "DELETE FROM `kiusc_tel_categories` WHERE id = '$id'";
	@mysqli_query($conn, $sql);
	echo json_encode(array('success'=>true));
}
else
{
	echo "<script> alert('You can not delete category having child entries!') </script>";
	echo json_encode(array('success'=>false));
}
?>