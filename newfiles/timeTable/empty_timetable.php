<?php
$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/demo.css");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.easyui1.min.js");

include "newfiles/conn.php";
include "common.php";

if(checkPermission(JFactory::getUser(),"timetable_setting")==0)
{
	echo "You cannot access this site";	
	return ;
}

$sem=-1;
if(isset($_POST['semester_id']))
{
	$sem=$_POST['semester_id'];
}

if(isset($_POST['empty']))
{
	mysqli_query($conn, "UPDATE `kiusc_timetable` SET `room_id`='0', `start`='', `end`='', `day`='' where `sem_id` = '$sem'");
	
	$periods = mysqli_query($conn, "SELECT * FROM `kiusc_timetable` WHERE `sem_id` = '$sem'");
	while($per = mysqli_fetch_assoc($periods))
	{
		mysqli_query($conn, "DELETE FROM `kiusc_lectures` WHERE `period_id` = '".$per['id']."'");
	}
	
	print "complete successfully";
}

?>

<?php
echo '
<table>
	<tr>
		<td> 
			Select Department : 
		</td>
		<td>';
			$sem = showSemesterSel($conn, $sem, 0, 0);
echo '	</td>
	</tr>';
?>
</table>

<form action="" method="post">
<input type="hidden" name="semester_id" value="<?php echo $sem ?>">

<input type="submit" name="empty" value="Empty" onclick="return confirm('All the entries of timetable will delete. Are you sure you want to continue')">

</form>