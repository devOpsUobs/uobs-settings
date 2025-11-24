<?php
$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/demo.css");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.easyui1.min.js");

include 'newfiles/common.php';
include 'newfiles/conn.php';
include 'newfiles/conn_std.php';
include 'newfiles/sms/sms_common.php';
//include 'newfiles/my_ldap.php';

if (checkPermission(JFactory::getUser(), "ldap_create_account")==0)
{
	echo"You dont have right to access this page!";
	return;
}	

if (isset($_POST['sel_dep_id']))
	$department=$_POST['sel_dep_id'];
else
	$department=-1;

if (isset($_POST['sel_prog_id']))
	$program=$_POST['sel_prog_id'];
else
	$program=-1;

if (isset($_POST['sel_student_id']))
	$studentID=$_POST['sel_student_id'];
else
	$studentID=-1;


if(isset($_POST['create']))
{
	$password = '2512345';
	$sno = 0;
	$students = mysqli_query($conn, "SELECT * FROM `kiusc_students` WHERE `prog_id` = '$program'");
	while($std = mysqli_fetch_assoc($students))
	{
			//password start
			 //$std_reg_exp = (explode("-",$std['reg_no']));
			 //$std_reg =  $std_reg_exp['2'];
			 //$std_reg = $std['reg_no'];
			 // joomla password
			jimport('joomla.user.helper');
			$salt = JUserHelper::genRandomPassword(32);
			$crypted = JUserHelper::getCryptedPassword($password, $salt);
			$pass = $crypted.':'.$salt;	
			//password end
		
		
		$ex = mysqli_query($conn_std, "SELECT * FROM `s04cf_users` WHERE `username` = '".$std['reg_no']."'");
		$count_ex = mysqli_num_rows($ex);
		if($count_ex > 0)
		{
			print "<font color='red'> ". $std['name'] . " (" .  $std['reg_no'] ." already exist </font> <br>";
			continue;
		}
		
		mysqli_query($conn_std, "INSERT INTO `s04cf_users`(`name`, `username`, `email`, `password`, `block`) 
		VALUES ('".$std['name']."', '".$std['reg_no']."', '', '$pass', '0')");  ///password without hash 
		
		$user_id = mysqli_insert_id($conn_std);
		
		mysqli_query($conn_std,"INSERT INTO `s04cf_user_usergroup_map`(`user_id`, `group_id`) VALUES ('$user_id', '2')");
		
		
		//createUser($std['name'], $std['reg_no'], "#*12#*ab#*", "StudentGroup","Students");
		$sno++;
	}
	
	echo "<font color='green'> No. of Accounts Created = ". $sno ." </font>";
}

if(isset($_POST['delete_acct']))
{
	$sno = 0;
	$students = mysqli_query($conn, "SELECT * FROM `kiusc_students` WHERE `prog_id` = '$program'");
	while($std = mysqli_fetch_assoc($students))
	{
		$ex = mysqli_query($conn_std, "SELECT * FROM `s04cf_users` WHERE `username` = '".$std['reg_no']."'");
		$count_ex = mysqli_num_rows($ex);
		if($count_ex == 0)
			continue;
		
		$ex = mysqli_fetch_assoc($ex);
		
		mysqli_query($conn_std, "DELETE FROM `s04cf_users` WHERE `id` = " . $ex['id']);  
		
		mysqli_query($conn_std,"DELETE FROM `s04cf_user_usergroup_map` WHERE `user_id` = " . $ex['id']);
		
		//myldap_delete($ex['username'], "students");
		$sno++;
	}
	
	echo "<font color='green'> No. of Accounts Deleted = ". $sno ." </font>";
}

if(isset($_POST['change_email']))
{
	$email = $_POST['email'];
	$reg_no = $_POST['reg_no'];
	
	mysqli_query($conn_std, "UPDATE `s04cf_users` SET `email`= '$email' WHERE `username` = '$reg_no'");
	
	mysqli_query($conn, "UPDATE `kiusc_students` SET `email`= '$email' WHERE id = '$studentID'");
}

echo '<table>';
echo'<tr>
		<td>Select Department</td>
		<td>';$department=showDepartmentSel($department);echo'</td>
</tr>

<tr>
		<td>Select Program</td>
		<td>'; $arr=showProramSelID($department, $program);

$program=$arr['id'];
$prog_name=$arr['name'];

 echo'</td>
</tr>
</table>';

echo"	<h3> Create Account of student group </h3>	";

echo '
	<form action="" method="post">
		<input type="hidden" name="sel_dep_id" value="'. $department .'">
		<input type="hidden" name="sel_prog_id" value="'. $program .'">
		<input type="submit" name="create" value="Create Accounts">
<hr>';

if (checkPermission(JFactory::getUser(), "ldap_delete_account")==1)
{

	echo '
		<h3> Delete Student group </h3>

		<input type="submit" name="delete_acct" value="Delete Accounts" onclick="return confirm(\' Are you sure?\')">';

}
echo'	</form>';
	
echo '<hr>
<h3> List of Student Accounts </h3>';

echo '
<table style="width:50%" border="1px">
<tr>
	<th> SNo. </th>
	<th> Reg # </th>
	<th> Name </th>
</tr>
';	
$students = mysqli_query($conn, "SELECT * FROM `kiusc_students` WHERE `prog_id` = '$program'");
$sno = 0;
while($std = mysqli_fetch_assoc($students))
{

	$std_pan = mysqli_query($conn_std, "SELECT * FROM `s04cf_users` WHERE `username` = '".$std['reg_no']."'");
	$count_ex = mysqli_num_rows($std_pan);
	if($count_ex == 0)
		continue;
$sno++;	
echo '<tr>
	<td> '. $sno .' </td>
	<td> ' . $std['reg_no'] . ' </td>
	<td> ' . $std['name'] . ' </td>
</tr>';
}

echo '</table>';


echo"	
<hr>

<h3> Change Student Email </h3>	";

$fldArr=array('sel_dep_id'=>$department, 'sel_prog_id'=>$program, 'sel_sem_id'=> '0', 'sel_student_id'=>$studentID);
echo '<table>';
echo'<tr>
		<td>Select Student</td>
		<td>';$studentID=showStudentSel($fldArr); echo'</td>';
		

$stdd = mysqli_query($conn, "SELECT * FROM `kiusc_students` WHERE id = '$studentID'");
$stdd = mysqli_fetch_assoc($stdd);

echo '
<form action="" method="post">
		<input type="hidden" name="sel_dep_id" value="'. $department .'">
		<input type="hidden" name="sel_prog_id" value="'. $program .'">
		<input type="hidden" name="sel_student_id" value="'. $studentID .'">
		<input type="hidden" name="reg_no" value="'. $stdd['reg_no'] .'">
		
<tr>
	<td> Email </td>
	<td> <input type="text" name="email" value="' . $stdd['email'] . '"> </td>
</tr>

<tr>
	<td>  </td>
	<td> <input type="submit" name="change_email" value="Change Email"> </td>
</tr>

</form>

</table>';

?>