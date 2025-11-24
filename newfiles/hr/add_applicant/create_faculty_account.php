<style>

.chzn-container-single .chzn-single span{
	color: black;
}

.btn-primary{
	text-align: center;
    margin: auto;
    display: block;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
	-webkit-appearance: none;
	margin: 0;
}
</style>
<?php
error_reporting(0);
$date = date("Y-m-d");
$user = JFactory::getUser();

$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/demo.css");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.easyui1.min.js");

$doc->addStyleSheet(JURI::root( true )."/dropdown2/plugins.css");
$doc->addScript(JURI::root( true )."/dropdown2/jquery.js");
$doc->addScript(JURI::root( true )."/dropdown2/jquery-ui.min.js");
$doc->addScript(JURI::root( true )."/dropdown2/jquery.cooki.js");
$doc->addScript(JURI::root( true )."/dropdown2/plugins.js");
$doc->addScript(JURI::root( true )."/dropdown2/scripts.js");

include 'newfiles/common.php';
include 'newfiles/conn.php';
include 'newfiles/my_ldap.php';

if (checkPermission(JFactory::getUser(), "HRM")==0)
{
	echo"You dont have right to access this page!";
	return;
}	
$edit_emp_id = 0;
if(isset($_REQUEST['emp_id']))
	$edit_emp_id = $_REQUEST['emp_id'];

if(isset($_POST['user_id']))
{
	$user_id = $_POST['user_id'];
}
if(isset($_POST['save']) || isset($_POST['save_next']))
{
	$emp_id=$_POST['emp_id'];
	$employee_no = $_REQUEST['employee_no'];
	$first_name =  $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$fname = $_POST['fname'];
	$email = $_POST['email'];
	$cnic = $_POST['cnic'];
	$passport_no = $_POST['passport_no'];
	$cell_no1 = $_POST['cell_no1'];
	$cell_no2 = $_POST['cell_no2'];
	$nationality = $_POST['nationality'];
	$permanent_address = $_POST['permanent_address'];
	$current_address = $_POST['current_address'];
	$country = $_POST['country'];
	$district = $_POST['district'];
	$tehsil = $_POST['tehsil'];
	$city_town = $_POST['city_town'];
	$gender = $_POST['gender'];
	$marital_status = $_POST['marital_status'];
	$dob = $_POST['dob'];
	$official_email = $_POST['official_email'];
	$official_phone_no = $_POST['official_phone_no'];
	$bank_id = $_POST['bank_id'];
	$account_no = $_POST['account_no'];
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

	$is_current=0;
	if(isset($_POST['is_current']))
		$is_current = $_POST['is_current'];

	$is_payroll=0;
	if(isset($_POST['is_payroll']))
		$is_payroll = $_POST['is_payroll'];
	
	$is_active=0;
	if(isset($_POST['is_active']))
		$is_active = $_POST['is_active'];

	$employees=mysqli_query($conn, "SELECT * FROM `kiusc_employees` where id='$emp_id'");
	$employee=mysqli_num_rows($employees);
	$emp_data = mysqli_fetch_assoc($employees);
	$emp_id = $emp_data['id'];
	
	$previous_data = $emp_data;
	$current_data = [
		'emp_no' => $employee_no,
		'first_name' => $first_name,
		'last_name' => $last_name,
		'fname' => $fname,
		'email' => $email,
		'cnic' => $cnic,
		'passport_no' => $passport_no,
		'cell_no1' => $cell_no1,
		'cell_no2' => $cell_no2,
		'nationality' => $nationality,
		'permanant_address' => $permanent_address,
		'current_address' => $current_address,
		'city_town' => $city_town,
		'tehsil' => $tehsil,
		'district' => $district,
		'country' => $country,
		'gender' => $gender,
		'marital_status' => $marital_status,
		'dob' => $dob,
		'official_email' => $official_email,
		'bank_id' => $bank_id,
		'account_no' => $account_no,
		'official_phone_no' => $official_phone_no,
		'designation_id' => $designation_id,
		'acc_department_id' => $acc_department_id,
		'adm_department_id' => $adm_department_id,
		'date_of_joining' => $date_of_joining,
		'service_end_date' => $service_end_date,
		'employment_nature' => $employment_nature,
		'contract_period_months' => $contract_period_months,
		'mode_of_employment' => $mode_of_employment,
		'employment_scale' => $employment_scale,
		'pay_scale' => $pay_scale,
		'is_current' => $is_current,
		'is_payroll' => $is_payroll,
		'is_active' => $is_active
	];
	$current_desg_data = [
		'emp_id' => $emp_id,
		'designation_id' => $designation_id,
		'acc_department_id' => $acc_department_id,
		'adm_department_id' => $adm_department_id,
		'date_of_joining' => $date_of_joining,
		'service_end_date' => $service_end_date,
		'employment_nature' => $employment_nature,
		'contract_period_months' => $contract_period_months,
		'mode_of_employment' => $mode_of_employment,
		'employment_scale' => $employment_scale,
		'pay_scale' => $pay_scale,
		'inserted_by' => $user->id,
		'inserted_date' => $date,
		'is_current' => $is_current,
		'is_initial' => 1
	];
	$cnic_without_dashes = explode("-", $cnic);
	$cnic_without_dashes = implode("",$cnic_without_dashes);

	$img_path = $cnic_without_dashes . ".jpeg";

	$employ=mysqli_query($conn, "SELECT * FROM `kiusc_employees` where id='$emp_id'");
	$employe = mysqli_fetch_assoc($employ);
	$cnic_compare = $employe['cnic'];
	if($cnic_compare != $cnic && $cnic_compare != NULL)
	{
		$cnic_compares = explode("-", $cnic_compare);
		$cnic_compare = implode("",$cnic_compares);
		$img_path_old = $cnic_compare . ".jpeg";
		rename("newfiles/hr/pictures/".$img_path_old, "newfiles/hr/pictures/".$img_path);

	}

	
	if($_FILES['picture']['name'])
	{
		if($_FILES['picture']['type'] == "image/gif" || $_FILES['picture']['type'] == "image/jpeg" || $_FILES['picture']['type'] == "image/jpg" || $_FILES['picture']['type'] == "image/png" || $_FILES['picture']['type'] == "image/bmp")
		{
			
			if(move_uploaded_file($_FILES['picture']['tmp_name'], "newfiles/hr/pictures/".$img_path))
			{ 
					$src_img = imagecreatefromjpeg("newfiles/hr/pictures/".$img_path); 
					
					   ///////////// resize //////////////
								  $old_x          =   imageSX($src_img);
								  $old_y          =   imageSY($src_img);
							  
								  if($old_x > $old_y) 
								  {
									  $thumb_w    =   150;
									  $thumb_h    =   $old_y*(200/$old_x);
								  }
							  
								  if($old_x < $old_y) 
								  {
									  $thumb_w    =   $old_x*(150/$old_y);
									  $thumb_h    =   200;
								  }
							  
								  if($old_x == $old_y) 
								  {
									  $thumb_w    =   150;
									  $thumb_h    =   200;
								  }
							  
								  $dst_img        =   ImageCreateTrueColor($thumb_w,$thumb_h);
							  
								  imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
					/////////////////   end resize ///////////////
					
					imagejpeg($dst_img, "newfiles/hr/pictures/".$img_path, 80);
					
					imagedestroy($dst_img);
					imagedestroy($src_img);
			}
			else
			{
				echo "Could not upload picture";
			}
			
		}
		else
		{
			echo "File formate should be jpg, gif, png, bmp";
		}
	}

	if($employee > 0)
	{
		if($img_path != NULL)
		{
			mysqli_query($conn, "UPDATE `kiusc_employees` 
									SET `emp_no`= '$employee_no', `first_name`='$first_name',`last_name`='$last_name',`fname`='$fname',`email`='$email',`cnic`='$cnic',`passport_no`='$passport_no',`cell_no1`='$cell_no1',`cell_no2`='$cell_no2',`nationality`='$nationality',`permanant_address`='$permanent_address',`current_address`='$current_address',`city_town`='$city_town',`tehsil`='$tehsil',`district`='$district',`country`='$country',`gender`='$gender',`marital_status`='$marital_status',`dob`='$dob',`official_email`='$official_email',`bank_id`='$bank_id',`account_no`='$account_no',`official_phone_no`='$official_phone_no', `designation_id`='$designation_id',`acc_department_id`='$acc_department_id',`adm_department_id`='$adm_department_id',`date_of_joining`='$date_of_joining',`service_end_date`='$service_end_date',`employment_nature`='$employment_nature',`contract_period_months`='$contract_period_months',`mode_of_employment`='$mode_of_employment',`employment_scale`='$employment_scale', `pay_scale` = '$pay_scale', `updated_by` = '".$user->id."', `updated_date`='$date', `picture`='$img_path', `is_payroll` = '$is_payroll', `is_active` = '$is_active' 
										WHERE id=$emp_id"); 
			if($is_current > 0)
			{

				$emp_deg_cur=mysqli_query($conn, "SELECT * FROM `kiusc_emp_designations` where emp_id='$emp_id' and is_current = 1");
				$emp_deg_cur=mysqli_num_rows($emp_deg_cur);
				if($emp_deg_cur > 0)
				{
					print "<font color='green'> Your Current Designation is Changed, Please Confirm! </font>";
					mysqli_query($conn, "UPDATE `kiusc_emp_designations` 
											SET `is_current`='0' 
												WHERE emp_id='$emp_id'");
				}
			}
		}
		else
		{
			mysqli_query($conn, "UPDATE `kiusc_employees` 
									SET `emp_no`= '$employee_no',`first_name`='$first_name',`last_name`='$last_name',`fname`='$fname',`email`='$email',`cnic`='$cnic',`passport_no`='$passport_no',`cell_no1`='$cell_no1',`cell_no2`='$cell_no2',`nationality`='$nationality',`permanant_address`='$permanent_address',`current_address`='$current_address',`city_town`='$city_town',`tehsil`='$tehsil',`district`='$district',`country`='$country',`gender`='$gender',`marital_status`='$marital_status',`dob`='$dob',`official_email`='$official_email',`bank_id`='$bank_id',`account_no`='$account_no',`official_phone_no`='$official_phone_no', `designation_id`='$designation_id',`acc_department_id`='$acc_department_id',`adm_department_id`='$adm_department_id',`date_of_joining`='$date_of_joining',`service_end_date`='$service_end_date',`employment_nature`='$employment_nature',`contract_period_months`='$contract_period_months',`mode_of_employment`='$mode_of_employment',`employment_scale`='$employment_scale', `pay_scale` = '$pay_scale' , `updated_by` = '".$user->id."', `updated_date`='$date', `is_payroll` = '$is_payroll',`is_active` = '$is_active' 
										WHERE cnic='$cnic'");
			if($is_current > 0)
			{
				$emp_deg_cur=mysqli_query($conn, "SELECT * 
													FROM `kiusc_emp_designations` 
														where emp_id='$emp_id' 
															AND is_current = 1");
				$emp_deg_cur=mysqli_num_rows($emp_deg_cur);
				if($emp_deg_cur > 0)
				{
					print "<font color='green'> Your Current Designation is Changed, Please Confirm! </font>";
					mysqli_query($conn, "UPDATE `kiusc_emp_designations` 
											SET `is_current`='0' 
												WHERE emp_id='$emp_id'");
				}
			}
		}

		mysqli_query($conn, "UPDATE `kiusc_emp_designations` 
								SET `designation_id`='$designation_id',`acc_department_id`='$acc_department_id',`adm_department_id`='$adm_department_id',`date_of_joining`='$date_of_joining',`service_end_date`='$service_end_date',`employment_nature`='$employment_nature',`contract_period_months`='$contract_period_months',`mode_of_employment`='$mode_of_employment',`employment_scale`='$employment_scale', `pay_scale` = '$pay_scale',`is_current`='$is_current',`is_initial`='1'
									WHERE `designation_id`='$designation_id' 
										AND `acc_department_id`='$acc_department_id' 
										AND `adm_department_id`='$adm_department_id'
										AND `pay_scale` = '$pay_scale'
										AND emp_id='$emp_id'");

		$emp_desgs=mysqli_query($conn, "SELECT * 
										FROM `kiusc_emp_designations` 
											WHERE emp_id='$edit_emp_id' AND is_initial = 1");
		$emp_desg=mysqli_num_rows($emp_desgs);
		$previous_desg_data = mysqli_fetch_assoc($emp_desgs);
		log_employee_change($conn, 'kiusc_emp_designations', $previous_desg_data, $current_desg_data, $user->id);

		if($emp_desg == 0)
		{
			mysqli_query($conn, "INSERT INTO `kiusc_emp_designations`(`emp_id`, `designation_id`, `acc_department_id`, `adm_department_id`, `date_of_joining`, `service_end_date`, `employment_nature`, `contract_period_months`, `mode_of_employment`, `employment_scale`, `pay_scale`,`is_current`,`is_initial`) 
			VALUES ('$emp_id','$designation_id','$acc_department_id','$adm_department_id','$date_of_joining','$service_end_date','$employment_nature','$contract_period_months','$mode_of_employment','$employment_scale','$pay_scale','$is_current','1')");
			log_employee_change($conn, 'kiusc_emp_designations', [], $current_desg_data, $user->id);
		}
		log_employee_change($conn, 'kiusc_employees', $previous_data, $current_data, $user->id);
		print "<font color='green'> Record Updated Successfully </font>";
	}
	else
	{
		if($user_id == -1)
		{
			if($email != NULL || $email != "")
			{
				$ex = mysqli_query($conn, "SELECT * FROM `kiusc_employees` WHERE `email` = '$email'");
				$ex_count = mysqli_num_rows($ex);
				if($ex_count)
				{
					print "<font color='red'> Email already exist </font>";
					return;
				}
			}
			///////////////Create User Account
			$ex = mysqli_query($conn, "SELECT * FROM `s04cf_users` WHERE `username` = '".$cnic_without_dashes."'");
			$ex_count = mysqli_num_rows($ex);
			if($ex_count)
			{
				$user_exists = mysqli_fetch_assoc($ex);
				$user_id = $user_exists['id'];
				// print "<font color='red'> Username already exist </font>";
				// return;
			}
			else
			{
				$password = $cnic_without_dashes;
				//$password = randPassword(7, false, 'lud');
				
				jimport('joomla.user.helper');
				$salt = JUserHelper::genRandomPassword(32);
				$crypted = JUserHelper::getCryptedPassword($password, $salt);
				$pass = $crypted.':'.$salt;	
				$name = $first_name." ".$last_name;
				mysqli_query($conn, "INSERT INTO `s04cf_users`(`name`, `username`, `email`, `password`, `block`) 
					VALUES ('$name', '$cnic_without_dashes', '$email', '$pass', '0')");   
				
					$user_id = mysqli_insert_id($conn);

					
					mysqli_query($conn, "INSERT INTO `s04cf_user_usergroup_map`(`user_id`, `group_id`) VALUES ('$user_id', '2')");
					
					//// send password ///
					$recipient = $email;
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
		}
		/////////////////////
		$employ_no=mysqli_query($conn, "SELECT * FROM `kiusc_employees` where emp_no='$employee_no'");
		$employ_no=mysqli_num_rows($employ_no);
		if($employ_no > 0)
		{
			print "<font color='green'> Employee Number Must be Unique </font>";
			//return;
		}
		mysqli_query($conn, "INSERT INTO `kiusc_employees`(`emp_no`,`user_id`, `first_name`, `last_name`, `fname`, `email`, `cnic`, `passport_no`, `cell_no1`, `cell_no2`, `nationality`, `permanant_address`, `current_address`, `city_town`, `tehsil`, `district`, `country`, `gender`, `marital_status`, `dob`,`official_email`,`bank_id`,`account_no`,`official_phone_no`, `designation_id`, `acc_department_id`, `adm_department_id`, `date_of_joining`, `service_end_date`, `employment_nature`, `contract_period_months`, `mode_of_employment`, `employment_scale`, `pay_scale`, `inserted_by`, `inserted_date`, `picture`, `is_payroll`,`is_active`) 
		VALUES ('$employee_no', '$user_id','$first_name','$last_name','$fname','$email','$cnic','$passport_no','$cell_no1','$cell_no2','$nationality','$permanent_address','$current_address','$country','$district','$tehsil','$city_town','$gender','$marital_status','$dob','$official_email','$bank_id','$account_no','$official_phone_no', '$designation_id','$acc_department_id','$adm_department_id','$date_of_joining','$service_end_date','$employment_nature','$contract_period_months','$mode_of_employment','$employment_scale', '$pay_scale','".$user->id."','$date', '$img_path', '$is_payroll','$is_active')"); 
		
		$emp_id = mysqli_insert_id($conn);

		$emp_deg_cur=mysqli_query($conn, "SELECT * FROM `kiusc_emp_designations` where emp_id='$emp_id' and is_current = 1");
		$emp_deg_cur=mysqli_num_rows($emp_deg_cur);
		if($emp_deg_cur > 0)
		{
			print "<font color='green'> Your Current Designation is Changed, Please Confirm! </font>";
			mysqli_query($conn, "UPDATE `kiusc_emp_designations` SET `is_current`='0' WHERE emp_id='$emp_id'");
		}

		mysqli_query($conn, "INSERT INTO `kiusc_emp_designations`(`emp_id`, `designation_id`, `acc_department_id`, `adm_department_id`, `date_of_joining`, `service_end_date`, `employment_nature`, `contract_period_months`, `mode_of_employment`, `employment_scale`, `pay_scale`, `inserted_by`, `inserted_date`,`is_current`,`is_initial`) 
		VALUES ('$emp_id','$designation_id','$acc_department_id','$adm_department_id','$date_of_joining','$service_end_date','$employment_nature','$contract_period_months','$mode_of_employment','$employment_scale','$pay_scale','".$user->id."','$date','$is_current','1')");
		log_employee_change($conn, 'kiusc_employees', [], $current_data, $user->id);
		print "<font color='green'> Record Insert Successfully </font>";
	}
	
	if(isset($_POST['save_next']))
		header("location:../faculty-designations?emp_id=".$emp_id."");
}
$checked="";

$show=0;
$cnic_search="";
if($edit_emp_id > 0)
{
	$emp=mysqli_query($conn, "SELECT * FROM `kiusc_employees` where id='$edit_emp_id'");
	$emp=mysqli_fetch_assoc($emp);
	$cnic_search = $emp['cnic'];
	$show=1;
}
if(isset($_POST['search']) || isset($_POST['save']))
{
	$cnic_search = $_POST['cnic_search'];
	if($cnic_search != "" || $cnic_search != NULL)
	{
		$employees=mysqli_query($conn, "SELECT * FROM `kiusc_employees` where cnic='$cnic_search'");
		$emp_id = mysqli_fetch_assoc($employees);
	}
	else
	{
		$employees=mysqli_query($conn, "SELECT * FROM `kiusc_employees` where user_id='$user_id'");
		$emp_id = mysqli_fetch_assoc($employees);
	}
	$edit_emp_id = $emp_id['id'];
	$show=1;
}

$db = JFactory::getDBO();    
	$query = $db->getQuery(true);
    $query->select('*')
		  ->from("s04cf_users")
		  ->where("block=0");
		  
	$db->setQuery($query);
	$db->execute();
    $users = $db->loadAssocList();

?>
<form action="" method="POST">
    <table class="table table-striped table-hover">

		<tr>
			<td>Search by CNIC</td>
			<td>
				<input type="text" name="cnic_search" id="cnic" autocomplete="off" style="width:500px" minlength="13" value="<?php echo isset($cnic_search) ? $cnic_search : "" ?>"  />
				<span id="cnic-error" style="color: red; display: none;">Invalid CNIC format.</span>
			</td>
		</tr>
		<tr>
			<td>Select User:</td>
			<td>
				<select name="user_id" id="user_id">
					<option value="-1">Select user</option>
					<?php foreach($users as $us): 
						$sel = "";
						if($us['id'] == $user_id)
							$sel = "selected";
					?>
					<option value="<?php echo $us['id'] ?>" <?php echo $sel ?>><?php echo $us['name'];?></option>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>

        <tr>
            <td></td>
            <td><input type="submit" name="search" value="Search" class="btn2 success" /></td>
        </tr>
    </table>
</form>
<?php
if($show == 1)
{
	$payroll_chk="";

	$emps=mysqli_query($conn, "SELECT * FROM `kiusc_employees` where id='$edit_emp_id'");
	$emp=mysqli_fetch_assoc($emps);
	$designation_id = $emp['designation_id'];
	$acc_department_id = $emp['acc_department_id'];
	$adm_department_id = $emp['adm_department_id'];
	$pay_scale = $emp['pay_scale'];

	$emp_designations=mysqli_query($conn, "SELECT * FROM `kiusc_emp_designations` 
												where `designation_id`='$designation_id' 
													AND `acc_department_id`='$acc_department_id' 
													AND `adm_department_id`='$adm_department_id'
													AND `pay_scale` = '$pay_scale'
													AND emp_id = '$edit_emp_id'");

	$emp_desig = mysqli_fetch_assoc($emp_designations);

	if($emp_desig['is_current'] == 1)
		$checked="Checked";

	if($emp['is_payroll'] == 1)
		$payroll_chk = "Checked";

	if($emp['is_active'] == 1)
		$is_active = "Checked";
	?>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="emp_id" value="<?php echo isset($emp['id']) ? $emp['id'] : "" ?>">
		<input type="hidden" name="user_id" value="<?php echo isset($user_id) ? $user_id : "" ?>">
		<h3>General Information</h3>
		<table class="table table-striped table-hover">
			<input type="hidden" name="cnic_search" style="width:500px"
				value="<?php echo isset($cnic_search) ? $cnic_search : "" ?>" />
			<tr>
				<td> Employee No: </td>
				<td> <input type="text" name="employee_no" value="<?php echo isset($emp['emp_no']) ? $emp['emp_no'] : "" ?>"
						style="width:500px" /></td>
			</tr>
			<tr>
				<td> <label for="file-ip-1">Upload Image</label> </td>
				<td>
					<img src="<?php echo isset($emp['picture']) ? 'newfiles/hr/pictures/'.$emp['picture'] : 'newfiles/hr/pictures/pic.jpg' ?>"
						style="width: 150px; height: 200px;border: 5px solid;" id="file-ip-1-preview" />
					<input type="file" id="file-ip-1" name="picture" accept="image/*" onchange="showPreview(event);"/>
				</td>
			</tr>
			<tr>
				<td> First Name : </td>
				<td> <input type="text" name="first_name" style="width:500px"
						value="<?php echo isset($emp['first_name']) ? $emp['first_name'] : "" ?>" /> </td>
			</tr>
			<tr>
				<td> Last Name : </td>
				<td> <input type="text" name="last_name" style="width:500px"
						value="<?php echo isset($emp['last_name']) ? $emp['last_name'] : "" ?>" /> </td>
			</tr>
			<tr>
				<td> Father Name : </td>
				<td> <input type="text" name="fname" style="width:500px"
						value="<?php echo isset($emp['fname']) ? $emp['fname'] : "" ?>" /> </td>
			</tr>
			<tr>
				<td> Email : </td>
				<td> <input type="email" name="email" style="width:500px"
						value="<?php echo isset($emp['email']) ? $emp['email'] : "" ?>" /> </td>
			</tr>
			<tr>
				<td> CNIC : </td>
				<td> <input type="text" name="cnic" id="cnic1" autocomplete="off" style="width:500px"
						value="<?php echo isset($emp['cnic']) ? $emp['cnic'] : $cnic_search ?>" required/> </td>
			</tr>
			<tr>
				<td> Passport Number : </td>
				<td> <input type="text" name="passport_no" style="width:500px"
						value="<?php echo isset($emp['passport_no']) ? $emp['passport_no'] : "" ?>" /> </td>
			</tr>
			<tr>
				<td> Cell No.1 : </td>
				<td> <input type="text" name="cell_no1" style="width:500px"
						value="<?php echo isset($emp['cell_no1']) ? $emp['cell_no1'] : "" ?>" /> </td>
			</tr>
			<tr>
				<td> Cell No.2 : </td>
				<td> <input type="text" name="cell_no2" style="width:500px"
						value="<?php echo isset($emp['cell_no2']) ? $emp['cell_no2'] : "" ?>" /> </td>
			</tr>
			<tr>
				<td> Nationality : </td>
				<td> <input type="text" name="nationality" style="width:500px"
						value="<?php echo isset($emp['nationality']) ? $emp['nationality'] : "" ?>" /> </td>
			</tr>
			<tr>
				<td> Permanent Address : </td>
				<td> <input type="text" name="permanent_address" style="width:500px"
						value="<?php echo isset($emp['permanant_address']) ? $emp['permanant_address'] : "" ?>" /> </td>
			</tr>
			<tr>
				<td> Current Address : </td>
				<td> <input type="text" name="current_address" style="width:500px"
						value="<?php echo isset($emp['current_address']) ? $emp['current_address'] : "" ?>" /> </td>
			</tr>
			<tr>
				<td> Country : </td>
				<td> <input type="text" name="country" style="width:500px"
						value="<?php echo isset($emp['country']) ? $emp['country'] : "" ?>" /> </td>
			</tr>
			<tr>
				<td> District : </td>
				<td> <input type="text" name="district" style="width:500px"
						value="<?php echo isset($emp['district']) ? $emp['district'] : "" ?>" /> </td>
			</tr>
			<tr>
				<td> Tehsil : </td>
				<td> <input type="text" name="tehsil" style="width:500px"
						value="<?php echo isset($emp['tehsil']) ? $emp['tehsil'] : "" ?>" /> </td>
			</tr>
			<tr>
				<td> City/ Town : </td>
				<td> <input type="text" name="city_town" style="width:500px"
						value="<?php echo isset($emp['city_town']) ? $emp['city_town'] : "" ?>" /> </td>
			</tr>
			<tr>
				<td> Gender : </td>
				<td>
					<select name="gender" style="width:500px">
						<?php
						$gender = mysqli_query($conn, "SHOW COLUMNS FROM kiusc_employees WHERE Field = 'gender'");
						$gender = mysqli_fetch_assoc($gender);
						$gender = explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2", $gender['Type']));
						foreach($gender as $type)
						{
							$sel = "";
							if(isset($emp['gender']))
							{
								if($emp['gender'] == $type)
									$sel = " selected ";
							}
							
							echo "<option value='$type' $sel>$type</option>";
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td> Marital Status : </td>
				<td>
					<select name="marital_status" style="width:500px">
						<?php
						$marital_status = mysqli_query($conn, "SHOW COLUMNS FROM kiusc_employees WHERE Field = 'marital_status'");
						$marital_status = mysqli_fetch_assoc($marital_status);
						$marital_status = explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2", $marital_status['Type']));
						foreach($marital_status as $type)
						{
							$sel = "";
							if(isset($emp['marital_status']))
							{
								if($emp['marital_status'] == $type)
									$sel = " selected ";
							}
							
							echo "<option value='$type' $sel>$type</option>";
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td> Date of Birth : </td>
				<td> <input type="date" name="dob" id="dob" style="width:500px"
						value="<?php echo isset($emp['dob']) ? $emp['dob'] : "" ?>" /> </td>
			</tr>
			<tr>
				<td> Official Email : </td>
				<td> <input type="email" name="official_email" style="width:500px"
						value="<?php echo isset($emp['official_email']) ? $emp['official_email'] : "" ?>" /> </td>
			</tr>
			<tr>
				<td> Official Phone : </td>
				<td> <input type="text" name="official_phone_no" style="width:500px"
						value="<?php echo isset($emp['official_phone_no']) ? $emp['official_phone_no'] : "" ?>" /> </td>
			</tr>
			<tr>
				<td>Select Bank : </td>
				<td>
					<select name="bank_id" style="width:500px">
						<option value="0"> Select Bank </option>
						<?php
					$banks = mysqli_query($conn, "SELECT * FROM `kiusc_banks`");
					while($bank = mysqli_fetch_assoc($banks))
					{
						$sel = "";
						if(isset($bank['id']))
						{
							if($bank['id'] == $emp['bank_id'])
								$sel = " selected ";
						}
						echo '<option value="'.$bank['id'].'"'.$sel.'> '.$bank['bank_name'].' </option> ';
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td> Account Number : </td>
				<td> <input type="text" name="account_no" style="width:500px"
						value="<?php echo isset($emp['account_no']) ? $emp['account_no'] : "" ?>" /> </td>
			</tr>
		</table>
		<h3>Employement Information</h3>
		<table class="table table-striped table-hover">
			<tr>
				<td>Initial Designation : </td>
				<td>
					<select name="designation_id" style="width:500px" onchange="checkDesignationType(this.value, 1)">
						<option value="0"> Select Designation </option>
						<?php
							$designations = mysqli_query($conn, "SELECT * FROM `kiusc_designations`");
							while($desg = mysqli_fetch_assoc($designations))
							{
								$sel = "";
								if(isset($desg['id']))
								{
									if($desg['id'] == $emp['designation_id'])
										$sel = " selected ";
								}
								echo '<option value="'.$desg['id'].'"'.$sel.'> '.$desg['designation'].' </option> ';
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td> Initial Accademic Department : </td>
				<td>
					<select name="acc_department_id" style="width:500px" id="acc_dep_id_1">
						<option value="0"> Select Department </option>
						<?php
							$acc_departments = mysqli_query($conn, "SELECT * FROM `kiusc_departments`");
							while($acc_dep = mysqli_fetch_assoc($acc_departments))
							{
								$sel = "";
								if(isset($acc_dep['id']))
								{
									if($acc_dep['id'] == $emp['acc_department_id'])
										$sel = " selected ";
								}
								echo '<option value="'.$acc_dep['id'].'"'.$sel.'> '.$acc_dep['name'].' </option> ';
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td> Initial Admin Department</td>
				<td> <select name="adm_department_id" style="width:500px" id="adm_dep_id_1">
						<option value="0"> Select Department </option>
						<?php
							$admin_departments = mysqli_query($conn, "SELECT * FROM `kiusc_admin_departments`");
							while($admi_dep = mysqli_fetch_assoc($admin_departments))
							{
								$sel = "";
								if(isset($admi_dep['id']))
								{
									if($admi_dep['id'] == $emp['adm_department_id'])
										$sel = " selected ";
								}
								echo '<option value="'.$admi_dep['id'].'"'.$sel.'> '.$admi_dep['name'].' </option> ';
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td> Initial Employee Nature : </td>
				<td>
					<select name="employment_nature" style="width:500px" id="employment_nature" onchange="showHidePeriodTr(this.value)">
						<option value="">...Select Status....</option>
						<?php
							$employment_nature = mysqli_query($conn, "SHOW COLUMNS FROM kiusc_employees WHERE Field = 'employment_nature'");
							$employment_nature = mysqli_fetch_assoc($employment_nature);
							$employment_nature = explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2", $employment_nature['Type']));
							foreach($employment_nature as $status)
							{
								$sel = "";
								if(isset($emp['employment_nature']))
								{
									if($emp['employment_nature'] == $status)
										$sel = " selected ";
								}
								
								echo "<option value='$status' $sel>$status</option>";
							}
						?>
					</select>
				</td>
			</tr>
			<?php  $date =  Date("m-d-Y"); ?>
			<tr>
				<th>Initial Date of Joining</th>
				<td>
					<input type="date" style="width:500px" name="date_of_joining" id="date_of_joining" onchange="calEndDate()" value="<?php echo isset($emp['date_of_joining']) ? $emp['date_of_joining'] : $date ?>">
				</td>
			</tr>
			<tr id="period_tr" style="width:500px"
				<?php echo isset($emp['employment_nature']) ? (($emp['employment_nature']=="Regular") ? "hidden" : "") : "hidden" ?> hidden>
				<th>Contract Period (in months)</th>
				<td>
					<input type="number" name="contract_period_months" id="contract_period_months" onkeyup="calEndDate()" value="<?php echo isset($emp['contract_period_months']) ? $emp['contract_period_months'] : "1" ?>">
				</td>
			</tr>
			<tr>
				<td>
					<input type="date" style="width:500px" name="service_end_date" id="service_end_date" value="<?php echo isset($emp['service_end_date']) ? $emp['service_end_date'] : "" ?>">
				</td>
			</tr>
			<tr>
				<td>Length of Service:</td>
				<td>
					<input type="text" name="service_length" id="service_length" readonly>
				</td>
			</tr>
			<tr>
				<td> Mode of Employment : </td>
				<td>
					<select name="mode_of_employment" style="width:500px">
						<?php
					$mode_of_employment = mysqli_query($conn, "SHOW COLUMNS FROM kiusc_employees WHERE Field = 'mode_of_employment'");
					$mode_of_employment = mysqli_fetch_assoc($mode_of_employment);
					$mode_of_employment = explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2", $mode_of_employment['Type']));
					foreach($mode_of_employment as $status)
					{
						$sel = "";
						if(isset($emp['mode_of_employment']))
						{
							if($emp['mode_of_employment'] == $status)
								$sel = " selected ";
						}
						echo "<option value='$status' $sel>$status</option>";
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Initial Employment Scale : </td>
				<td>
					<select name="employment_scale" style="width:500px">
						<?php
							$employment_scale = mysqli_query($conn, "SHOW COLUMNS FROM kiusc_employees WHERE Field = 'employment_scale'");
							$employment_scale = mysqli_fetch_assoc($employment_scale);
							$employment_scale = explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2", $employment_scale['Type']));
							foreach($employment_scale as $status)
							{
								$sel = "";
								if(isset($emp['employment_scale']))
								{
									if($emp['employment_scale'] == $status)
										$sel = " selected ";
								}
								echo "<option value='$status' $sel>$status</option>";
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Initial Pay Scale : </td>
				<td>
					<select name="pay_scale" style="width:500px">
						<?php
							for($i=1;$i<=22;$i++)
							{
								$sel = "";
								if(isset($emp['pay_scale']))
								{
									if($emp['pay_scale'] == $i)
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
				<td> <input type="checkbox" name="is_current" style="width:500px" value="1" <?php echo $checked ?> /> </td>
			</tr>
			<tr>
			<tr>
				<td> Want to Add in Payroll? </td>
				<td> <input type="checkbox" name="is_payroll" style="width:500px" value="1" <?php echo $payroll_chk ?> />
				</td>
			</tr>
			<tr>
			<tr>
				<td> Is Active? </td>
				<td> <input type="checkbox" name="is_active" style="width:500px" value="1" <?php echo $is_active ?> /> </td>
			</tr>
			<tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>
					<input type="submit" name="save" value="Save" class="btn2 success" />
					<input type="submit" name="save_next" value="Save & Next" class="btn2 success" />
					<input type="submit" name="next" value="Next" class="btn2 success" />
				</td>
				<td></td>
			</tr>
		</table>
	</form>
	<hr>
	<?php
	if(isset($_POST['next']))
		header("location: ../faculty-designations?emp_id=".$edit_emp_id."");
}

function log_employee_change($conn, $table, $previous_data, $current_data, $updated_by) {
    $previous_json = json_encode($previous_data, JSON_UNESCAPED_UNICODE);
    $current_json = json_encode($current_data, JSON_UNESCAPED_UNICODE);
    $updated_date = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO `uobs_employee_log` (`table`, `previous_data`, `current_changes`, `updated_by`, `updated_date`) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $table, $previous_json, $current_json, $updated_by, $updated_date);
    $stmt->execute();
    $stmt->close();
}

?>
<script>
$(document).ready(function() {
    $('#user_id').on('change', function() {
        let userId = $(this).val();
        let cnicInput = $('#cnic');

        if (userId != '-1') {
            // AJAX request to get CNIC based on user ID
            $.ajax({
                url: '../../newfiles/hr/add_applicant/get_cnic_by_user_id.php',
                type: 'POST',
                data: { user_id: userId },
                success: function(response) {
                    let data = JSON.parse(response);
                    if (data.success) {
                        cnicInput.val(data.cnic); // Set the CNIC value in the input field
                        cnicInput.css('border', ''); // Reset border if valid CNIC
                    } else {
                        cnicInput.val(''); // Clear the input if no CNIC found
                        alert('No CNIC found for the selected user.');
                    }
                }
            });
        } else {
            cnicInput.val(''); // Clear the input if no user is selected
        }
    });
});

$('#cnic').on('input', function() {
    let cnic = $(this).val();
    let errorSpan = $('#cnic-error');
    let userDropdown = $('#user_id');
    
    // Reset the user dropdown
    userDropdown.val('-1');
    
    // Validate CNIC format
    let cnicPattern = /^\d{5}-\d{7}-\d{1}$/;
    if (cnic.length === 15 && cnicPattern.test(cnic)) {
        errorSpan.hide();
        $(this).css('border', ''); // Remove the red border if the format is correct

        // AJAX request to check CNIC
        $.ajax({
            url: '../../newfiles/hr/add_applicant/get_user_by_cnic.php',
            type: 'POST',
            data: { cnic: cnic },
            success: function(response) {
                console.log(response); // Check what is being returned
                
                let data = JSON.parse(response);
                if (data.success) {
                    // Ensure the value exists in the dropdown
                    let userExists = false;
                    userDropdown.find('option').each(function() {
                        if ($(this).val() == data.user_id) {
                            userExists = true;
                        }
                    });
                    
                    if (userExists) {
                        userDropdown.val(data.user_id);
                    } else {
                        console.warn('User ID not found in dropdown options.');
                    }
                } else {
                    console.warn('No user found for the provided CNIC.');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX request failed: ' + textStatus + ', ' + errorThrown);
            }
        });
    } else {
        errorSpan.show();
        $(this).css('border', '1px solid red'); // Add red border if the format is incorrect
    }
});




function checkDesignationType(v, no) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText.trim() == "Faculty") {
                document.getElementById('adm_dep_id_' + no).value = 0;
                document.getElementById('adm_dep_id_' + no).hidden = true;
                document.getElementById('acc_dep_id_' + no).hidden = false;
            } else {
                document.getElementById('acc_dep_id_' + no).value = 0;
                document.getElementById('acc_dep_id_' + no).hidden = true;
                document.getElementById('adm_dep_id_' + no).hidden = false;
            }
        }
    };
    xmlhttp.open("GET", "../../newfiles/ldap/faculty/ajax_check_designation_type.php?desg_id=" + v, true);
    xmlhttp.send();
}


$('#cnic').keypress(function() {

    //allow  backspace, tab, ctrl+A, escape, carriage return
    if (event.keyCode == 8 || event.keyCode == 9 ||
        event.keyCode == 27 || event.keyCode == 13 ||
        (event.keyCode == 65 && event.ctrlKey === true))
        return;

    evt = window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        event.preventDefault();

    var length = $(this).val().length;
    if (length > 14)
        event.preventDefault();

    if (length == 5 || length == 13)
        $(this).val($(this).val() + '-');

});

$('#cnic1').keypress(function() {

    //allow  backspace, tab, ctrl+A, escape, carriage return
    if (event.keyCode == 8 || event.keyCode == 9 ||
        event.keyCode == 27 || event.keyCode == 13 ||
        (event.keyCode == 65 && event.ctrlKey === true))
        return;

    evt = window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        event.preventDefault();

    var length = $(this).val().length;
    if (length > 14)
        event.preventDefault();

    if (length == 5 || length == 13)
        $(this).val($(this).val() + '-');

});

function showPreview(event) {
    if (event.target.files.length > 0) {
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("file-ip-1-preview");
        preview.src = src;
        preview.style.display = "block";
    }
}

function showHidePeriodTr(v) {
	if (v == "Regular")
		document.getElementById("period_tr").hidden = true;
	else
		document.getElementById("period_tr").hidden = true;

	calEndDate();
}
function calEndDate() {
	var employment_status = document.getElementById("employment_nature").value;
	var date_of_joining = document.getElementById("date_of_joining").value;
	var contract_period_months = parseInt(document.getElementById("contract_period_months").value);
	var dob = document.getElementById("dob").value;
	dob = new Date(dob);
	date_of_joining = new Date(date_of_joining);

	var endDate = "";
	if (employment_status == "Regular") {
		endDate = new Date(dob.setFullYear(dob.getFullYear() + 60));
		endDate = new Date(endDate.setDate(endDate.getDate() - 1));
	} else {
		//endDate = "cccc";
		endDate = new Date(date_of_joining.setMonth(date_of_joining.getMonth() + contract_period_months));
		endDate = new Date(endDate.setDate(endDate.getDate() - 1));
	}
	document.getElementById("service_end_date").value = endDate.toISOString().split('T')[0];
}

function calculateServiceLength() {
    let joiningDateInputEl = document.getElementById("date_of_joining");
    if (!joiningDateInputEl || !joiningDateInputEl.value) return; // prevent null error

    let joiningDate = new Date(joiningDateInputEl.value);
    let today = new Date();

    let years = today.getFullYear() - joiningDate.getFullYear();
    let months = today.getMonth() - joiningDate.getMonth();
    let days = today.getDate() - joiningDate.getDate();

    if (days < 0) {
        months--;
        days += new Date(today.getFullYear(), today.getMonth(), 0).getDate();
    }

    if (months < 0) {
        years--;
        months += 12;
    }

    let serviceField = document.getElementById("service_length");
    if (serviceField) {
        serviceField.value = years + " Years " + months + " Months " + days + " Days";
    }
}

window.onload = function () {
    calculateServiceLength(); // safe now, won’t break if field missing
};

</script>
