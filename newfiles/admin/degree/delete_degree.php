<?php

$id = intval($_REQUEST['id']);

include '../../conn.php';

$sql = "DELETE FROM `kiusc_degrees` WHERE id=$id";
@mysqli_query($conn,$sql);
echo json_encode(array('success'=>true));

?>