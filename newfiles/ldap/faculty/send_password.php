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

if(isset($_POST['send']))
{
	$uname = $_POST['uname'];
	$email = $_POST['email'];
	
	
	$fac = mysqli_query($conn, "SELECT * FROM `s04cf_users` WHERE `username` = '$uname'");
	$fac = mysqli_fetch_assoc($fac);
	if(!$fac)
	{
		echo "<font color='red'> Account doestn't exist please contact system administrator. </font>";
		return;
	}
	
	$password = randPassword(5, false, 'lud');
	
	if($fac['email'] == '')
	{
		$ex = mysqli_query($conn, "SELECT * FROM `s04cf_users` WHERE `email` = '$email'");
		$ex = mysqli_fetch_assoc($ex);
		if($ex)
		{
			echo "<font color='red'> Email address already in use by another user. </font>";
			return;
		}
		//// ldap active directory password change ////
		changePassword($uname, $password, 'StaffFaculty');
			
		////// Joomla Password Change 
		jimport('joomla.user.helper');
		$salt = JUserHelper::genRandomPassword(32);
		$crypted = JUserHelper::getCryptedPassword($password, $salt);
		$pass = $crypted.':'.$salt;	
	 
		mysqli_query($conn, "UPDATE `s04cf_users` SET `email`='$email',`password`='$pass' WHERE `username` = '$uname'");  
		mysqli_query($conn, "UPDATE `kiusc_employees` SET `email` = '$email' WHERE user_id = '".$fac['id']."'"); 
		
		//// send password ///
		$recipient = array($email);
		$subject = "Forgot Password";
		$body = "The below is your username and new password. <br><br>
				 Username : " . $uname . "<br>
				 Password : " . $password . "<br><br>
				 This is system generated passowrd you are requested to change your password on first login. 
				 To change your password goto 'User' menu and click on 'Reset Password' <br> 
				 You are also advised to keep update your personal data. To update your personal data goto 'User' menu and click on 'Update Profile'
				 <br> <br> <br>
				<font color='red'> <b> Note: </b> This is system generated email from KIU Skardu Campus. 
				Please don't reply to this email. If you have any queries contact the relevant authorities. </font> ";
				 
		sendMail($recipient, $subject, $body);
		
		echo "<font color='green'> Username and passowrd has been sent to your email address. </font>";
		
	}
	else
	{
		if($fac['email'] == $email)
		{
			//// ldap active directory password change ////
			changePassword($uname, $password, 'StaffFaculty');
				
			////// Joomla Password Change 
			jimport('joomla.user.helper');
			$salt = JUserHelper::genRandomPassword(32);
			$crypted = JUserHelper::getCryptedPassword($password, $salt);
			$pass = $crypted.':'.$salt;	
		 
			mysqli_query($conn, "UPDATE `s04cf_users` SET `password`='$pass' WHERE `username` = '$uname'");  				
				
			/// send password ////
			$recipient = array($email);
			$subject = "Forgot Password";
			$body = "The below is your username and new password. <br><br>
				 Username : " . $uname . "<br>
				 Password : " . $password . "<br><br>
				 This is system generated passowrd you are requested to change your password on first login. 
				 To change your password goto 'User' menu and click on 'Reset Password' <br><br>
				 You are also advised to keep update your personal data. To update your personal data goto 'User' menu and click on 'Update Profile' 
				 <br> <br> <br>
				<font color='red'> <b> Note: </b> This is system generated email from KIU Skardu Campus. 
				Please don't reply to this email. If you have any queries contact the relevant authorities. </font> ";
				 
			sendMail($recipient, $subject, $body);
			echo "<font color='green'> Username and passowrd has been sent to your email address. </font>";
		}
		else
		{
			echo "<font color='red'> Username and Email not match. </font>";
		}
	}
}
?>
<table>

<form action="" method="post">
<tr>
	<th> Username : </th>
	<td> <input type="text" name="uname" required> </td>
</tr>

<tr>
	<th> Email : </th>
	<td> <input type="email" name="email" required> </td>
</tr>

<tr>
	<th>  </th>
	<td> <input type="submit" name="send"> </td>
</tr>

</form>

</table>