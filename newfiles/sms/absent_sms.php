<?php 
include 'myfiles/common.php';
include 'myfiles/dbclass.php';
include 'myfiles/sms/sms_common.php';
	
$doc = JFactory::getDocument();
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui-new/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui-new/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui-new/demo/demo.css");

$doc->addScript(JURI::root( true )."/jquery-easyui-new/jquery-1.6.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui-new/jquery.easyui.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui-new/datagrid-detailview.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/datagrid-filter.js");


if (checkPermission(JFactory::getUser(), "SMS")==0)
{
	echo"You dont have right to access this page!";
	return;
}

if(isset($_REQUEST['session_id']))
	$session_id = $_REQUEST['session_id'];
else
	$session_id = -1;
	
if(isset($_REQUEST['ses_class_id']))
	$ses_class_id = $_REQUEST['ses_class_id'];
else
	$ses_class_id = -1;
	
if(isset($_REQUEST['date']))
	$date = $_REQUEST['date'];
else
	$date = date('Y-m-d');

$campus_id = -1;
if(isset($_REQUEST['campus_id']))
	$campus_id = $_REQUEST['campus_id'];
	
/*if(isset($_POST['send']))
{	
	$cell_nos = $_POST['cell_no'];
	$recipients = implode(",",array_filter($cell_nos));
	$message = $_POST['message'];
	$unicode = $_POST['unicode'];
	
	$response = send($recipients, $message, $unicode);

	echo $response ;
	
	$no_of_sms = calculateSMS($response);
	if($no_of_sms > 0)
	{
		ins_upd_del("INSERT INTO `schl_sms_log`(`date`, `no_of_sms`) VALUES ('".date("Y-m-d")."','$no_of_sms')");
	}
}*/
if(isset($_POST['send']))
{
	$cell_nos = $_POST['cell_no'];
	//$recipients = implode(",",array_filter($cell_nos));
	
	$std_ids = $_POST['std_id'];
	$messages = $_POST['message'];
	$message = $message. "\n" .'PSCS';
	$unicode = $_POST['unicode'];
	
	$i = 0;
	foreach($std_ids as $sid)
	{
	
		$std = getSingleRow("SELECT cls.name as cname,std.* FROM `schl_students` std
							join schl_student_class std_cls ON std_cls.student_id=std.id
							join schl_session_class ses_cls ON ses_cls.id=std_cls.session_class_id
							join schl_classes cls ON cls.id=ses_cls.class_id WHERE std.id = '$sid'");
		//$std = getSingleRow("SELECT * FROM `schl_students` WHERE id = '$sid'");
		if(in_array($std['cell_no'], $cell_nos))
		{
			$msg = 'Reg# '.$std['reg_no']."\n".'Name '.$std['name'] ."\n".'Class '.$std['cname'] . "\n" .  $messages;
			
			$response = send($std['cell_no'], $msg, $unicode);
			echo $response ;
			
			$no_of_sms = calculateSMS($response);
			if($no_of_sms > 0)
			{
				ins_upd_del("INSERT INTO `schl_sms_log`(`date`, `no_of_sms`) VALUES ('".date("Y-m-d")."','$no_of_sms')");
			}
		}
		
		$i++;
	}
}
 
?>


<table style='border:1px solid'>
<tr>
	<td>Select Campus</td>
	<td><?php $campus_id = campusDropDown($campus_id); ?></td>
</tr>
<tr>
	<td>Select Session</td>
	<td><?php $session_id = sessionDropDown($session_id, $campus_id); ?></td>
</tr>
<tr>
	<td>Select Class </td>
	<td><?php $ses_class_id = sessionclassDropDown($ses_class_id,$session_id, $campus_id, 1);
	?></td>
</tr>
<tr>
	<td>Select Date </td>
	<td><?php $date = dateDropDown($date, $ses_class_id,$session_id,0,$campus_id); ?></td>
</tr>
</table>

<hr>

<style>
#highlight:hover{
background-color:burlywood;
}
</style>

<table border='1px'>
<tr>
	<th> </th>
	<th>SNo.</th>
	<th>Reg No.</th>
	<th>Name</th>
	<th>Cell No.</th>
	<th>Status</th>
</tr>

<form action="" method="POST">
<input type="hidden" name="campus_id" value="<?php echo $campus_id ?>"/>
<input type="hidden" name="session_id" value="<?php echo $session_id ?>"/>
<input type="hidden" name="ses_class_id" value="<?php echo  $ses_class_id ?>"/>
<?php
if($ses_class_id == 0)
{
	$students = getMultipleRows("SELECT s.*, a.status FROM `schl_students` s 
								join schl_student_class sc on s.id = sc.student_id 
								join schl_session_class sescl on sc.session_class_id = sescl.id 
								left join schl_attendance a on s.id = a.std_id and a.session_class_id = sescl.id and a.date = '$date' 
								WHERE sescl.session_id = '$session_id' and s.has_left_school = 0");
}
else
{
		$students = getMultipleRows("SELECT s.*, a.status FROM `schl_students` s 
								join schl_student_class sc on s.id = sc.student_id  
								left join schl_attendance a on s.id = a.std_id and a.session_class_id = sc.session_class_id and a.date = '$date' 
								WHERE sc.session_class_id = '$ses_class_id' and s.has_left_school = 0");
		
}
$sno=0;
foreach($students as $std)
{
	if($std['status'] == 'P' || $std['status'] == 'L')
		continue;
	
	$cell_no = $std['cell_no'];
	if(strlen($std['cell_no']) != 11)
	{
		$cell_no = '';
	}
	
$sno++;

?>
<tr id="highlight">
	<input type="hidden" name="std_id[]" value="<?php echo $std['id'] ?>">
	<td> <input type="checkbox" name="cell_no[]"  value="<?php echo $cell_no ?>" <?php echo ($cell_no != "") ? "checked" : "" ?> > </td>
	<td><?php echo $sno ?></td>
	<td><?php echo $std['reg_no'] ?> </td>
	<td><?php echo $std['name'] ?></td>
	<?php
	if(strlen($std['cell_no']) != 11)
	{
		echo "<td style='color:red'>". $std['cell_no'] . "</td>";
	}
	else
		echo "<td>". $std['cell_no'] . "</td>";
	?>
	<td><?php 
	if($std['status'] == '')
		echo "-";
	else
		echo $std['status'] ?></td>
</tr>

<?php
}								
?>
<tr>
	<td colspan="5"></td>
</tr>
<tr>
	<td colspan=2> English : <input type="radio" name="unicode" value='0' checked></td>
	<td colspan=3>Urdu : <input type="radio" name="unicode" value='1'> </td>
</tr>
<tr>
	<td> Message : </td>
	<td colspan=4><textarea name="message" style="width:500px; height:200px"> </textarea></td>
</tr>
<tr>
	<td></td>
	<td colspan=4> <input type="submit" name="send" value="Send"> </td>
</tr>
</table>
</form>
