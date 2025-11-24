<?php
$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/demo.css");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.easyui1.min.js");

include 'newfiles/common.php';
include 'newfiles/conn.php';

$user = JFactory::getUser();
$emp = mysqli_query($conn, "SELECT * FROM `kiusc_employees` WHERE `user_id` = '$user->id'");
$emp = mysqli_fetch_assoc($emp);	

if(isset($_POST['create']))
{
	$name = $_POST['name'];
	$fname = $_POST['fname'];
	$cnic = $_POST['cnic'];
	$permanent_address = $_POST['permanent_address'];
	$cur_address = $_POST['cur_address'];
	$cell_no1 = $_POST['cell_no1'];
	$cell_no2 = $_POST['cell_no2'];
	$email = $_POST['email'];
	
	mysqli_query($conn, "UPDATE `kiusc_employees` SET `name`='$name',`fname`='$fname',`cnic`='$cinc',`permanent_address`='$permanent_address',
	`cur_address`='$cur_address',`cell_no1`='$cell_no1',`cell_no2`='$cell_no2',`email`='$email' WHERE id = ". $emp['id']);
	
}



?>

<form action="" method="post" enctype="multipart/form-data">

<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:80%">
<tr>
	<td> Name : </td>
    <td> <input type="text" name="name" value="<?php echo $emp['name'] ?>" style="width:500px" required /> </td>
</tr>

<tr>
	<td> Father name : </td>
    <td> <input type="text" name="fname" value="<?php echo $emp['fname'] ?>" style="width:500px" /> </td>
</tr>

<tr>
	<td> Email : </td>
    <td> <input type="text" name="email" value="<?php echo $emp['email'] ?>" style="width:500px" /> </td>
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
    <td> <input type="date" value="<?php echo $emp['date_of_joining'] ?>" readonly style="width:500px" /> </td>
</tr>

<tr>
	<td> Employement Type : </td>
	<td> <input type="text"  value="<?php echo $emp['emp_type'] ?>" readonly style="width:500px" /> </td>
</tr>

<tr>
	<td> Scale Type : </td>
    <td> <input type="text"  value="<?php echo $emp['scale_type'] ?>" readonly style="width:500px" /> </td>
</tr>

<tr>
	<td> Pay Scale : </td>
    <td> <input type="text"  value="<?php echo $emp['pay_scale'] ?>" readonly style="width:500px" /> </td>
</tr>


</table>

<hr>

<table id="tbl" style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:80%">
<tr>
	<th> Designation </th>
    <th> Start Date </th>
    <th> End Date </th>
</tr>

<?php
$emp_designations = mysqli_query($conn, "SELECT ed.*, d.designation FROM `kiusc_emp_designation` ed 
	join kiusc_designations d on ed.designation_id = d.id WHERE `emp_id` = '".$emp['id']."'");
while($emp_desg = mysqli_fetch_assoc($emp_designations))
{
?>
<tr>

	<td> <input type="text" value="<?php echo $emp_desg['designation'] ?>" readonly /> </td>
	<td> <input type="date" value="<?php echo $emp_desg['start_date'] ?>" readonly /> </td>
	<td> <input type="date" value="<?php echo $emp_desg['end_date'] ?>" readonly /> </td>
</tr>
<?php
}
?>

</table>

	<input type="submit" name="create" value="Save" style="background-color: burlywood; border-radius: 17px; color: black;" />
</form>

