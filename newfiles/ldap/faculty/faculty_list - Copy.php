<?php

$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/demo.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/color.css");
$doc->addStyleSheet(JURI::root( true )."/myfiles/mycss.css");

$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.easyui.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/datagrid-filter.js");
//$doc->addScript(JURI::root( true )."/myfiles/students/myScripts.js");

include 'newfiles/common.php';
include 'newfiles/conn.php';

if (checkPermission(JFactory::getUser(), "ldap_create_account")==0)
{
	echo"You dont have right to access this page!";
	return;
}	

$type = 'All';
if(isset($_POST['type_id']))
	$type = $_POST['type_id'];

$acc_dep_id = -1;  /// -1 = no selection; 0 = all accademic department;
if(isset($_POST['acc_dep_id']))
	$acc_dep_id = $_POST['acc_dep_id'];

$adm_dep_id = -1;  /// -1 = no selection; 0 = all admin department;
if(isset($_POST['adm_dep_id']))
	$adm_dep_id = $_POST['adm_dep_id'];

$type = typeDropDown($type);

if($type == 'Faculty')
{
	$acc_dep_id = accDepDrowpDown($conn,$type,$acc_dep_id);
}
if($type == 'Admin')
{
	$adm_dep_id = admDepDrowpDown($conn, $type, $adm_dep_id);
}
echo'<body>
	<table id="dg" title="Students" class="easyui-datagrid" style="height:800px"
			url="'.JURI::root( true ).'/newfiles/ldap/faculty/get_faculty.php?type='.$type.'&adm_dep_id='.$adm_dep_id.'&acc_dep_id='.$acc_dep_id.'"
			toolbar="#toolbar" pagination="false"
			rownumbers="true" fitColumns="false" fit="false" singleSelect="true" >
		<thead>
			<tr>
				<th field="id" width="50" sortable="true" hidden="true">ID</th>
				<th field="designation" width="150" sortable="true">Designation</th>
				<th field="username" width="150" sortable="true">Username</th>
				<th field="name" width="150" sortable="true">Name</th>
				<th field="fname" width="150" sortable="true">Father Name</th>
				<th field="cnic" width="80" sortable="true">CNIC</th>
				<th field="cell_no1" width="80" sortable="true">Cell No.1</th>
				<th field="cell_no2" width="80" sortable="true">Cell No.2</th>
				<th field="email" width="80" sortable="true">Email</th>
				<th field="permanent_address" width="100" >Permanent Address</th>
				<th field="cur_address" width="100">Current Address</th>
				<th field="date_of_joining" width="80">Date of Joining</th>
				<th field="emp_type" width="80" sortable="true">Emp Type</th>
				<th field="scale_type" width="80" sortable="true">Scale Type</th>
				<th field="pay_scale" width="50" sortable="true">Pay Scale</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">';
if (checkPermission(JFactory::getUser(), "ldap_create_account")==1)	
	echo '<a href="index.php/cms-admin/ldap-create-account/faculty-account" class="easyui-linkbutton" iconCls="icon-add" plain="true">Create Account</a>';
if (checkPermission(JFactory::getUser(), "ldap_create_account")==1)	
	echo '<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editFaculty()">Edit Record</a>';

	//echo '<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="exportData()">Export</a>';

echo '</div>';
	
echo'	<form id="edit_fac" method="post" novalidate action="'.JURI::root( true ).'/index.php/faculty-edit-record">
		  <input type="hidden" name="emp_id" value="" id="emp_id">
		</form>';
		
	echo "
	<script type='text/javascript'>
		var url;
		$(function(){
		var dg1 = $('#dg');
			
            dg1.datagrid('enableFilter', [
			{
			
			}
			]);
			
        });
	
	function editFaculty(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				document.getElementById('emp_id').value = row.id;
				document.getElementById('edit_fac').submit();
			}
		}
		
	function myformatter(date){
            var y = date.getFullYear();
            var m = date.getMonth()+1;
            var d = date.getDate();
            
			return ((d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y);
        }
        function myparser(s){
            if (!s) return new Date();
            var ss = (s.split('/'));
            var d = parseInt(ss[0],10);
            var m = parseInt(ss[1],10);
			var y = parseInt(ss[2],10);
            if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
                return new Date(y,m-1,d);
            } else {
                return new Date();
            }
        }
	</script>";

function typeDropDown($type)
{

$sel_type='All';

$type_array = array('All', 'Faculty', 'Admin');

echo '
<form name="type_select" id="type_select" action="" method="post">
 <select id="type_id" name="type_id">';
 foreach($type_array as $tval) 
 {
	$s="";
   if ($type==$tval) 
   {
		$sel_type = $tval;
     $s=" selected ";
   }
	echo '<option '.$s.' value="' . $tval . '">' . $tval . '</option>';
 }
 echo'</select>
 </form>
	<script type="text/javascript">
	$("#type_id").change(function(){
    $("#type_select").trigger("submit");
});
</script>
';
return $sel_type;
}

function accDepDrowpDown($conn, $type, $acc_dep_id)
{
	
	$sel_acc_id = 0;
echo '
<form name="acc_dep_select" id="acc_dep_select" action="" method="post">
 <input type="hidden" name="type_id" value="'.$type.'">
 <select id="acc_dep_id" name="acc_dep_id">';
	echo '<option value="0"> All </option>';
	$acc_departments = mysqli_query($conn, "SELECT * FROM `kiusc_departments`");
	while($acc_dep = mysqli_fetch_assoc($acc_departments))
	{
		$s="";
		if ($acc_dep_id==$acc_dep['id']) 
		{
			$sel_acc_id = $acc_dep['id'];
			$s=" selected ";
		}
		
	echo '<option '.$s.' value="' . $acc_dep['id'] . '">' . $acc_dep['name'] . '</option>';
 }
 echo'</select>
 </form>
	<script type="text/javascript">
	$("#acc_dep_id").change(function(){
    $("#acc_dep_select").trigger("submit");
});
</script>
';
return $sel_acc_id;
}

function admDepDrowpDown($conn, $type, $adm_dep_id)
{
	
	$sel_adm_id = 0;
echo '
<form name="adm_dep_select" id="adm_dep_select" action="" method="post">
 <input type="hidden" name="type_id" value="'.$type.'">
 <select id="adm_dep_id" name="adm_dep_id">';
	echo '<option value="0"> All </option>';
	$admin_departments = mysqli_query($conn, "SELECT * FROM `kiusc_admin_departments`");		
	while($admi_dep = mysqli_fetch_assoc($admin_departments))
	{
		$s="";
		if ($adm_dep_id==$admi_dep['id']) 
		{
			$sel_adm_id = $admi_dep['id'];
			$s=" selected ";
		}
		
	echo '<option '.$s.' value="' . $admi_dep['id'] . '">' . $admi_dep['name'] . '</option>';
 }
 echo'</select>
 </form>
	<script type="text/javascript">
	$("#adm_dep_id").change(function(){
    $("#adm_dep_select").trigger("submit");
});
</script>
';
return $sel_adm_id;
}
?>