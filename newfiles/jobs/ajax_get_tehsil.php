<?php
include "../../conn.php";

$dist = $_POST['district_id'];

$re = mysqli_query($conn,"select * from kiusc_tehsils where district_id = '$dist'");
/*
$tehsils = mysqli_fetch_object($re);
//print_r($tehsils);
	
	echo json_encode(array('tehsils' => $tehsils));
	
	*/
	
	$items = array();
	while($row = mysqli_fetch_object($re)){
	  //$row->dob=date("m/d/Y", strtotime($row->dob));
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);
	
?>