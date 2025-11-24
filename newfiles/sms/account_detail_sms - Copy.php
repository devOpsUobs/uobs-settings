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
	
$campus_id = -1;
if(isset($_REQUEST['campus_id']))
	$campus_id = $_REQUEST['campus_id'];

if(isset($_POST['send']))
{
	$reg_nos = $_POST['reg_no'];
	//$cell_nos = $_POST['cell_no'];
	//$message = $_POST['message'];
	
	$unicode = $_POST['unicode'];
	
	foreach($reg_nos as $reg_no)
	{
		$std = getSingleRow("SELECT * FROM `schl_students` WHERE reg_no = '$reg_no'");
		if(in_array($std['reg_no'], $reg_nos))
		{
			//$message = $message . "\n" . "Username:" . $reg_no. "\n" ."Password:12345";
			
			$message = "Public School & College has launched E-Learning system to continue online classes during COVID-19.To access the online resources please enter following address in any web browser:
			118.107.134.254/pscsstd
			Username:".$std['reg_no']."
			Password:12345";
			
			$response = send($std['cell_no'], $message, $unicode);
			echo $response ;
			
			$no_of_sms = calculateSMS($response);
			if($no_of_sms > 0)
			{
				ins_upd_del("INSERT INTO `schl_sms_log`(`date`, `no_of_sms`) VALUES ('".date("Y-m-d")."','$no_of_sms')");
			}
		}
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
</table>

<hr>

<style>
#highlight:hover{
background-color:burlywood;
}
</style>

<table border='1px'>
<tr>
	<th></th>
	<th>SNo.</th>
	<th>Reg No.</th>
	<th>Name</th>
	<th>Cell No.</th>
</tr>

<form action="" method="POST">
<input type="hidden" name="campus_id" value="<?php echo $campus_id ?>"/>
<input type="hidden" name="session_id" value="<?php echo $session_id ?>"/>
<input type="hidden" name="ses_class_id" value="<?php echo $ses_class_id ?>"/>
<?php
if($ses_class_id == 0)
{
	$students = getMultipleRows("SELECT s.* FROM `schl_students` s 
								join schl_student_class sc on s.id = sc.student_id 
								join schl_session_class sescl on sc.session_class_id = sescl.id 
								WHERE sescl.session_id = '$session_id' and s.has_left_school = 0");
}
else
{
	$students = getMultipleRows("SELECT s.* FROM `schl_students` s 
								join schl_student_class sc on s.id = sc.student_id   
								WHERE sc.session_class_id = '$ses_class_id' and s.has_left_school = 0");
		
}
$sno=0;
foreach($students as $std)
{
	$reg_no = $std['reg_no'];
	$cell_no = $std['cell_no'];
	if(strlen($std['cell_no']) != 11)
	{
		$cell_no = '';
	}
	$sno++;
?>
<tr id="highlight">
	<td> <input type="checkbox" name="reg_no[]"  value="<?php echo $reg_no ?>" <?php echo ($cell_no != "") ? "checked" : "" ?> > </td>
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
	<td colspan=4><textarea name="message" style="width:500px; height:200px" ></textarea></td>
</tr>
<tr>
	<td></td>
	<td colspan=4> <input type="submit" name="send" value="Send"> </td>
</tr>
</table>
</form>
