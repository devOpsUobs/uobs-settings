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

$dept=-1;
if(isset($_POST['department_id']))
{
	$dept=$_POST['department_id'];
}

$sem=-1;
if(isset($_POST['semester_id']))
{
	$sem=$_POST['semester_id'];
}

if(isset($_POST['empty']))
{
	$from_date = $_POST['from_date'];
	
	mysqli_query($conn, "UPDATE `kiusc_timetable` t 
	join kiusc_course_offered cf on t.c_offer_id = cf.id 
	join kiusc_programs p on cf.prog_id = p.id 
	SET t.`room_id`='0', t.`start`='', t.`end`='', t.`day`='', t.`start_date`='$from_date' 
	WHERE p.dep_id = '$dept' and t.sem_id = '$sem'");
	
	$periods = mysqli_query($conn, "SELECT t.* FROM `kiusc_timetable` t join kiusc_course_offered cf on t.c_offer_id = cf.id 
					join kiusc_programs p on cf.prog_id = p.id WHERE p.dep_id = '$dept' and t.sem_id = '$sem'");
					
	while($per = mysqli_fetch_assoc($periods))
	{
		mysqli_query($conn, "DELETE FROM `kiusc_lectures` WHERE `period_id` = '".$per['id']."' and date >= '$from_date'");
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
			$dept = showDepartmentSel($conn, $dept);
echo '	</td>
	</tr>
	<tr>
		<td> 
			Select Semester : 
		</td>
		<td>';
			$sem = showSemesterSel($conn, $sem, 0, $dept);
echo '	</td>
	</tr>';
?>
</table>

<form action="" method="post">
<input type="hidden" name="department_id" value="<?php echo $dept ?>">
<input type="hidden" name="semester_id" value="<?php echo $sem ?>">

From Date: <input type="date" name="from_date">
<input type="submit" name="empty" value="Empty" onclick="return confirm('All the entries of timetable will delete. Are you sure you want to continue')">

</form>