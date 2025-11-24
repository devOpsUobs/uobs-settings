<?php

	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'category';
	$order = isset($_POST['order']) ? strval($_POST['category']) : 'asc';
	$offset = ($page-1)*$rows;
	
	$result = array();
	
	include '../../conn.php';
	
	$result["total"] = no_of_rows("SELECT * FROM `uobs_stck_category`");
		
	$rs = getAsObject("SELECT * FROM `uobs_stck_category` order by $sort $order"); // limit $offset,$rows
	
	$items = array();
	foreach($rs as $row){
		array_push($items, $row);
	}
	$result["rows"] = $items;
	
	echo json_encode($result);
?>