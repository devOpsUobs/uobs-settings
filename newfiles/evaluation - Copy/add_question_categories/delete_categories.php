<?php

$id = intval($_REQUEST['id']);

include '../../conn.php';

$result = mysqli_query($conn,"SELECT * FROM kiusc_eval_ques_category where eval_type_id = '$id'");
$num_rows = mysqli_num_rows($result);

if($num_rows < 1)
{
	$sql = "DELETE FROM `kiusc_eval_ques_category` WHERE id=$id";
	@mysqli_query($conn,$sql);
	echo json_encode(array('success'=>true));
}
else
	echo json_encode(array('success'=>false));
?>