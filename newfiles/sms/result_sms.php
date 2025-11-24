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

$exam_id = -1;
if(isset($_REQUEST['exam_id']))
	$exam_id = $_REQUEST['exam_id'];
	
if(isset($_POST['send']))
{
	$cell_nos = $_POST['cell_no'];
	//$recipients = implode(",",array_filter($cell_nos));
	
	$std_ids = $_POST['std_id'];
	$messages = $_POST['message'];
	$footer = $_POST['footer'];
	//$footer = $footer. "\n" .'Baltistan Public School Skardu'. "\n" .'05815-454945';
	//$footer = $footer. "\n" .'Baltistan Public School Skardu'. "\n" .'05815-454945';
	$unicode = $_POST['unicode'];
	
	$i = 0;
	foreach($std_ids as $sid)
	{
		$std = getSingleRow("SELECT * FROM `schl_students` WHERE id = '$sid'");
		if(in_array($std['cell_no'], $cell_nos))
		{
			$msg = $std['name'] . "\n" . $messages[$i] . $footer. "\n" .'Baltistan Public School Skardu'. "\n" .'05815-454945';
			
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
	<td>Select Exam </td>
	<td><?php $exam_id = examDropDown($exam_id,$ses_class_id,$session_id, $campus_id, $active = 1);
	?></td>
</tr>
</table>

<hr>

<style>
#highlight:hover{
background-color:burlywood;
}
</style>

<table border='1px' width="80%">
<tr>
	<th></th>
	<th>SNo.</th>
	<th>Reg No.</th>
	<th>Name</th>
	<th>Cell No.</th>
	<th>Message</th>
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
	$cell_no = $std['cell_no'];
	if(strlen($std['cell_no']) != 11)
	{
		$cell_no = '';
	}
	$sno++;
?>
<tr id="highlight">
	 <input type="hidden" name="std_id[]" value="<?php echo $std['id'] ?>">
	<td> <input type="checkbox" name="cell_no[]" value="<?php echo $cell_no ?>" <?php echo ($cell_no != "") ? "checked" : "" ?> > </td>
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
	$results = getMultipleRows("SELECT res.obt_marks,cse.total_marks,sub.name as subname, sub.abbreviation 
							FROM `schl_result` res 
							join schl_class_subject_exams cse on res.class_sub_exam_id = cse.id 
							join schl_subject_class sc on cse.sub_class_id = sc.id 
							join schl_subjects sub on sc.subject_id = sub.id 
							join schl_session_class sescls on sescls.id=sc.session_class_id 
							WHERE cse.exam_id = '$exam_id' and res.student_id = '".$std['id']."' 
							and sescls.session_id='$session_id'");
	$msg_html = "";
	$msg_sms = "";
	$obt_m = 0;
	$total_m = 0;
	$per = 0;
	foreach($results as $res)
	{
		$obt_m += $res['obt_marks'];
		$total_m += $res['total_marks'];
		$msg_html .= $res['abbreviation'] . "=" . round($res['obt_marks']) . "/" . round($res['total_marks']) . "<br>";
		$msg_sms .= $res['abbreviation'] . "=" . round($res['obt_marks']) . "/" . round($res['total_marks']) . "\n";
	}
	if($total_m != 0)
		$per = round(($obt_m/$total_m) * 100,2);
	 // tota obtain and gran total
		$msg_html .= 'Total' . "=" . round($obt_m) . "/" . round($total_m) . "<br>";
		$msg_sms .= 'Total' . "=" . round($obt_m) . "/" . round($total_m) . "\n";
	// Percentage
		$msg_html .= 'Per' . "=" . $per . "%" . "<br>";
		$msg_sms .= 'Per' . "=" . $per . "%" . "\n";
		
	
	?>
	
	<td><?php echo $msg_html ?></td>
	<input type="hidden" name="message[]" value="<?php echo $msg_sms ?>">
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
	<td colspan=2>Foot Note:</td>
	<td colspan=4> <textarea name="footer" style="width:500px; height:100px"></textarea> </td>
</tr>
<tr>
	<td></td>
	<td colspan=5> <input type="submit" name="send" value="Send"> </td>
</tr>
</table>
</form>
