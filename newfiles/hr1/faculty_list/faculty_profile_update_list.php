<?php
include "newfiles/conn.php";
include 'newfiles/common.php';

if (checkPermission(JFactory::getUser(), "HRM")==0)
{
	echo"You dont have right to access this page!";
	return;
}
?>
<table border="1px solid">
	<tr>
		<th>S. No. </th>
		<th>Name</th>
		<th>Father Name</th>
		<th>cnic</th>
		<th>Profile Status</th>
		<th>Designation Status</th>
		<th>Education Status</th>
	</tr>
	<?php
	$i=0;
	$employees = mysqli_query($conn, "SELECT * FROM `kiusc_employees` where employment_nature !='Visiting'");
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
				echo '
			</tr>';

	}
	?>
</table>