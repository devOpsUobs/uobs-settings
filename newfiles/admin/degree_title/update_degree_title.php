<?php

$id = intval($_REQUEST['id']);

$degree_title = $_REQUEST['degree_title'];
$no_of_sem = $_REQUEST['no_of_sem'];
$req_cr_hours = $_REQUEST['req_cr_hours'];
$level = $_REQUEST['level'];
$years = $_REQUEST['years']; 
$f_degree_title = $_REQUEST['f_degree_title']; 

include '../../conn.php';

$sql = "UPDATE `kiusc_degree_titles` SET `degree_title`='$degree_title', `no_of_sem`='$no_of_sem', `req_cr_hours`='$req_cr_hours', 
`level`='$level', `years`='$years', `f_degree_title`='$f_degree_title' WHERE id=$id";

@mysqli_query($conn,$sql);
echo json_encode(array(
	'id' => $id,
	'degree_title' => $degree_title,
	'no_of_sem' => $no_of_sem,
	'req_cr_hours' => $req_cr_hours,
	'level' => $level,
	'years' => $years,
	'f_degree_title' => $f_degree_title));

?>