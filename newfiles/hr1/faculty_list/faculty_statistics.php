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

if (checkPermission(JFactory::getUser(), "HRM")==0)
{
	echo"You dont have right to access this page!";
	return;
}	

$type = "";
$chk_emp_type="";
if(isset($_POST['chk_emp_type']))
{
	$chk_emp_type="Checked";
	$type = $_POST['type_id'];
}
$acc_department_id = 0;
$adm_department_id = 0;
$chk_dep = "";
$chk_dep_adm="";
if(isset($_POST['chk_dep']))
{
	if($_POST['chk_dep'] == 'teaching')
	{
		$acc_department_id = $_POST['acc_department_id'];
		$chk_dep="Checked";
	}
	else
	{
		$chk_dep_adm="Checked";
		$adm_department_id = $_POST['adm_department_id'];
	}
}
$desg_id =array(-1);
$chk_desg="";
if(isset($_POST['chk_desg']))
{
	$chk_desg="Checked";
	$desg_id = $_POST['desg_id'];
}
$employment_nature = 'All';
$chk_employment_nature="";
if(isset($_POST['chk_employment_nature']))
{
	$chk_employment_nature="Checked";
	$employment_nature = $_POST['employment_nature'];
}
$mode_of_employment = 'All';
$chk_mode_of_employment="";
if(isset($_POST['chk_mode_of_employment']))
{
	$chk_mode_of_employment="Checked";
	$mode_of_employment = $_POST['mode_of_employment'];
}
$chk_employment_scale="";
$employment_scale = 'All';
if(isset($_POST['chk_employment_scale']))
{
	$chk_employment_scale="Checked";
	$employment_scale = $_POST['employment_scale'];
}
$show=0;
if(isset($_POST['submit']))
	$show=1;
?>
<script>
	$(document).ready(function () {
        $('#type_id').change(function () {
            if ($('#type_id').val() == 'Faculty') {
                $('#acc_department_id').show();
				$('#chk_dep').show();
            }
            else {
                $('#acc_department_id').hide();
				$('#chk_dep').hide();
            }
			if ($('#type_id').val() == 'Admin') {
                $('#adm_department_id').show();
				$('#chk_dep_adm').show();
            }
            else {
                $('#adm_department_id').hide();
				$('#chk_dep_adm').hide();
            }
        });
    });
</script>



<table>
<form action="" method="POST">
	<tr>
		<td>Employee Type:</td>
		<td>
			<?php
		$type_array = array('Select Type', 'Faculty', 'Admin');
		?>
			<select id="type_id" name="type_id" style="width:500px" onChange="getState(this.value)">
		<?php		foreach($type_array as $tval) 
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
			<td><input type="checkbox" name="chk_emp_type" style="margin-left: 30px;" <?php echo $chk_emp_type ?>></td>
	</tr>
	<tr>
	<td>Accademic Department :</td>
	<td><select id="acc_department_id" name="acc_department_id" style="width:500px" style="visibility:hidden;">
		<?php
		echo '<option value="0"> All </option>';
		$acc_departments = mysqli_query($conn, "SELECT * FROM `kiusc_departments`");
		while($acc_dep = mysqli_fetch_assoc($acc_departments))
		{
			$s="";
			if ($acc_department_id==$acc_dep['id']) 
			{
				$s=" selected ";
			}
			
		echo '<option '.$s.' value="' . $acc_dep['id'] . '">' . $acc_dep['name'] . '</option>';
		}?>
 	</select></td>
	 <td><input type="radio" name="chk_dep" id="chk_dep" value='teaching' style="margin-left: 30px;" <?php echo $chk_dep ?>></td>
	</tr>
	<tr>
	<td>Non Teaching Department :</td>
	<td><select id="adm_department_id" name="adm_department_id" style="width:500px">
		<?php
		echo '<option value="0"> All </option>';
		$admin_departments = mysqli_query($conn, "SELECT * FROM `kiusc_admin_departments`");		
		while($admi_dep = mysqli_fetch_assoc($admin_departments))
		{
			$s="";
			if ($adm_department_id==$admi_dep['id']) 
			{
				$s=" selected ";
			}
			
		echo '<option '.$s.' value="' . $admi_dep['id'] . '">' . $admi_dep['name'] . '</option>';
		}?>
 	</select>
	</td>
	<td><input type="radio" name="chk_dep" id="chk_dep_adm" value='non_teaching' style="margin-left: 30px;"<?php echo $chk_dep_adm ?>></td>
	</tr>

	
	<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script>
      $(document).ready(function(){
        $("#type_id").change(function(){
          var type_id=$(this).val();
          $.ajax({
            url:'../../../newfiles/jobs/faculty_list/ajax_check_designation_type.php',
            type:'post',
            data:{type_id:type_id},
            success:function(res){
              $("#desg_id").html(res);
            }
          });
        });
      });
    </script>
	<tr>
		<td>Designation</td>
		<td>
		
		<select  id="desg_id" multiple name="desg_id[]" style="width:500px">
        <option value=''>Select Product</option>
      </select>
            
		</td>
		<td><input type="checkbox" name="chk_desg" style="margin-left: 30px;" <?php echo $chk_desg ?>></td>
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
	<td><input type="checkbox" name="chk_employment_nature" style="margin-left: 30px;" <?php echo $chk_employment_nature ?>></td>
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
	<td><input type="checkbox" name="chk_mode_of_employment" style="margin-left: 30px;" <?php echo $chk_mode_of_employment ?>></td>
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
	<td><input type="checkbox" name="chk_employment_scale" style="margin-left: 30px;" <?php echo $chk_employment_scale ?>></td>
	</tr>
	<tr>
	<td><input type="submit" name="submit" value="Search"></td>
	</tr>
</form>
</table>
<?php
		

	$where_type = " ";
	if($type != 'All' && $type != NULL)
	{
			$where_type = " and type = '$type'";
	}
	$where_adm_dep = " ";
	if($adm_department_id != 0 && $adm_department_id != NULL)
	{
		$where_adm_dep = " and id = '$adm_department_id'";
	}
	$where_acc_dep = " ";
	if($acc_department_id != 0 && $acc_department_id != NULL)
	{
		$where_acc_dep = " and id = '$acc_department_id'";
	}
	$where_desgn = " ";
	if($desg_id[0] != 0 && $desg_id != NULL)
	{
		$desg_id_str = implode(",", $desg_id);
		$where_desgn = " and id in($desg_id_str)";
	}
	$where_employment_nature = " ";
	if($employment_nature != 'All' && $employment_nature != NULL)
	{
		$where_employment_nature = " and e.employment_nature = '$employment_nature'";
	}
	$where_mode_of_employment = " ";
	if($mode_of_employment != 'All' && $mode_of_employment != NULL)
	{
		$where_mode_of_employment = " and e.mode_of_employment = '$mode_of_employment'";
	}
	$where_employment_scale = " ";
	if($employment_scale != 'All' && $employment_scale != NULL)
	{
		$where_employment_scale = " and e.employment_scale = '$employment_scale'";
	}

if($show==1)
{
?>

<body>
	<table border='solid' width="100%">
		<thead>
			<tr>
				<th rowspan='2'>Departments</th>
				<?php
				$counter=0;
				$designations = mysqli_query($conn,"SELECT * FROM `kiusc_designations` where 1 $where_type $where_desgn");
				while($des = mysqli_fetch_assoc($designations))
				{
					echo '<th colspan="4">'.$des['designation'].'</th>';
					$counter++;
				}	
				?>
				<th>Total</th>
			</tr>
			<tr>
			<?php
			for($i=1;$i<=$counter;$i++)
			{
				echo '<th>Male</th>';
				echo '<th>Female</th>';
				echo '<th>Others</th>';
				echo '<th>Total</th>';
			}

			echo '</tr>';
			$adm = '';
			$acc = '';
			if($type == 'Admin')
			{
				$departments = mysqli_query($conn,"SELECT * FROM `kiusc_admin_departments` where 1 $where_adm_dep");
				$adm='ed.adm_department_id=';
			}
			else
			{
				$departments = mysqli_query($conn,"SELECT * FROM `kiusc_departments` where 1 $where_acc_dep");
				$acc='ed.acc_department_id=';
			}
			
			while($dep = mysqli_fetch_assoc($departments))
			{
				$grand_total=0;
				echo '<tr>';
				echo '<th>'.$dep['name'].'</th>';
				$designations = mysqli_query($conn,"SELECT * FROM `kiusc_designations` where 1 $where_type $where_desgn");
				while($des = mysqli_fetch_assoc($designations))
				{
					$employees = mysqli_query($conn,"select u.username, e.*, d.designation,ed.designation_id from s04cf_users u 
					join kiusc_employees e on u.id = e.user_id 
					join kiusc_emp_designations ed on e.id = ed.emp_id 
					join kiusc_designations d on ed.designation_id = d.id 
					WHERE $adm  $acc '".$dep['id']."' and ed.designation_id='".$des['id']."' $where_employment_nature $where_mode_of_employment $where_employment_scale");
					$male=0;
					$female=0;
					$others = 0;
					while($mf = mysqli_fetch_assoc($employees))
					{
						if($mf['gender'] == 'Male')
						{
							$male++;
						}
						elseif($mf['gender'] == 'Female')
						{
							$female++;
						}
						else
						{
							$others++;
						}
					}
					$emp_count=mysqli_num_rows($employees);
					echo '<td>'.$male.'</td>';
					echo '<td>'.$female.'</td>';
					echo '<td>'.$others.'</td>';
					echo '<td>'.$emp_count.'</td>';
					$grand_total = $grand_total + $emp_count;
				}
				echo '<td>'.$grand_total.'</td>';
				echo '</tr>';
			}
			?>
		</thead>
	</table>
<?php
}
?>
	