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

class gvar
{
	static $timaArray=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
};
class fac
{
	static $timeArray=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
};

$dept=-1;
if(isset($_POST['department_id']))
{
	$dept=$_POST['department_id'];
}

$prog=-1;
if(isset($_POST['program_id']))
{
	$prog=$_POST['program_id'];
}

$sem=-1;
if(isset($_POST['semester_id']))
{
	$sem=$_POST['semester_id'];
}
if(isset($_POST['empty']))
{
	$timetable_id = $_POST['timetable_id'];

	mysqli_query($conn, "UPDATE `kiusc_timetable` SET `room_id`='', `start`='',`end`='',`day`='' WHERE id='$timetable_id'");
	echo "Timetable Empty";

}
if(isset($_POST['delete']))
{
	$timetable_id = $_POST['timetable_id'];

	mysqli_query($conn, "DELETE FROM `kiusc_timetable` WHERE  id='$timetable_id'");
	echo "Timetable Deleted";
}
?>
<?php
echo '
<table class="table table-striped table-hover">
	<tr>
		<td> Select Department : </td>
		<td>';
			$dept = showDepartmentSel($conn, $dept);
			echo '	
		</td>
	</tr>';

	echo '
	<tr>
		<td> Select Program : </td>
		<td>';
			$prog = showProgramSel($conn, $prog, $dept);
			echo '	
		</td>
	</tr>';

	echo '
	<tr>
		<td> Select Semester : </td>
		<td>';
			$sem = showSemesterSel($conn, $sem, $prog, $dept);
			echo '	
		</td>
	</tr>
</table>
</form>';
?>

<?php
// if(isset($_POST['check']))
{
	?>
	<table class="table table-bordered table-striped">
		<tr>
			<th>Day</th>
			<th>Start Time</th>
			<th>End Time</th>
			<th>Subject Name</th>
			<th>Room Number</th>
			<th>Action</th>
		</tr>

		<?php	
			$program=mysqli_query($conn,"select t.merge_offer_id, t.id as tid,t.start,t.end,t.day,c.name as cname,r.room_number 
										from kiusc_timetable t 
										join kiusc_course_offered o on t.c_offer_id=o.id 
										join kiusc_rooms r on t.room_id=r.id
										join kiusc_courses c on o.course_id=c.id 
										where t.sem_id='$sem' and o.prog_id='$prog' and is_changed =0 
										order by t.day, t.start");
			while($progm=mysqli_fetch_assoc($program))
			{
				echo '<tr><td> '.$progm['day'].'</td>';
				echo '<td> '.$progm['start'].'</td>';
				echo '<td> '.$progm['end'].'</td>';
				echo '<td> '.$progm['cname'].'</td>';
				echo '<td> '.$progm['room_number'].'</td>';
				echo '<td> 
						<form method="POST" action="">
							<input type="hidden" name="timetable_id" value="'.$progm['tid'].'">
							<input type="hidden" name="department_id" value="'.$dept.'">
							<input type="hidden" name="program_id" value="'.$prog.'">
							<input type="hidden" name="semester_id" value="'.$sem.'">
							<input type="submit" value="Empty"  name ="empty"  class="btn danger" onclick="return confirm(\'Are you sure you want to Empty this item?\');"/>
							<input type="submit" value="Delete"  name ="delete" class="btn danger" onclick="return confirm(\'Are you sure you want to delete this item?\');"/>
						</form>
				</td>';
				echo '</tr>';
			}
		?> 

	</table>
	<?php
}
?>
