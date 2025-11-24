<?php
$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/demo.css");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.easyui1.min.js");

include 'newfiles/common.php';
include 'newfiles/conn.php';
include 'newfiles/my_ldap.php';

if (checkPermission(JFactory::getUser(), "HRM")==0)
{
	echo"You dont have right to access this page!";
	return;
}	

$emp_id = 0;
if(isset($_REQUEST['emp_id']))
	$emp_id = $_REQUEST['emp_id'];

$emp = mysqli_query($conn, "SELECT * FROM `kiusc_employees` WHERE `id` = '$emp_id'");
$emp = mysqli_fetch_assoc($emp);


if($emp_id == 0)
{
	header("location: cms-admin/ldap-create-account/faculty-list");
	return;
}
if(isset($_POST['edit_record']))
{
	$name = $_POST['name'];
	$fname = $_POST['fname'];
	$cnic = $_POST['cnic'];
	$permanent_address = $_POST['permanent_address'];
	$cur_address = $_POST['cur_address'];
	$cell_no1 = $_POST['cell_no1'];
	$cell_no2 = $_POST['cell_no2'];
	$email = $_POST['email'];
	$date_of_joining = $_POST['date_of_joining'];
	$emp_type = $_POST['emp_type'];
	$scale_type = $_POST['scale_type'];
	$pay_scale = $_POST['pay_scale'];
	
	$designation_id = $_POST['designation_id'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$acc_department_id = $_POST['acc_department_id'];
	$adm_department_id = $_POST['adm_department_id'];
	
	
	mysqli_query($conn, "UPDATE `s04cf_users` SET `name`='$name', `email`='$email' WHERE id = '".$emp['user_id']."'");   
	
	mysqli_query($conn, "UPDATE `kiusc_employees` SET `name`='$name',`fname`='$fname',`cnic`='$cnic',`permanent_address`='$permanent_address',
	`cur_address`='$cur_address',`cell_no1`='$cell_no1',`cell_no2`='$cell_no2',`email`='$email',`date_of_joining`='$date_of_joining',
	`emp_type`='$emp_type',`pay_scale`='$pay_scale',`scale_type`='$scale_type' WHERE id = '$emp_id'");
	
	$i = 0;
	$emp_desg_id = $_POST['emp_desg_id'];
	
	$iscurrent = $_POST['iscurrent'];
	$iscur_control = $_POST['iscur_control'];
	$service_end_date = "";
	
	foreach($designation_id as $desg_id)
	{
		$cur = 0;
		if($iscurrent == $iscur_control[$i])
		{
			$cur = 1;
			$service_end_date = $end_date[$i];
		}
		
		if(isset($emp_desg_id[$i]))
		{
			//update
			mysqli_query($conn, "UPDATE `kiusc_emp_designation` SET `designation_id`='$desg_id',`start_date`='$start_date[$i]',
			`end_date`='$end_date[$i]',`acc_department_id`='$acc_department_id[$i]',`adm_department_id`='$adm_department_id[$i]', 
			`iscurrent` = '$cur' WHERE id = '$emp_desg_id[$i]'");
		}
		else
		{
			///insert
			mysqli_query($conn, "INSERT INTO `kiusc_emp_designation`(`emp_id`, `designation_id`, `start_date`, `end_date`, `acc_department_id`, `adm_department_id`,`iscurrent`) 
			VALUES ('$emp_id', '$desg_id', '$start_date[$i]', '$end_date[$i]', '$acc_department_id[$i]', '$adm_department_id[$i]', '$cur')");
		}
		$i++;
	}
	
	mysqli_query($conn, "UPDATE `kiusc_employees` SET `service_end_date`='$service_end_date' WHERE id = '$emp_id'");
	
	echo '<form id="tmp_frm" action="" method="post">
	<input type="hidden" name="emp_id" value="'.$emp_id.'">
	</form>
	
	
	<script>
	document.getElementById("tmp_frm").submit()
	</script>
	';
	//header("location: faculty-edit-record?emp_id=$emp_id");
	print "<font color='green'> Account update successfully </font>";
}	
?>

<form action="" method="post" enctype="multipart/form-data">

<input type="hidden" name="emp_id" value="<?php echo $emp_id ?>">
<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:80%">
<tr>
	<td> Name : </td>
    <td> <input type="text" name="name" value="<?php echo $emp['name'] ?>" style="width:500px" required /> </td>
</tr>

<tr>
	<td> Fname : </td>
    <td> <input type="text" name="fname" value="<?php echo $emp['fname'] ?>" style="width:500px" /> </td>
</tr>

<tr>
	<td> Email : </td>
    <td> <input type="text" name="email" value="<?php echo $emp['email'] ?>" style="width:500px" required /> </td>
</tr>

<tr>
	<td> CNIC : </td>
    <td> <input type="text" name="cnic" value="<?php echo $emp['cnic'] ?>" style="width:500px" /> </td>
</tr>

<tr>
	<td> Permanent Address : </td>
    <td> <input type="text" name="permanent_address" value="<?php echo $emp['permanent_address'] ?>" style="width:500px" /> </td>
</tr>

<tr>
	<td> Current Address : </td>
    <td> <input type="text" name="cur_address" value="<?php echo $emp['cur_address'] ?>" style="width:500px" /> </td>
</tr>

<tr>
	<td> Cell No.1 : </td>
    <td> <input type="text" name="cell_no1" value="<?php echo $emp['cell_no1'] ?>" style="width:500px" /> </td>
</tr>

<tr>
	<td> Cell No.2 : </td>
    <td> <input type="text" name="cell_no2" value="<?php echo $emp['cell_no2'] ?>" style="width:500px" /> </td>
</tr>

<tr>
	<td> Date of Joining : </td>
    <td> <input type="date" name="date_of_joining" value="<?php echo $emp['date_of_joining'] ?>" style="width:500px" /> </td>
</tr>

<tr>
	<td> Employement Type : </td>
    <td><select name="emp_type" style="width:500px">
		<?php
		$emp_type = array('Permanent','Contract','Tenured','Visiting','Daily Wages');
		foreach($emp_type as $etyp)
		{
			$sel = "";
			if($etyp == $emp['emp_type'])
				$sel = " selected ";
			echo '<option value="' . $etyp . '" '. $sel .'> ' . $etyp . ' </option>';
		} ?>
		</select>
	</td>
</tr>

<tr>
	<td> Scale Type : </td>
    <td><select name="scale_type" style="width:500px">
		<?php
		$scale_type = array('BPS','Contract','TTS','Nil');
		foreach($scale_type as $styp)
		{
			$sel = "";
			if($styp == $emp['scale_type'])
				$sel = " selected ";
			echo '<option value="' . $styp . '" '. $sel .'> ' . $styp . ' </option>';
		} ?>
		</select>
	</td>
</tr>

<tr>
	<td> Pay Scale : </td>
    <td> <input type="text" name="pay_scale" value="<?php echo $emp['pay_scale'] ?>" style="width:500px" /> </td>
</tr>


</table>

<hr>

<table id="tbl" style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:80%">
<tr>
	<th> Is Current ? </th>
	<th> Designation </th>
    <th> Start Date </th>
    <th> End Date </th>
	<th> Accademic Department</th>
	<th> Admin Department </th>
</tr>

<?php
$idsno = 0;
$emp_designations = mysqli_query($conn, "SELECT * FROM `kiusc_emp_designation` WHERE `emp_id` = '$emp_id'");
while($emp_desg = mysqli_fetch_assoc($emp_designations))
{
	$idsno++;
	$acc_hidden = "";
	$adm_hidden = "";
	if($emp_desg['acc_department_id'] == 0)
		$acc_hidden = " hidden ";
	else
		$adm_hidden = " hidden ";
?>
<tr>
	<input type="hidden" name="emp_desg_id[]" value="<?php echo $emp_desg['id'] ?>">
	<td><input type="radio" name="iscurrent" value="<?php echo $idsno ?>" <?php echo ($emp_desg['iscurrent'] == 1) ? "checked" : "" ?>> 
		<input type="hidden" name="iscur_control[]" value="<?php echo $idsno ?>">
	</td>
	<td><select name="designation_id[]" style="width:250px" onchange="checkDesignationType(this.value, <?php echo $idsno ?>)">
		<option value="0"> Select Designation </option>
		<?php
		$designations = mysqli_query($conn, "SELECT * FROM `kiusc_designations`");
		while($desg = mysqli_fetch_assoc($designations))
		{
			$sel = '';
			if($emp_desg['designation_id']==$desg['id'])
				$sel = ' selected ';
			
			echo '<option value="'.$desg['id'].'" '.$sel.'> '.$desg['designation'].' </option> ';
		}
		?>
    	</select>
	</td>
	<td> <input type="date" name="start_date[]" value="<?php echo $emp_desg['start_date'] ?>" /> </td>
	<td> <input type="date" name="end_date[]" value="<?php echo $emp_desg['end_date'] ?>" /> </td>
	<td> <select name="acc_department_id[]" id="acc_dep_id_<?php echo $idsno ?>" <?php echo $acc_hidden ?> >
			<option value="0"> Select Department </option>
		<?php
		$acc_departments = mysqli_query($conn, "SELECT * FROM `kiusc_departments`");
		while($acc_dep = mysqli_fetch_assoc($acc_departments))
		{
			$sel = '';
			if($emp_desg['acc_department_id']==$acc_dep['id'])
				$sel = ' selected ';
			
			echo '<option value="'.$acc_dep['id'].'" '.$sel.'> '.$acc_dep['name'].' </option> ';
		}
		?>
		</select>
	</td>
	<td> <select name="adm_department_id[]" id="adm_dep_id_<?php echo $idsno ?>" <?php echo $adm_hidden ?> >
			<option value="0"> Select Department </option>
			<?php
			$admin_departments = mysqli_query($conn, "SELECT * FROM `kiusc_admin_departments`");
			while($admi_dep = mysqli_fetch_assoc($admin_departments))
			{
				$sel = '';
				if($emp_desg['adm_department_id']==$admi_dep['id'])
					$sel = ' selected ';
				
				echo '<option value="'.$admi_dep['id'].'" '.$sel.'> '.$admi_dep['name'].' </option> ';
			}
			?>
		</select>
	</td>
</tr>

<?php 
} 
?>

<tr>
	<td colspan="2"> </td>
    <td> <input type="button" onclick="rowAdd()" value="Add More Designation" style="background-color: burlywood; border-radius: 17px; color: black;" /> </td>
</tr>

</table>

	<input type="submit" name="edit_record" value="Update" style="background-color: burlywood; border-radius: 17px; color: black;" />
</form>

<script>
function rowAdd() {
		var idno = document.getElementById("tbl").rows.length;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
		{
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				jQuery("#tbl").append(xmlhttp.responseText);
            }
        };
        xmlhttp.open("GET", "../newfiles/ldap/faculty/ajax_addRow.php?idno="+idno, true);
        xmlhttp.send();
}
</script>

<script>
function checkDesignationType(v, no) {
       var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
		{
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				if(xmlhttp.responseText.trim() == "Faculty")
				{
					document.getElementById('adm_dep_id_'+no).value = 0;
					document.getElementById('adm_dep_id_'+no).hidden = true;
					document.getElementById('acc_dep_id_'+no).hidden = false;
				}
				else
				{
					document.getElementById('acc_dep_id_'+no).value = 0;
					document.getElementById('acc_dep_id_'+no).hidden = true;
					document.getElementById('adm_dep_id_'+no).hidden = false;
				}
            }
        };
        xmlhttp.open("GET", "../newfiles/ldap/faculty/ajax_check_designation_type.php?desg_id="+v, true);
        xmlhttp.send();
}
</script>
