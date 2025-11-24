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

if(isset($_POST['send']))
{
	$cell_nos = $_POST['cell'];
	$recipients = implode(",",array_filter($cell_nos));
	$message = $_POST['message'];
	$message = $message. "\n" .'UOBS';
	$unicode = $_POST['unicode'];

	$response = send($recipients, $message, $unicode);
	echo $response ;
	
	//$no_of_sms = calculateSMS($response);
	//if($no_of_sms > 0)
	//{
		//ins_upd_del("INSERT INTO `schl_sms_log`(`date`, `no_of_sms`) VALUES ('".date("Y-m-d")."','$no_of_sms')");
	//}
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
?>
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
<input type="checkbox" name="select-all" id="select-all" /> Check All 


<script language="JavaScript">

$("#select-all").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});

</script>
<form action="" method="POST">
<input type="hidden" name="sel_dep_id" value="'. $department .'">
<input type="hidden" name="sel_prog_id" value="'. $program .'">
<?php

	$students = mysqli_query($conn,"SELECT s.* FROM `kiusc_students` s 
								join kiusc_departments d on d.id = s.department_id 
								join kiusc_programs p on p.id = s.prog_id 
								WHERE s.department_id = '$department' and s.prog_id = '$program'");

$sno=0;
while($std = mysqli_fetch_assoc($students))
//foreach($students as $std)
{
	$reg_no = $std['reg_no'];
	$cell = $std['cell'];
	if(strlen($std['cell']) != 11)
	{
		$cell = '';
	}
	$sno++;
?>
<tr id="highlight">
	<td> <input type="checkbox" name="cell[]"  value="<?php echo $cell ?>" <?php echo ($cell != "") ? "checked" : "" ?> > </td>
	<td><?php echo $sno ?></td>
	<td><?php echo $std['reg_no'] ?> </td>
	<td><?php echo $std['name'] ?></td>
	<?php
	if(strlen($std['cell']) != 11)
	{
		echo "<td style='color:red'>". $std['cell'] . "</td>";
	}
	else
		echo "<td>". $std['cell'] . "</td>";
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
