<?php
global $conn;
$conn = @mysqli_connect('127.0.0.1','root','bus@2017**', 'uobs-db');
if (!$conn) {
	die('Could not connect: ' . mysqli_error());
}

error_reporting(0);
function ins_upd_del($query)
{
	
	global $conn;
    $result = mysqli_query($conn, $query);
	return $result;
}

function getSingleRow($query)
{
	global $conn;
	$re = mysqli_query($conn, $query);
	$re = mysqli_fetch_assoc($re);
	return $re;
}

function getMultipleRows($query)
{
	global $conn;
	$re = mysqli_query($conn, $query);
	$result = array();
	while($row = mysqli_fetch_assoc($re))
	{
		array_push($result, $row);
	}
	
	return $result;
}

function getAsObject($query)
{
	global $conn;
	$re = mysqli_query($conn, $query);
	$result = array();
	while($row = mysqli_fetch_object($re)){
		array_push($result, $row);
	}
	
	return $result;
}


function no_of_rows($query)
{
	global $conn;
	$re = mysqli_query($conn, $query);
	$rows = mysqli_num_rows($re);
	return $rows;
}

?>

