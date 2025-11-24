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

$user = JFactory::getUser();
$emp = mysqli_query($conn, "SELECT * FROM `kiusc_employees` WHERE `user_id` = '$user->id'");
$emp = mysqli_fetch_assoc($emp);

if(isset($_POST['change']))
{
	$uname = $_POST['uname'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	
	//// ldap active directory password change ////
	changePassword($uname, $password, 'StaffFaculty');
			
	////// Joomla Password Change 
	jimport('joomla.user.helper');
	$salt = JUserHelper::genRandomPassword(32);
	$crypted = JUserHelper::getCryptedPassword($password, $salt);
	$pass = $crypted.':'.$salt;	
	 
	mysqli_query($conn, "UPDATE `s04cf_users` SET `password`='$pass' WHERE `username` = '$uname'");   
		
	//// send password ///
	$recipient = array($email);
	$subject = "Change Password";
	$body = "You recently changed your password. As a security precaution, this notification has been sent to the 
			email address associated with your account. <br> <br>
			If you did not change your password, your account may have been misused by an unauthorised person. 
			Please contact relevant authorities for further guidance. <br> <br>
				
				 <br> <br> <br>
				<font color='red'> <b> Note: </b> This is system generated email from KIU Skardu Campus. 
				Please don't reply to this email. If you have any queries contact the relevant authorities. </font> ";
				 
	sendMail($recipient, $subject, $body);
		
	echo "<font color='green'> Password Changed Successfully </font>";	
}
			
?>
<table>

<form action="" method="post">
<tr>
	<td> Name : </td>
    <td> <input type="text" value="<?php echo $emp['name'] ?>" style="width:500px" readonly /> </td>
</tr>

<tr>
	<td> Username : </td>
    <td> <input type="text" name="uname" value="<?php echo $user->username ?>" style="width:500px" readonly /> </td>
</tr>

<tr>
	<td> Email : </td>
    <td> <input type="text" name="email" value="<?php echo $emp['email'] ?>" style="width:500px" readonly /> </td>
</tr>

<tr>
	<td> Password : </td>
    <td> <input type="password" name="password" style="width:500px" required pattern=".{4,}" title="4 characters minimum"/> </td>
</tr>

<tr>
	<th>  </th>
	<td> <input type="submit" value="Change" name="change"> </td>
</tr>

</form>

</table>