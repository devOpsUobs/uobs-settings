<?php
include "../../conn.php";

$dept = $_POST['department_id'];

$re = mysqli_query($conn,"select * from kiusc_programs where dep_id = '$dept'");

	
	$items = array();
	while($row = mysqli_fetch_object($re)){
	  //$row->dob=date("m/d/Y", strtotime($row->dob));
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);
	
?>