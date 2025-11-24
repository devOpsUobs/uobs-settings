<?php
include "newfiles/conn.php";
include 'newfiles/common.php';

if (checkPermission(JFactory::getUser(), "HRM")==0)
{
	echo"You dont have right to access this page!";
	return;
}
if(isset($_POST['save']))
{
	$emp_id = $_POST['emp_id'];
	$employee_categories = $_POST['employee_categories'];
	mysqli_query($conn, "UPDATE `kiusc_employees` SET `employee_categories` = '$employee_categories' WHERE id='$emp_id'");
	echo "Updated Employee Category";
}
?>
<table class="table table-striped table-hover">
	<tr>
		<th>S. No. </th>
		<th>Name</th>
		<th>Father Name</th>
		<th>cnic</th>
		<th>Profile Status</th>
		<th>Designation Status</th>
		<th>Education Status</th>
		<th>Employe Category</th>
		<th>Action</th>
	</tr>
	<?php
	$i=0;
	$employees = mysqli_query($conn, "SELECT * FROM `kiusc_employees` where employment_nature !='Visiting' and is_active=1 and is_payroll=1 ORDER BY adm_department_id ASC");
	while($emp = mysqli_fetch_assoc($employees))
	{
		$i++;
		$emp_id = $emp['id'];
		$pic_status = $emp['picture'];
		echo '
			<tr>';
				echo '<td>'.$i.'</td>';
				echo'
				<td>'. $emp["first_name"] .' '. $emp["last_name"] .'</td>
				<td>'. $emp["fname"] .'</td>
				<td>'. $emp["cnic"] .'</td>';
				if($pic_status == "")
				{
					echo '<td style="background-color:#b40c0c;color:white"> Profile Does Not Updated</td>';
				}
				else
				{
					echo '<td> Profile Updated</td>';
				}
				$designations = mysqli_query($conn,"SELECT * FROM `kiusc_emp_designations` where emp_id='$emp_id'");
				$desg = mysqli_num_rows($designations);
				if($desg > 0)
				{
					echo '<td> Designation Updated</td>';
				}
				else
				{
					echo '<td style="background-color:#c42c2c;color:white"> Designation Doest Not Updated</td>';
				}
				$educations = mysqli_query($conn,"SELECT * FROM `kiusc_emp_educations` where emp_id='$emp_id'");
				$edu = mysqli_num_rows($educations);
				if($edu > 0)
				{
					echo '<td> Education Updated</td>';
				}
				else
				{
					echo '<td style="background-color:#860a63;color:white"> Education Doest Not Updated</td>';
				}
				?>
				<form action="" method="POST">
					<input type="hidden" name="emp_id" value="<?php echo isset($emp_id) ? $emp_id : ""?>">
					<td>
						<select name="employee_categories" >
							<?php
							$employee_categories = mysqli_query($conn, "SHOW COLUMNS FROM kiusc_employees WHERE Field = 'employee_categories'");
							$employee_categories = mysqli_fetch_assoc($employee_categories);
							$employee_categories = explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2", $employee_categories['Type']));
							foreach($employee_categories as $type)
							{
								$sel = "";
								if(isset($emp['employee_categories']))
								{
									if($emp['employee_categories'] == $type)
										$sel = " selected ";
								}
								
								echo "<option value='$type' $sel>$type</option>";
							}
							?>
						</select>
					</td>
					<td>
						<input type="submit" value="Save" name="save" class="btn success">
					</td>
				</form>
				<?php
				echo '
			</tr>';

	}
	?>
</table>
