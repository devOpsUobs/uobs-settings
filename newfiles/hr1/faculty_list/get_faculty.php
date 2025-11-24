<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'ed.date_of_joining';
	$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
	
	$offset = ($page-1)*$rows;
	$result = array();

	include '../../conn.php';
	
	$type = $_GET['type'];
	$adm_department_id = $_GET['adm_dep_id'];
	$acc_department_id = $_GET['acc_dep_id'];
	$desg_id = $_GET['desg_id'];
	$employment_nature = $_GET['employment_nature'];
	$mode_of_employment = $_GET['mode_of_employment'];
	$employment_scale = $_GET['employment_scale'];
	//$rs = mysqli_query($conn,"select count(*) from kiusc_employees");
	//$row = mysqli_fetch_row($rs);
	//$result["total"] = $row[0];
	$show=0;
	$where_type = " ";
	if($type != 'All' && $type != NULL)
	{
			$show=1;
			$where_type = " and d.type = '$type'";	
	}
	$where_adm_dep = " ";
	if($adm_department_id != 0 && $adm_department_id != NULL)
	{
		$show=1;
		$where_adm_dep = " and e.adm_department_id = '$adm_department_id'";
	}
	$where_acc_dep = " ";
	if($acc_department_id != 0 && $acc_department_id != NULL)
	{
		$show=1;
		$where_acc_dep = " and e.acc_department_id = '$acc_department_id'";
	}
	$where_desgn = " ";
	if($desg_id != 0 && $desg_id != NULL)
	{
		$show=1;
		$where_desgn = " and e.designation_id = '$desg_id'";
	}
	$where_employment_nature = " ";
	if($employment_nature != 'All' && $employment_nature != NULL)
	{
		$show=1;
		$where_employment_nature = " and e.employment_nature = '$employment_nature'";
	}
	$where_mode_of_employment = " ";
	if($mode_of_employment != 'All' && $mode_of_employment != NULL)
	{
		$show=1;
		$where_mode_of_employment = " and e.mode_of_employment = '$mode_of_employment'";
	}
	$where_employment_scale = " ";
	if($employment_scale != 'All' && $employment_scale != NULL)
	{
		$show=1;
		$where_employment_scale = " and e.employment_scale = '$employment_scale'";
	}
//if($show==1)
{
	$rs = mysqli_query($conn,"select distinct(e.first_name),d.designation, u.username, e.* from s04cf_users u 
	left join kiusc_employees e on e.user_id = u.id  
	left join kiusc_emp_designations ed on e.id = ed.emp_id 
	left join kiusc_designations d on ed.designation_id = d.id 
	WHERE 1 $where_type $where_acc_dep $where_adm_dep $where_desgn $where_employment_nature $where_mode_of_employment $where_employment_scale and e.is_active=1
	order by $sort $order");
	
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