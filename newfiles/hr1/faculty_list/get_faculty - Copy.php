<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'name';
	$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
	
	$offset = ($page-1)*$rows;
	$result = array();

	include '../../conn.php';
	
	$type = $_GET['type'];
	$adm_dep_id = $_GET['adm_dep_id'];
	$acc_dep_id = $_GET['acc_dep_id'];
	$desg_id = $_GET['desg_id'];
	$employment_nature = $_GET['employment_nature'];
	$mode_of_employment = $_GET['mode_of_employment'];
	$employment_scale = $_GET['employment_scale'];

	
	//$rs = mysqli_query($conn,"select count(*) from kiusc_employees");
	//$row = mysqli_fetch_row($rs);
	//$result["total"] = $row[0];
	
	if($type == 'All')
	{
		$rs = mysqli_query($conn,"select u.username, e.*, d.designation from s04cf_users u 
		join kiusc_employees e on u.id = e.user_id 
		join kiusc_emp_designations ed on e.id = ed.emp_id 
		join kiusc_designations d on ed.designation_id = d.id 
		order by $sort $order");// limit $offset,$rows");
	}
	elseif($adm_dep_id != -1)
	{
		if($adm_dep_id == 0)
		{
			$rs = mysqli_query($conn,"select u.username, e.*, d.designation from s04cf_users u 
			join kiusc_employees e on u.id = e.user_id 
			join kiusc_emp_designations ed on e.id = ed.emp_id 
			join kiusc_designations d on ed.designation_id = d.id 
			where ed.adm_department_id > 0 order by $sort $order");
		}
		else
		{
			$rs = mysqli_query($conn,"select u.username, e.*, d.designation from s04cf_users u 
			join kiusc_employees e on u.id = e.user_id 
			join kiusc_emp_designations ed on e.id = ed.emp_id 
			join kiusc_designations d on ed.designation_id = d.id 
			where ed.adm_department_id = '$adm_dep_id' order by $sort $order");
		}
	}
	elseif($acc_dep_id != -1)
	{
		if($acc_dep_id == 0)
		{
			$rs = mysqli_query($conn,"select u.username, e.*, d.designation from s04cf_users u 
			join kiusc_employees e on u.id = e.user_id 
			join kiusc_emp_designations ed on e.id = ed.emp_id 
			join kiusc_designations d on ed.designation_id = d.id
			where ed.acc_department_id > 0 order by $sort $order");
		}
		else
		{
			$rs = mysqli_query($conn,"select u.username, e.*, d.designation from s04cf_users u 
			join kiusc_employees e on u.id = e.user_id 
			join kiusc_emp_designations ed on e.id = ed.emp_id 
			join kiusc_designations d on ed.designation_id = d.id
			where ed.acc_department_id = '$acc_dep_id' order by $sort $order");
		}
	}

	if($desg_id > 0)
	{
		$rs = mysqli_query($conn,"select u.username, e.*, d.designation from s04cf_users u 
			join kiusc_employees e on u.id = e.user_id 
			join kiusc_emp_designations ed on e.id = ed.emp_id 
			join kiusc_designations d on ed.designation_id = d.id
			where e.designation_id='$desg_id' order by $sort $order");
	}
	if($employment_nature > 0)
	{
		$rs = mysqli_query($conn,"select u.username, e.*, d.designation from s04cf_users u 
			join kiusc_employees e on u.id = e.user_id 
			join kiusc_emp_designations ed on e.id = ed.emp_id 
			join kiusc_designations d on ed.designation_id = d.id
			where e.employment_nature='$employment_nature' order by $sort $order");
	}
	if($mode_of_employment > 0)
	{
		$rs = mysqli_query($conn,"select u.username, e.*, d.designation from s04cf_users u 
			join kiusc_employees e on u.id = e.user_id 
			join kiusc_emp_designations ed on e.id = ed.emp_id 
			join kiusc_designations d on ed.designation_id = d.id
			where e.mode_of_employment='$mode_of_employment' order by $sort $order");
	}
	if($employment_scale > 0)
	{
		$rs = mysqli_query($conn,"select u.username, e.*, d.designation from s04cf_users u 
			join kiusc_employees e on u.id = e.user_id 
			join kiusc_emp_designations ed on e.id = ed.emp_id 
			join kiusc_designations d on ed.designation_id = d.id
			where e.employment_scale='$employment_scale' order by $sort $order");
	}
	$items = array();
	while($row = mysqli_fetch_object($rs)){
	 $row->date_of_joining=date("d/m/Y", strtotime($row->date_of_joining));
	  //$row->dob= date("d/m/Y", strtotime($row->dob))->format('d-m-Y');;
	  
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);

?>