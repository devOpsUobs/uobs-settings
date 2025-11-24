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
$emp_id=$_GET['emp_id'];

if (checkPermission(JFactory::getUser(), "HRM")==0)
{
	echo"You dont have right to access this page!";
	return;
}

if(isset($_POST['add_designations']) || isset($_POST['save_next']))
{
	$is_highest=0;
	$designation_id =  $_POST['designation_id'];
	$acc_department_id = $_POST['acc_department_id'];
	$adm_department_id = $_POST['adm_department_id'];
	$employment_nature = $_POST['employment_nature'];
	$date_of_joining = $_POST['date_of_joining'];
	$contract_period_months = $_POST['contract_period_months'];
	$service_end_date = $_POST['service_end_date'];
	$mode_of_employment = $_POST['mode_of_employment'];
	$employment_scale = $_POST['employment_scale'];
	$pay_scale = $_POST['pay_scale'];
	$emp_id = $_POST['emp_id'];
	$is_current=0;
	if(isset($_POST['is_current']))
		$is_current = $_POST['is_current'];
	
	
	$desig_id="";
	if($_POST['emp_desig_id'] != NULL)
	{
		$desig_id = $_POST['emp_desig_id'];
		if($is_current == 1)
		{
			$emp_deg_cur=mysqli_query($conn, "SELECT * FROM `kiusc_emp_designations` where emp_id='$emp_id' and is_current = 1");
			$emp_deg_cur=mysqli_num_rows($emp_deg_cur);
			if($emp_deg_cur > 0)
			{
				print "<font color='green'> Your Current Designation is Changed, Please Confirm! </font>";
				mysqli_query($conn, "UPDATE `kiusc_emp_designations` SET `is_current`='0' WHERE emp_id='$emp_id'");
			}
			
		}
		mysqli_query($conn, "UPDATE `kiusc_emp_designations` SET `designation_id`='$designation_id',`acc_department_id`='$acc_department_id',`adm_department_id`='$adm_department_id',`date_of_joining`='$date_of_joining',`service_end_date`='$service_end_date',`employment_nature`='$employment_nature',`contract_period_months`='$contract_period_months',`mode_of_employment`='$mode_of_employment',`employment_scale`='$employment_scale', `pay_scale` = '$pay_scale',`is_current`='$is_current' WHERE id='$desig_id'"); 
	}
	else
	{
		if($is_current == 1)
		{
			$emp_deg_cur=mysqli_query($conn, "SELECT * FROM `kiusc_emp_designations` where emp_id='$emp_id' and is_current = 1");
			$emp_deg_cur=mysqli_num_rows($emp_deg_cur);
			if($emp_deg_cur > 0)
			{
				print "<font color='green'> Your Current Designation is Changed, Please Confirm! </font>";
				mysqli_query($conn, "UPDATE `kiusc_emp_designations` SET `is_current`='0' WHERE emp_id='$emp_id'");
			}
			
		}
		mysqli_query($conn, "INSERT INTO `kiusc_emp_designations`(`emp_id`, `designation_id`, `acc_department_id`, `adm_department_id`, `date_of_joining`, `service_end_date`, `employment_nature`, `contract_period_months`, `mode_of_employment`, `employment_scale`, `pay_scale`, `is_current`) VALUES ('$emp_id','$designation_id','$acc_department_id','$adm_department_id','$date_of_joining','$service_end_date','$employment_nature','$contract_period_months','$mode_of_employment','$employment_scale', '$pay_scale', '$is_current')"); 
	}
	if(isset($_POST['save_next']))
		header("location:faculty-education?emp_id=".$emp_id."");

}
if(isset($_POST['next']))
{
	$emp_deg=mysqli_query($conn, "SELECT * FROM `kiusc_emp_designations` where emp_id='$emp_id'");
	$emp_deg=mysqli_num_rows($emp_deg);
	if($emp_deg > 0)
		header("location:faculty-education?emp_id=".$emp_id."");
	else
		echo "<font color='green'> Please Add Atleast One Designation </font>";
}
$checked="";
if(isset($_POST['edit']))
{
	$desig_id = $_POST['desig_id'];
	$emp_deg=mysqli_query($conn, "SELECT * FROM `kiusc_emp_designations` where id='$desig_id'");
	$emp_deg=mysqli_fetch_assoc($emp_deg);

	if($emp_deg['is_current'] == 1)
		$checked="Checked";
}
if(isset($_POST['delete']))
{
	$desig_id = $_POST['desig_id'];
	mysqli_query($conn, "DELETE FROM `kiusc_emp_designations` WHERE id='$desig_id'");
}


?>

<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="emp_id" value="<?php echo isset($emp_id) ? $emp_id : "" ?>">
<h3>Additional Employement Information</h3>
<table id="tbl" style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:80%">
<tr>
	<td> Designation : </td>
	<td>
		<select name="designation_id" style="width:500px" onchange="checkDesignationType(this.value, 1)" required>
			<option value="0"> Select Designation </option>
			<?php
			$designations = mysqli_query($conn, "SELECT * FROM `kiusc_designations`");
			while($desg = mysqli_fetch_assoc($designations))
			{
				$sel = "";
				if(isset($desg['id']))
				{
					if($desg['id'] == $emp_deg['designation_id'])
						$sel = " selected ";
				}
				echo '<option value="'.$desg['id'].'"'.$sel.'> '.$desg['designation'].' </option> ';
			}
			?>
    	</select>
	</td>
</tr>
<tr>
	<td> Accademic Department : </td>
    <td> 
		<select name="acc_department_id" style="width:500px" id="acc_dep_id_1" required>
			<option value="0"> Select Department </option>
			<?php
			$acc_departments = mysqli_query($conn, "SELECT * FROM `kiusc_departments`");
			while($acc_dep = mysqli_fetch_assoc($acc_departments))
			{
				$sel = "";
				if(isset($acc_dep['id']))
				{
					if($acc_dep['id'] == $emp_deg['acc_department_id'])
						$sel = " selected ";
				}
				echo '<option value="'.$acc_dep['id'].'"'.$sel.'> '.$acc_dep['name'].' </option> ';
			}
			?>
		</select>
	</td>
</tr>
<tr>
	<td> Admin Department</td>
	<td> <select name="adm_department_id" style="width:500px" id="adm_dep_id_1" required>
			<option value="0"> Select Department </option>
			<?php
			$admin_departments = mysqli_query($conn, "SELECT * FROM `kiusc_admin_departments`");
			while($admi_dep = mysqli_fetch_assoc($admin_departments))
			{
				$sel = "";
				if(isset($admi_dep['id']))
				{
					if($admi_dep['id'] == $emp_deg['adm_department_id'])
						$sel = " selected ";
				}
				echo '<option value="'.$admi_dep['id'].'"'.$sel.'> '.$admi_dep['name'].' </option> ';
			}
			?>
		</select>
	</td>
</tr>
	<tr>
		<td> Employee Nature : </td>
		<td>
			<select name="employment_nature" style="width:500px" id="employment_nature"  onchange="showHidePeriodTr(this.value)" required>
				<option value="">...Select Status....</option>
			<?php
			$employment_nature = mysqli_query($conn, "SHOW COLUMNS FROM kiusc_emp_designations WHERE Field = 'employment_nature'");
			$employment_nature = mysqli_fetch_assoc($employment_nature);
			$employment_nature = explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2", $employment_nature['Type']));
			foreach($employment_nature as $status)
			{
				$sel = "";
				if(isset($emp_deg['employment_nature']))
				{
					if($emp_deg['employment_nature'] == $status)
						$sel = " selected ";
				}
				
				echo "<option value='$status' $sel>$status</option>";
			}
			?>
			</select>
		</td>
	</tr>
		<script>
			function showHidePeriodTr(v)
			{
				if(v == "Regular")
					document.getElementById("period_tr").hidden = true;
				else
					document.getElementById("period_tr").hidden = false;
				
			}
		</script>
	<tr>
		<th>Date of Joining</th>
		<td><input type="date" style="width:500px" name="date_of_joining" id="date_of_joining" value="<?php echo isset($emp_deg['date_of_joining']) ? $emp_deg['date_of_joining'] : "" ?>" required></td>
	</tr>
	<tr id="period_tr" style="width:500px" <?php echo isset($emp_deg['employment_nature']) ? (($emp_deg['employment_nature']=="Regular") ? "hidden" : "") : "hidden" ?>>
		<th>Contract Period (in months)</th>
		<td><input type="number" min="0" name="contract_period_months" id="contract_period_months" value="<?php echo isset($emp_deg['contract_period_months']) ? $emp_deg['contract_period_months'] : "" ?>"></td>
	</tr>

	<tr>
		<th>Service End Date</th>
		<td><input type="date" style="width:500px" name="service_end_date" id="service_end_date" value="<?php echo isset($emp_deg['service_end_date']) ? $emp_deg['service_end_date'] : "" ?>"></td>
	</tr>
	<tr>
		<td> Mode of Employment : </td>
		<td>
			<select name="mode_of_employment" style="width:500px" required>
				<?php
					$mode_of_employment = mysqli_query($conn, "SHOW COLUMNS FROM kiusc_emp_designations WHERE Field = 'mode_of_employment'");
					$mode_of_employment = mysqli_fetch_assoc($mode_of_employment);
					$mode_of_employment = explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2", $mode_of_employment['Type']));
					foreach($mode_of_employment as $status)
					{
						$sel = "";
						if(isset($emp_deg['mode_of_employment']))
						{
							if($emp_deg['mode_of_employment'] == $status)
								$sel = " selected ";
						}
						
						echo "<option value='$status' $sel>$status</option>";
					}
					?>
			</select>
		</td>
	</tr>
	<tr>
		<td> Employment Scale : </td>
 	   <td>
			<select name="employment_scale" style="width:500px" required>
				<?php
				$employment_scale = mysqli_query($conn, "SHOW COLUMNS FROM kiusc_emp_designations WHERE Field = 'employment_scale'");
				$employment_scale = mysqli_fetch_assoc($employment_scale);
				$employment_scale = explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2", $employment_scale['Type']));
				foreach($employment_scale as $status)
				{
					$sel = "";
					if(isset($emp_deg['employment_scale']))
					{
						if($emp_deg['employment_scale'] == $status)
							$sel = " selected ";
					}
					
					echo "<option value='$status' $sel>$status</option>";
				}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Pay Scale : </td>
 	   <td>
			<select name="pay_scale" style="width:500px">
				<?php
				for($i=1;$i<=22;$i++)
				{
					$sel = "";
					if(isset($emp_deg['pay_scale']))
					{
						if($emp_deg['pay_scale'] == $i)
							$sel = " selected ";
					}
					
					echo "<option value='$i' $sel>$i</option>";
				}
				?>
			</select>
		</td>
	</tr>
	<tr>
			<td> Is Current? </td>
			<td> <input type="checkbox" name="is_current" style="width:500px" value="1" <?php echo $checked ?>/> </td>
		</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<input type="hidden" name="emp_desig_id" value="<?php echo isset($emp_deg['id']) ? $emp_deg['id'] : "" ?>">

	<tr>
		<td></td>
		<td>
			<input type="submit" name="add_designations" value="Add Designation" style="background-color: burlywood; border-radius: 17px; color: black;float:right" />
		</td>	
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
		<tr>
			<td><input type="submit" name="save_next" value="Save & Next" style="background-color: burlywood; border-radius: 17px; color: black;" /></td>
			<td>
				
		
</form>
<form action="" method="POST">

				<input type="submit" name="back" value="Back" style="background-color: burlywood; border-radius: 17px; color: black;" />
				<input type="submit" name="next" value="Next" style="background-color: burlywood; border-radius: 17px; color: black;" />
				
			</td>
			<td>
			</td>
			
		</tr>
			</table>
</form>
<br><br><br>
<?php
if(isset($_POST['back']))
	header("location:hr-2/create-employee-account?emp_id=".$emp_id."");
?>
<table id="tbl" style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%">
	<tr>
		<th>Serial No.</th>
		<th>Designation</th>
		<th>Department</th>
		<th>Date of Joining</th>
		<th>Service End Date</th>
		<th>Employement Nature</th>
		<th>Mode of Employement</th>
		<th>Employement Scale</th>
		<th>Pay Scale</th>
		<th>Current Designation</th>
		<th>Initial Designation</th>
		<th>Action</th>
	</tr>
	<?php
	$i=0;
	$desig = mysqli_query($conn, "SELECT ed.*, d.designation FROM `kiusc_emp_designations` ed JOIN kiusc_designations d on d.id=ed.designation_id where emp_id='$emp_id'");
	while($desg = mysqli_fetch_assoc($desig))
	{
		$i++;
		if($desg['acc_department_id'] > 0)
		{
			$department = mysqli_query($conn, "SELECT * FROM `kiusc_departments` where id=".$desg['acc_department_id']);
			$department = mysqli_fetch_assoc($department);
			$department=$department['name'];
		}
		elseif($desg['adm_department_id'] > 0)
		{
			$department = mysqli_query($conn, "SELECT * FROM `kiusc_admin_departments` where id=".$desg['adm_department_id']);
			$department = mysqli_fetch_assoc($department);
			$department=$department['name'];
		}
			
		?>
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $desg['designation'];?></td>
			<td><?php echo $department;?></td>
			<td><?php echo $desg['date_of_joining'];?></td>
			<td><?php echo $desg['service_end_date'];?></td>
			<td><?php echo $desg['employment_nature'];?></td>
			<td><?php echo $desg['mode_of_employment'];?></td>
			<td><?php echo $desg['employment_scale'];?></td>
			<td><?php echo $desg['pay_scale'];?></td>
			<td><?php echo ($desg['is_current'] == '1' ? "Yes" : "No") ?></td>
			<td><?php echo ($desg['is_initial'] == '1' ? "Yes" : "No") ?></td>
			<td width="100px">
				<form action="" method="POST">
					<input type="hidden" name="desig_id" value="<?php echo isset($desg['id']) ? $desg['id'] : "" ?>">
					<input type="submit" name="edit" value="Edit" style="background-color: burlywood; border-radius: 17px; color: black;" />
					<input type="submit" name="delete" value="Delete" style="background-color: burlywood; border-radius: 17px; color: black;" />
				</form>
			</td>
		</tr>
		<?php
	}
	?>
</table>

<script>
var idno = 1;
function rowAdd() {
	idno++;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
		{
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				jQuery("#tbl").append(xmlhttp.responseText);
            }
        };
        xmlhttp.open("GET", "../../newfiles/ldap/faculty/ajax_addRow.php?idno="+idno, true);
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

 
$('#cnic').keypress(function(){

  //allow  backspace, tab, ctrl+A, escape, carriage return
  if (event.keyCode == 8 || event.keyCode == 9 
                    || event.keyCode == 27 || event.keyCode == 13 
                    || (event.keyCode == 65 && event.ctrlKey === true) )
                        return;
	
	evt = window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		event.preventDefault();

  var length = $(this).val().length;
	if (length > 14)
		event.preventDefault();  
            
  if(length == 5 || length == 13)
   $(this).val($(this).val()+'-');

 });

</script>
