<?php
include "newfiles/conn.php";
include 'newfiles/common.php';

if (checkPermission(JFactory::getUser(), "HRM")==0)
{
	echo"You dont have right to access this page!";
	return;
}

?>
<h3>User Profiles</h3>
<table class="table table-striped table-hover">
	<tr>
		<th>S. No. </th>
		<th>Name</th>
		<th>Email</th>
	</tr>
	<?php
	$i=0;
	$employees = mysqli_query($conn, "SELECT distinct(u.name) as uname,u.email FROM `s04cf_users` u 
									join kiusc_course_offered c on c.fac_id=u.id 
									join kiusc_programs p on p.id=c.prog_id 
									WHERE u.block=0 ORDER BY p.id asc");
	while($emp = mysqli_fetch_assoc($employees))
	{
		$i++;
	?>
			<tr>
				<td><?php echo $i ?></td>
				<td><?php echo $emp['uname'] ?></td>
				<td><?php echo $emp['email'] ?></td>
			</tr>
	<?php

	}
	?>
</table>

