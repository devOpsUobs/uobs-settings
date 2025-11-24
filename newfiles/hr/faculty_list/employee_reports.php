<?php
include "newfiles/conn.php";
include 'newfiles/common.php';

// if (checkPermission(JFactory::getUser(), "HRM")==0)
// {
// 	echo"You dont have right to access this page!";
// 	return;
// }
$wherecomplete = "ed.is_current = 1 AND e.employment_nature !='Visiting' and e.completed=1 and e.verified=0";
$whereincomplete = "ed.is_current = 1  AND e.employment_nature !='Visiting' and e.completed=0 and e.verified=0";
$whereverified = "ed.is_current = 1  AND e.employment_nature !='Visiting' and e.verified=1";

$query = "SELECT e.*,b.bank_name, ed.pay_scale as payscales FROM `kiusc_employees` e JOIN kiusc_banks b ON b.id=e.bank_id JOIN kiusc_emp_designations ed ON e.id = ed.emp_id where ";

if(isset($_POST['emp_id']))
{
	$emp_id = $_POST['emp_id'];
	mysqli_query($conn, "UPDATE `kiusc_employees` SET `completed`='0' WHERE `id`='$emp_id'");
}
?>
<h3>Completed Profiles</h3>
<table class="table table-striped table-hover">
	<tr>
		<th>S. No.</th>
		<th>Name</th>
		<th>Father Name</th>
		<th>Account #</th>
		<th>Bank Name</th>
		<th>Employement Scale</th>
		<th>Pay Scale</th>
		<th>CNIC</th>
		<th>Employment Nature</th>
		<th>Employee Categories</th>
		<th>Profile Status</th>
		<th>Designation Status</th>
		<th>Education Status</th>
		<th>Action</th>
	</tr>
	<?php
	$i=0;
	$employees = mysqli_query($conn, $query.$wherecomplete);
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
				<td>'. $emp["account_no"] .'</td>
				<td>'. $emp["bank_name"] .'</td>
				<td>'. $emp["employment_scale"] .'</td>
				<td>'. $emp["payscales"] .'</td>
				<td>'. $emp["cnic"] .'</td>
				<td>'. $emp["employment_nature"] .'</td>
				<td>'. $emp["employee_categories"] .'</td>';
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
				echo '
				<td>
				<form action="" method="POST">
					<input type="hidden" name="emp_id" value="'.$emp_id.'">
					<input type="submit" value="Uncomplete">
				</form>
				</td>
			</tr>';

	}
	?>
</table>

<h3>In-completed Profiles</h3>
<table class="table table-striped table-hover">
	<tr>
		<th>S. No. </th>
		<th>Name</th>
		<th>Father Name</th>
		<th>Account #</th>
		<th>Bank Name</th>
		<th>Employement Scale</th>
		<th>Pay Scale</th>
		<th>CNIC</th>
		<th>Employment Nature</th>
		<th>Employee Categories</th>
		<th>Profile Status</th>
		<th>Designation Status</th>
		<th>Education Status</th>
		<th>Action</th>
	</tr>
	<?php
	$i=0;
	$employees = mysqli_query($conn, $query.$whereincomplete);
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
				<td>'. $emp["account_no"] .'</td>
				<td>'. $emp["bank_name"] .'</td>
				<td>'. $emp["employment_scale"] .'</td>
				<td>'. $emp["payscales"] .'</td>
				<td>'. $emp["cnic"] .'</td>
				<td>'. $emp["employment_nature"] .'</td>
				<td>'. $emp["employee_categories"] .'</td>';
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
				echo '
			</tr>';

	}
	?>
</table>
<h3>Verified Profiles</h3>
<table class="table table-striped table-hover">
	<tr>
		<th>S. No. </th>
		<th>Name</th>
		<th>Father Name</th>
		<th>Account #</th>
		<th>Bank Name</th>
		<th>Employement Scale</th>
		<th>Pay Scale</th>
		<th>CNIC</th>
		<th>Employment Nature</th>
		<th>Employee Categories</th>
		<th>Profile Status</th>
		<th>Designation Status</th>
		<th>Education Status</th>
		<th>Action</th>
	</tr>
	<?php
	$i=0;
	$employees = mysqli_query($conn, $query.$whereverified);
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
				<td>'. $emp["account_no"] .'</td>
				<td>'. $emp["bank_name"] .'</td>
				<td>'. $emp["employment_scale"] .'</td>
				<td>'. $emp["payscales"] .'</td>
				<td>'. $emp["cnic"] .'</td>
				<td>'. $emp["employment_nature"] .'</td>
				<td>'. $emp["employee_categories"] .'</td>';
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
				echo '
			</tr>';

	}
	?>
</table>
<a href="newfiles/hr/faculty_list/employee_reports/phpExcelReport.php"><img src="newfiles/icons/download.png" width="150px" alt="Download"></a>
