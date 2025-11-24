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

	$employees=mysqli_query($conn, "SELECT * FROM `kiusc_employees` where id='$emp_id'");
	$employee=mysqli_num_rows($employees);
	$emp_id = mysqli_fetch_assoc($employees);
	$emp_id = $emp_id['id'];
	
	$cnic_without_dashes = explode("-", $cnic);
	$cnic_without_dashes = implode("",$cnic_without_dashes);

	
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
		
		$emp_desg=mysqli_query($conn, "SELECT * 
										FROM `kiusc_emp_designations` 
											WHERE emp_id='$edit_emp_id' AND is_initial = 1");
		$emp_desg=mysqli_num_rows($emp_desg);
		if($emp_desg == 0)
		{
			mysqli_query($conn, "INSERT INTO `kiusc_emp_designations`(`emp_id`, `designation_id`, `acc_department_id`, `adm_department_id`, `date_of_joining`, `service_end_date`, `employment_nature`, `contract_period_months`, `mode_of_employment`, `employment_scale`, `pay_scale`,`is_current`,`is_initial`) 
			VALUES ('$emp_id','$designation_id','$acc_department_id','$adm_department_id','$date_of_joining','$service_end_date','$employment_nature','$contract_period_months','$mode_of_employment','$employment_scale','$pay_scale','$is_current','1')");
		}
		print "<font color='green'> Record Updated Successfully </font>";
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

	
	$employee_dependent_type=mysqli_query($conn, "SELECT * FROM `employee_dependent_type`");
	$employee_dependent_types=mysqli_fetch_assoc($employee_dependent_type);
	?>
	<h3>General Information</h3>
	<div class="row" >
		<div class="col-md-8">
			<table class="table table-striped table-hover">
				<tr>
					<td> Employee No: </td>
					<td> 
						<?php echo isset($emp['emp_no']) ? $emp['emp_no'] : "" ?>
					</td>
				</tr>
				<tr>
					<td> First Name : </td>
					<td>
						<?php echo isset($emp['first_name']) ? $emp['first_name'] : "" ?>
					</td>
				</tr>
				<tr>
					<td> Last Name : </td>
					<td> <?php echo isset($emp['last_name']) ? $emp['last_name'] : "" ?>
				</tr>
				<tr>
					<td> Email : </td>
					<td> <?php echo isset($emp['email']) ? $emp['email'] : "" ?></td>
				</tr>
				<tr>
					<td> CNIC : </td>
					<td><?php echo isset($emp['cnic']) ? $emp['cnic'] : $cnic_search ?></td>
				</tr>
			</table>
		</div>
		<div class="col-md-4s">
			<img src="<?php echo isset($emp['picture']) ? 'newfiles/hr/pictures/'.$emp['picture'] : 'newfiles/hr/pictures/pic.jpg' ?>"
			style="width: 150px; height: 200px;border: 5px solid;" id="file-ip-1-preview" />
		</div>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="emp_id" value="<?php echo isset($emp['id']) ? $emp['id'] : "" ?>">
		<input type="hidden" name="user_id" value="<?php echo isset($user_id) ? $user_id : "" ?>">
		<?php
			$employee_dependent_types = mysqli_query($conn, "SELECT * FROM `employee_dependent_type`");
			while($employee_dependent_type = mysqli_fetch_assoc($employee_dependent_types))
			{
		?>
			<input type="hidden"  name="name[]"   class="form-control-sm" >
			<div>
				<h4><?= $employee_dependent_type['name'] ?></h4>
				<table class="table table-striped">
					<tr>
						<td>Name</td>
						<td>DOB</td>
						<td>Is Govt Employee</td>
						<td>Is Retired</td>
					</tr>		
					<tr>
						<td>
							<input type="text" name="name[]"  class="form-control-sm" >
						</td>
						<td>
							<input type="text"  name="dob[]"   class="form-control-sm" >
						</td>
						<td>
							<input type="checkbox" name="is_govt_emp[]"    class="form-control-sm" >
						</td>
						<td>
							<input type="checkbox" name="is_retired[]"    class="form-control-sm" >
						</td>
					</tr>		
					<?php  if($employee_dependent_type['is_multiple']) { ?>	
						<tr>
							<td colspan="3" class="text-right">
							</td>
							<td class="text-right">
								<a class="btn btn-primary btn-sm">Add More</a>
							</td>
						</tr>
					<?php }  ?>	
				</table>
			</div>

		<?php
			}
		?>
	</form>
	<hr>
	<?php
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



</script>