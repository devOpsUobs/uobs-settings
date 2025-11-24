<?php
include "myfiles/common.php";
include 'myfiles/dbclass.php';
include 'myfiles/sms/sms_common.php';

if (checkPermission(JFactory::getUser(), "SMS")==0)
{
	echo"You dont have right to access this page!";
	return;
}

 
if(isset($_POST['send']))
{	
	$recipients = $_POST['recipient'];
	$message = $_POST['message'];
	$message = $message. "\n" .'PSCS';
	//$to = '03469555371,03315564124';
	//$message = 'Test Message';
	$unicode = $_POST['unicode'];
	$response = send($recipients, $message, $unicode);
	
	echo $response;
	
	$no_of_sms = calculateSMS($response);
	if($no_of_sms > 0)
	{
		ins_upd_del("INSERT INTO `schl_sms_log`(`date`, `no_of_sms`) VALUES ('".date("Y-m-d")."','$no_of_sms')");
	}
}
?>
<meta charset="UTF-8">
<form action="" method="POST">
<table>

<tr>
	<td> English : <input type="radio" name="unicode" value='0' checked></td>
	<td>Urdu : <input type="radio" name="unicode" value='1'> </td>
</tr>
<tr>
	<td> Recipients : </td>
	<td><input type="text" name="recipient" style="width:500px" placeholder="e.g 03xxxxxxxxx,03xxxxxxxxx" required> </td>
</tr>
<tr>
	<td> Message : </td>
	<td><textarea name="message" style="width:500px; height:200px"> </textarea></td>
</tr>
<tr>
	<td></td>
	<td> <input type="submit" name="send" value="Send"> </td>
</tr>
</table>
</form>
