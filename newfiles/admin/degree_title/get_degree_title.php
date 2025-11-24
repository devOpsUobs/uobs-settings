<?php

	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id';
	$order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
	$offset = ($page-1)*$rows;
	
	$result = array();
	
	include '../../conn.php';
	
	$rs = mysqli_query($conn,"select count(*) from kiusc_degree_titles");
	$row = mysqli_fetch_row($rs);
	$result["total"] = $row[0];
	
	//$rs = mysqli_query($conn,"select * from kiusc_semesters order by $sort $order limit $offset,$rows");
	$rs = mysqli_query($conn,"select * from kiusc_degree_titles order by $sort $order");
	
	$items = array();
	while($row = mysqli_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;
	
	echo json_encode($result);

?>