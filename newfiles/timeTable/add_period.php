<?php
$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/demo.css");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.easyui1.min.js");

$user_array = JFactory::getUser();
$user_id =$user_array->id;

include "newfiles/conn.php";
include "common.php";


if(checkPermission(JFactory::getUser(),"timetable_setting")==0)
{
	echo "You cannot access this site";	
	return ;
}

$dept=-1;
if(isset($_REQUEST['department_id']))
{
	$dept=$_REQUEST['department_id'];
}

$prog=-1;
if(isset($_REQUEST['program_id']))
{
	$prog=$_REQUEST['program_id'];
}

$sem=-1;
if(isset($_REQUEST['semester_id']))
{
	$sem=$_REQUEST['semester_id'];
}

$course=-1;
if(isset($_REQUEST['course_id']))
{
	$course=$_REQUEST['course_id'];	

}

$cur_semester = mysqli_query($conn, "select * from kiusc_semesters where is_current = 1");
$cur_semester = mysqli_fetch_assoc($cur_semester);
if (isset($_REQUEST['add']))
{
	$h=$_REQUEST['hours'];
	$fac=$_POST['fac_id'];

	$date=mysqli_query($conn,"select * from kiusc_semesters where id = '$sem'");
	$date=mysqli_fetch_assoc($date);
	
	mysqli_query($conn,"INSERT INTO `kiusc_timetable` (`id`,`sem_id`,`c_offer_id`,`room_id`,`fac_id`,`start`,`end`,`day`,`period`,`start_date`,`end_date`, updated_by, updated_date) 
	VALUES (NULL, '$sem', '$course', '', '$fac', '', '', '', '$h', '" . $date['start_date'] . "','" . $date['final_term_end_date'] . "', '$user_id','NOW()')");
}

if (isset($_REQUEST['did']))
{
	$re=mysqli_query($conn,"select * from kiusc_timetable where id=". $_GET['did']);
	$no=mysqli_fetch_assoc($re);
	if($no['room_id'] != 0)
	{
		echo "You Cannot delete this...";
	}
	else
	{
	mysqli_query($conn,"delete from kiusc_timetable where id=".$_REQUEST['did']);
	}
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
	</tr>';

echo '
	<tr>
		<td> 
			Select Program : 
		</td>
		<td>';
	$prog = showProgramSel($conn, $prog, $dept);
echo '	</td>
	</tr>';

echo '
	<tr>
		<td> 
			Select Semester : 
		</td>
		<td>';
		$sem = showSemesterSel($conn, $sem, $prog, $dept);
echo '	</td>
	</tr>';

echo '
	<tr>
		<td> 
			Select Course : 
		</td>
		<td>';
	$course = showCourseSel($conn, $course, $sem, $prog, $dept);
	$se=mysqli_query($conn,"select u.* from s04cf_users u join kiusc_course_offered o on o.fac_id= u.id where o.id='$course'");
			$fe=mysqli_fetch_assoc($se);
			$fac = $fe['id'];
echo '
		</td>
	</tr>';
echo '
	<tr>
		<form name="submit" id="submit" action="" method="post">
		<input type="hidden" name="department_id" value="'.$dept.'">
		<input type="hidden" name="program_id" value="'.$prog.'">
		<input type="hidden" name="semester_id" value="'.$sem.'">
		<input type="hidden" name="course_id" value="'.$course.'">
		<input type="hidden" name="fac_id" value="'.$fac.'">';?>

		<td> Hours </td> 
		<td> <input type="number" name="hours" min="1" step="0.5" required /></td>
	</tr>
	<tr>
		<td> </td>
		<td>
        <?php
        // if($course!=-1 and $sem == $cur_semester['id'])
        // {
			echo '<input type="submit" value="Add"  name ="add"/>';
		//}
		?>
        </td>
	</tr>
</form>
</table>

<br /><br />
<table border="1px" style="width:50%">
	<tr>
        <th>Periods</th>
        <th>Action</th>
    </tr>
    <?php
    $pe = mysqli_query($conn,"select * from kiusc_timetable where c_offer_id = '$course' and is_changed=0");
	while($re=mysqli_fetch_assoc($pe))
	{
	?>
    <tr>
        <td><?php echo $re['period']; ?></td>
        <td> 
			<?php
			// if($sem == $cur_semester['id'])
			// { ?>
			<a href="index.php/time-table/add-period?did=<?php echo $re['id'] ?>
        &department_id=<?php echo $dept ?>&program_id=<?php echo $prog?>&semester_id=<?php echo $sem?>&course_id=<?php echo $course?>"> Delete </a>
			<?php// } ?>
		</td>
    </tr>
	<?php
	}
	?>
	</table>