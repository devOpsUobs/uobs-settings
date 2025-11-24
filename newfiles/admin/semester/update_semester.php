<?php

$id = intval($_REQUEST['id']);

$sem_name = $_REQUEST['sem_name'];
$start_date = $_REQUEST['start_date'];
$mid_term_date = $_REQUEST['mid_term_date'];
$final_term_date = $_REQUEST['final_term_date'];
$result_date = $_REQUEST['result_date'];

if(isset($_REQUEST['course_offer']))
	$course_offer = $_REQUEST['course_offer'];
else
	$course_offer = 0;

if(isset($_REQUEST['course_reg']))
	$course_reg = $_REQUEST['course_reg'];
else
	$course_reg = 0;

if(isset($_REQUEST['mid_term']))
	$mid_term = $_REQUEST['mid_term'];
else
	$mid_term = 0;

if(isset($_REQUEST['final_term']))
	$final_term = $_REQUEST['final_term'];
else
	$final_term = 0;

if(isset($_REQUEST['active']))
	$active = $_REQUEST['active'];
else
	$active = 0;
	
if(isset($_REQUEST['result_declare']))
	$result_declare = $_REQUEST['result_declare'];
else
	$result_declare = 0;
	
	

include '../../conn.php';

$sql = "UPDATE `kiusc_semesters` SET `sem_name`='$sem_name', `start_date`='$start_date', `mid_term_date`='$mid_term_date', 
`final_term_date`='$final_term_date', `course_offer`='$course_offer', `course_reg`='$course_reg', `mid_term`='$mid_term', 
`final_term`='$final_term', `active`='$active' , `result_declare`='$result_declare', `result_date`='$result_date' WHERE id=$id";

@mysqli_query($conn,$sql);
echo json_encode(array(
	'id' => $id,
	'sem_name' => $sem_name,
	'start_date' => $start_date,
	'mid_term_date' => $mid_term_date,
	'final_term_date' => $final_term_date,
	'course_offer' => $course_offer,
	'course_reg' => $course_reg,
	'mid_term' => $mid_term,
	'final_term' => $final_term,
	'active' => $active,
	'result_declare' => $result_declare,
	'result_date' => $result_date));

?>