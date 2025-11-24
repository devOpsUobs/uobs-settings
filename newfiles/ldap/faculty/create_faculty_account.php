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

if (checkPermission(JFactory::getUser(), "ldap_create_account")==0)
{
	echo"You dont have right to access this page!";
	return;
}	

if(isset($_POST['create']))
{
	$uname =  $_POST['uname'];
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
	$user_group = $_POST['user_group'];
	
	$designation_id = $_POST['designation_id'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$acc_department_id = $_POST['acc_department_id'];
	$adm_department_id = $_POST['adm_department_id'];
	
	$ex = mysqli_query($conn, "SELECT * FROM `s04cf_users` WHERE `username` = '".$uname."'");
	$ex_count = mysqli_num_rows($ex);
	if($ex_count)
	{
		print "<font color='red'> Username already exist </font>";
		return;
	}
	
	$ex = mysqli_query($conn, "SELECT * FROM `kiusc_employees` WHERE `cnic` = '$cnic'");
	$ex_count = mysqli_num_rows($ex);
	if($ex_count)
	{
		print "<font color='red'> CNIC already exist </font>";
		return;
	}
	
	$ex = mysqli_query($conn, "SELECT * FROM `kiusc_employees` WHERE `email` = '$email'");
	$ex_count = mysqli_num_rows($ex);
	if($ex_count)
	{
		print "<font color='red'> Email already exist </font>";
		return;
	}
	
	$password = randPassword(7, false, 'lud');
	
	jimport('joomla.user.helper');
	$salt = JUserHelper::genRandomPassword(32);
	$crypted = JUserHelper::getCryptedPassword($password, $salt);
	$pass = $crypted.':'.$salt;	
	
	mysqli_query($conn, "INSERT INTO `s04cf_users`(`name`, `username`, `email`, `password`, `block`) 
		VALUES ('$name', '$uname', '$email', '$pass', '0')");   
		
	$user_id = mysqli_insert_id($conn);
		
	mysqli_query($conn, "INSERT INTO `s04cf_user_usergroup_map`(`user_id`, `group_id`) VALUES ('$user_id', '2')");
	
	
	$ou = "StaffFaculty";

	//createUser($name, $uname, $password, $user_group,$ou);
	
	mysqli_query($conn, "INSERT INTO `kiusc_employees`(`user_id`, `first_name`, `fname`, `cnic`, `permanant_address`, `current_address`, 
	`cell_no1`, `cell_no2`, `email`, `date_of_joining`, `employment_nature`, `pay_scale`, `employment_scale`) 
	VALUES ('$user_id', '$name', '$fname', '$cnic', '$permanent_address', '$cur_address', '$cell_no1', '$cell_no2', '$email', 
	'$date_of_joining', '$emp_type', '$pay_scale', '$scale_type')");
	
	$emp_id = mysqli_insert_id($conn);
	

	$iscurrent = $_POST['iscurrent'];
	$iscur_control = $_POST['iscur_control'];
	$service_end_date = "";
	
	$i = 0;
	foreach($designation_id as $desg_id)
	{
		$cur = 0;
		if($iscurrent == $iscur_control[$i])
		{
			$cur = 1;
			$service_end_date = $end_date[$i];
		}
		
		mysqli_query($conn, "INSERT INTO `kiusc_emp_designation` (`emp_id`, `designation_id`, `start_date`, `end_date`, `acc_department_id`, `adm_department_id`,`iscurrent`) 
		VALUES ('$emp_id', '$desg_id', '$start_date[$i]', '$end_date[$i]', '$acc_department_id[$i]', '$adm_department_id[$i]', '$cur')");
		$i++;
	}
	
	mysqli_query($conn, "UPDATE `kiusc_employees` SET `service_end_date`='$service_end_date' WHERE id = '$emp_id'");
	
	//// send password ///
		$recipient = array($email);
		$subject = "New Staff Account";
		$body = "Wellcome to UOBS. You need this account to access internet and UOBS Portal. <br>
				The below is your username and password. <br><br>
				 Username : " . $uname . "<br>
				 Password : " . $password . "<br><br>
				 This is system generated passowrd you are requested to change your password on first login. 
				 To change your password goto 'User' menu and click on 'Reset Password' <br> 
				 You are also advised to keep update your personal data. To update your personal data goto 'User' menu and click on 'Update Profile'
				 <br> <br> <br>
				<font color='red'> <b> Note: </b> This is system generated email from UOBS. 
				Please don't reply to this email. If you have any queries contact the relevant authorities. </font> ";
				 
		sendMail($recipient, $subject, $body);
		
		echo "<font color='green'> Username and passowrd has been sent to your email address. </font>";
	
	print "<font color='green'> Account created successfully </font>";
}


?>

<form action="" method="post" enctype="multipart/form-data">

<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:80%">
<tr>
	<td> Name : </td>
    <td> <input type="text" name="name" style="width:500px" required /> </td>
</tr>

<tr>
	<td> Fname : </td>
    <td> <input type="text" name="fname" style="width:500px" /> </td>
</tr>

<tr>
	<td> Username : </td>
    <td> <input type="text" name="uname" style="width:500px" required /> </td>
</tr>

<tr>
	<td> Email : </td>
    <td> <input type="email" name="email" style="width:500px" required /> </td>
</tr>

<tr>
	<td> Employee Group : </td>
    <td><select name="user_group" style="width:500px">
			<option value="Faculty"> Faculty </option>
		</select>
	</td>
</tr>

<tr>
	<td> CNIC : </td>
    <td> <input type="text" name="cnic" id="cnic" autocomplete="off" style="width:500px" required/> </td>
</tr>

<tr>
	<td> Permanent Address : </td>
    <td> <input type="text" name="permanent_address" style="width:500px" /> </td>
</tr>

<tr>
	<td> Current Address : </td>
    <td> <input type="text" name="cur_address" style="width:500px" /> </td>
</tr>

<tr>
	<td> Cell No.1 : </td>
    <td> <input type="text" name="cell_no1" style="width:500px" /> </td>
</tr>

<tr>
	<td> Cell No.2 : </td>
    <td> <input type="text" name="cell_no2" style="width:500px" /> </td>
</tr>

<tr>
	<td> Date of Joining : </td>
    <td> <input type="date" name="date_of_joining" style="width:500px" /> </td>
</tr>

<tr>
	<td> Employement Type : </td>
    <td><select name="emp_type" style="width:500px">
		<option value="Permanent"> Permanent </option>
		<option value="Contract"> Contract </option>
		<option value="Tenured"> Tenured </option>
		<option value="Visiting"> Visiting </option>
		<option value="Daily Wages"> Daily Wages </option>
		</select>
	</td>
</tr>

<tr>
	<td> Scale Type : </td>
    <td><select name="scale_type" style="width:500px">
		<option value="BPS"> BPS </option>
		<option value="TTS"> TTS </option>
		<option value="Nil"> Nil </option>
		</select>
	</td>
</tr>

<tr>
	<td> Pay Scale : </td>
    <td> <input type="text" name="pay_scale" style="width:500px" /> </td>
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

<tr>
	<td><input type="radio" name="iscurrent" value="1"> 
		<input type="hidden" name="iscur_control[]" value="1">
	</td>
	<td><select name="designation_id[]" style="width:250px" onchange="checkDesignationType(this.value, 1)">
		<option value="0"> Select Designation </option>
		<?php
		$designations = mysqli_query($conn, "SELECT * FROM `kiusc_designations`");
		while($desg = mysqli_fetch_assoc($designations))
		{
			echo '<option value="'.$desg['id'].'"> '.$desg['designation'].' </option> ';
		}
		?>
    	</select>
	</td>
	<td> <input type="date" name="start_date[]" /> </td>
	<td> <input type="date" name="end_date[]" /> </td>
	<td> <select name="acc_department_id[]" id="acc_dep_id_1">
			<option value="0"> Select Department </option>
		<?php
		$acc_departments = mysqli_query($conn, "SELECT * FROM `kiusc_departments`");
		while($acc_dep = mysqli_fetch_assoc($acc_departments))
		{
			echo '<option value="'.$acc_dep['id'].'"> '.$acc_dep['name'].' </option> ';
		}
		?>
		</select>
	</td>
	<td> <select name="adm_department_id[]" id="adm_dep_id_1">
			<option value="0"> Select Department </option>
			<?php
			$admin_departments = mysqli_query($conn, "SELECT * FROM `kiusc_admin_departments`");
			while($admi_dep = mysqli_fetch_assoc($admin_departments))
			{
				echo '<option value="'.$admi_dep['id'].'"> '.$admi_dep['name'].' </option> ';
			}
			?>
		</select>
	</td>
</tr>
<tr>
	<td colspan="2"> </td>
    <td> <input type="button" onclick="rowAdd()" value="Add More Designation" style="background-color: burlywood; border-radius: 17px; color: black;" /> </td>
</tr>

</table>

	<input type="submit" name="create" value="Save" style="background-color: burlywood; border-radius: 17px; color: black;" />
</form>

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
        xmlhttp.open("GET", "../../newfiles/ldap/faculty/ajax_check_designation_type.php?desg_id="+v, true);
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
