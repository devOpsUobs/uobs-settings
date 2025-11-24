<?php
	$cat_ids_str = $_GET['cat_ids'];
	$cat_ids = explode(",", $cat_ids_str);
	
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'name';
	$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
	
	$offset = ($page-1)*$rows;
	$result = array();

	include '../conn.php';
	
	//$rs = mysqli_query($conn,"select count(*) from kiusc_employees");
	//$row = mysqli_fetch_row($rs);
	//$result["total"] = $row[0];
	
	$dir_ids = '-1';
	$cats = mysqli_query($conn,"SELECT * FROM `kiusc_tel_directory_cat` WHERE cat_id = '$cat_ids[0]'");
	while($cat = mysqli_fetch_assoc($cats))
	{
		$directory = mysqli_query($conn, "SELECT * FROM `kiusc_tel_directory_cat` WHERE directory_id = '".$cat['directory_id']."' and cat_id in(".$cat_ids_str.")");
		
		$count_dir = mysqli_num_rows($directory);
		
		if($count_dir == count($cat_ids))
			$dir_ids .= ',' . $cat['directory_id'];
	
	}
	
	$rs = mysqli_query($conn,"SELECT * FROM `kiusc_tel_directory` WHERE id in (" . $dir_ids . ") order by $sort $order");
	
	$items = array();
	while($row = mysqli_fetch_object($rs)){
	 //$row->date_of_joining=date("d/m/Y", strtotime($row->date_of_joining));
	  //$row->dob= date("d/m/Y", strtotime($row->dob))->format('d-m-Y');;
	  
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);

?>