<?php

$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/demo.css");
// $doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/color.css");
// $doc->addStyleSheet(JURI::root( true )."/myfiles/mycss.css");

$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.easyui.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/datagrid-filter.js");
//$doc->addScript(JURI::root( true )."/myfiles/students/myScripts.js");

include 'newfiles/common.php';
include 'newfiles/conn.php';

if (checkPermission(JFactory::getUser(), "HRM")==0)
{
	echo"You dont have right to access this page!";
	return;
}	

$type = "";
if(isset($_POST['chk_emp_type']))
{
	$type = $_POST['type_id'];
}
$acc_dep_id = 0;
if(isset($_POST['chk_acc_dep']))
{
	$acc_dep_id = $_POST['acc_dep_id'];
}
$adm_dep_id = 0;
if(isset($_POST['chk_adm_dep']))
{
	$adm_dep_id = $_POST['adm_dep_id'];
}
$desg_id = 0;
if(isset($_POST['chk_desg']))
{
	$desg_id = $_POST['desg_id'];
}
$employment_nature = 'All';
if(isset($_POST['chk_employment_nature']))
{
	$employment_nature = $_POST['employment_nature'];
}
$mode_of_employment = 'All';
if(isset($_POST['chk_mode_of_employment']))
{
	$mode_of_employment = $_POST['mode_of_employment'];
}
$employment_scale = 'All';
if(isset($_POST['chk_employment_scale']))
{
	$employment_scale = $_POST['employment_scale'];
}

?>
<table>
<form action="" method="POST">
	<tr>
		<td>Employee Type:</td>
		<td>
			<?php
		$type_array = array('All', 'Faculty', 'Admin');
		echo '
			<select id="type_id" name="type_id" style="width:500px">';
				foreach($type_array as $tval) 
				{
					$s="";
				if ($type==$tval) 
				{
					$s=" selected ";
				}
					echo '<option '.$s.' value="' . $tval . '">' . $tval . '</option>';
				}
				?>
			</select>
			</td>
			<td><input type="checkbox" name="chk_emp_type" style="margin-left: 30px;"></td>
	</tr>
	<tr>
	<td>Accademic Department :</td>
	<td><select id="acc_dep_id" name="acc_dep_id" style="width:500px">
		<?php
		echo '<option value="0"> All </option>';
		$acc_departments = mysqli_query($conn, "SELECT * FROM `kiusc_departments`");
		while($acc_dep = mysqli_fetch_assoc($acc_departments))
		{
			$s="";
			if ($acc_dep_id==$acc_dep['id']) 
			{
				$s=" selected ";
			}
			
		echo '<option '.$s.' value="' . $acc_dep['id'] . '">' . $acc_dep['name'] . '</option>';
		}?>
 	</select></td>
	 <td><input type="checkbox" name="chk_acc_dep" style="margin-left: 30px;"></td>
	</tr>
	<tr>
	<td>Non Teaching Department :</td>
	<td><select id="adm_dep_id" name="adm_dep_id" style="width:500px">
		<?php
		echo '<option value="0"> All </option>';
		$admin_departments = mysqli_query($conn, "SELECT * FROM `kiusc_admin_departments`");		
		while($admi_dep = mysqli_fetch_assoc($admin_departments))
		{
			$s="";
			if ($adm_dep_id==$admi_dep['id']) 
			{
				$s=" selected ";
			}
			
		echo '<option '.$s.' value="' . $admi_dep['id'] . '">' . $admi_dep['name'] . '</option>';
		}?>
 	</select>
	</td>
	<td><input type="checkbox" name="chk_adm_dep" style="margin-left: 30px;"></td>
	</tr>
	<tr>
		<td>Designation</td>
		<td>
		<select id="desg_id" name="desg_id" style="width:500px">
			<?php
			echo '<option value="0"> All </option>';
			$designation = mysqli_query($conn, "SELECT * FROM `kiusc_designations`");		
			while($desg = mysqli_fetch_assoc($designation))
			{
				$s="";
				if ($desg_id==$desg['id']) 
				{
					$s=" selected ";
				}
				
			echo '<option '.$s.' value="' . $desg['id'] . '">' . $desg['designation'] . '</option>';
			}?>
 		</select>
		</td>
		<td><input type="checkbox" name="chk_desg" style="margin-left: 30px;"></td>
	</tr>
	<tr>
	<td>Employement Nature :</td>
	<td><select name="employment_nature" style="width:500px">
		<?php
		echo '<option value="0"> All </option>';
		$employment_nature1 = mysqli_query($conn, "SHOW COLUMNS FROM kiusc_emp_designations WHERE Field = 'employment_nature'");
		$employment_nature1 = mysqli_fetch_assoc($employment_nature1);
		$employment_nature1 = explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2", $employment_nature1['Type']));
		foreach($employment_nature1 as $status)
		{
			$sel = "";
			if($employment_nature == $status)
				$sel = " selected ";
			echo "<option value='$status' $sel>$status</option>";
		}
		?>
	</select></td>
	<td><input type="checkbox" name="chk_employment_nature" style="margin-left: 30px;"></td>
	</tr>
	<tr>
	<td> Mode of Employement :</td>
	<td><select name="mode_of_employment" style="width:500px">
		<?php
			echo '<option value="All"> All </option>';
			$mode_of_employment1 = mysqli_query($conn, "SHOW COLUMNS FROM kiusc_emp_designations WHERE Field = 'mode_of_employment'");
			$mode_of_employment1 = mysqli_fetch_assoc($mode_of_employment1);
			$mode_of_employment1 = explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2", $mode_of_employment1['Type']));
			foreach($mode_of_employment1 as $status)
			{
				$sel = "";
				if($mode_of_employment == $status)
					$sel = " selected ";

				echo "<option value='$status' $sel>$status</option>";
			}
			?>
	</select>
	</td>
	<td><input type="checkbox" name="chk_mode_of_employment" style="margin-left: 30px;"></td>
	</tr>
	<tr>
	<td>Employement Scale :</td>
	<td><select name="employment_scale" style="width:500px">
		<?php
		echo '<option value="0"> All </option>';
		$employment_scale1 = mysqli_query($conn, "SHOW COLUMNS FROM kiusc_emp_designations WHERE Field = 'employment_scale'");
		$employment_scale1 = mysqli_fetch_assoc($employment_scale1);
		$employment_scale1 = explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2", $employment_scale1['Type']));
		foreach($employment_scale1 as $status)
		{
			$sel = "";
			if($employment_scale == $status)
				$sel = " selected ";
			
			echo "<option value='$status' $sel>$status</option>";
		}
		?>
	</select>
	</td>
	<td><input type="checkbox" name="chk_employment_scale" style="margin-left: 30px;"></td>
	</tr>
	<tr>
	<td><input type="submit" name="submit" value="Search"></td>
	</tr>
</form>
</table>
<?php
echo'<body>
	<table id="dg" title="Students" class="easyui-datagrid" style="height:800px"
			url="'.JURI::root( true ).'/newfiles/hr/faculty_list/get_faculty.php?type='.$type.'&adm_dep_id='.$adm_dep_id.'&acc_dep_id='.$acc_dep_id.'&desg_id='.$desg_id.'&employment_nature='.$employment_nature.'&mode_of_employment='.$mode_of_employment.'&employment_scale='.$employment_scale.'"
			toolbar="#toolbar" pagination="false"
			rownumbers="true" fitColumns="false" fit="false" singleSelect="true" >
		<thead>
			<tr>
				<th field="id" width="50" sortable="true" hidden="true">ID</th>
				<th field="designation" width="150" sortable="true">Designation</th>
				<th field="username" width="150" sortable="true">Username</th>
				<th field="first_name" width="100" sortable="true">First Name</th>
				<th field="last_name" width="100" sortable="true">Last Name</th>
				<th field="fname" width="150" sortable="true">Father Name</th>
				<th field="cnic" width="80" sortable="true">CNIC</th>
				<th field="cell_no1" width="80" sortable="true">Cell No.1</th>
				<th field="cell_no2" width="80" sortable="true">Cell No.2</th>
				<th field="email" width="80" sortable="true">Email</th>
				<th field="permanant_address" width="100" >Permanent Address</th>
				<th field="current_address" width="100">Current Address</th>
				<th field="date_of_joining" width="80">Date of Joining</th>
				<th field="employment_nature" width="80" sortable="true">Employment Nature</th>
				<th field="mode_of_employment" width="80" sortable="true">Mode of Employment</th>
				<th field="employment_scale" width="50" sortable="true">Employment Scale</th>
				<th field="pay_scale" width="50" sortable="true">Pay Scale</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">';
if (checkPermission(JFactory::getUser(), "HRM")==1)	
	echo '<a href="index.php/hr-2/create-employee-account" class="easyui-linkbutton" iconCls="icon-add" plain="true">Create Account</a>';
if (checkPermission(JFactory::getUser(), "HRM")==1)	
	echo '<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editFaculty()">Edit Record</a>';

	echo '<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="FacultyCV()">Detail</a>';
	//echo '<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="exportData()">Export</a>';

echo '</div>';
	
echo'	<form id="edit_fac" method="post" novalidate action="'.JURI::root( true ).'/index.php/hr-2/create-employee-account">
		  <input type="hidden" name="emp_id" value="" id="emp_id">
		</form>';
echo'	<form id="fac_cv" method="post" novalidate action="'.JURI::root( true ).'/index.php/faculty-resume">
		<input type="hidden" name="emp_ids" value="" id="emp_ids">
	  </form>';	
?>
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
	function FacultyCV(){
		var row = $('#dg').datagrid('getSelected');
			if (row){
				// document.getElementById('emp_ids').value = row.id;
				// document.getElementById('fac_cv').submit();
				var emp_id = row.id;
				window.location.href='../../faculty-resume?emp_ids='+row.id;
				//console.log("ss");
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
<?php
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

function DesgDrowpDown($conn, $type, $acc_dep_id, $adm_dep_id, $desg_id)
{
	
	$sel_desg_id = 0;
echo '
<form name="desg_select" id="desg_select" action="" method="post">
 <input type="hidden" name="type_id" value="'.$type.'">
 <input type="hidden" name="acc_dep_id" value="'.$acc_dep_id.'">
 <input type="hidden" name="adm_dep_id" value="'.$adm_dep_id.'">
 <select id="desg_id" name="desg_id">';
	echo '<option value="0"> All </option>';
	$designation = mysqli_query($conn, "SELECT * FROM `kiusc_designations`");		
	while($desg = mysqli_fetch_assoc($designation))
	{
		$s="";
		if ($desg_id==$desg['id']) 
		{
			$sel_desg_id = $desg['id'];
			$s=" selected ";
		}
		
	echo '<option '.$s.' value="' . $desg['id'] . '">' . $desg['designation'] . '</option>';
 }
 echo'</select>
 </form>
	<script type="text/javascript">
	$("#desg_id").change(function(){
    $("#desg_select").trigger("submit");
});
</script>
';
return $sel_desg_id;
}
?>