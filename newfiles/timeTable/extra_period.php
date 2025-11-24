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
$cur_sem_re = mysqli_query($conn, "select * from kiusc_semesters where is_current=1");
$cur_sem_re = mysqli_fetch_assoc($cur_sem_re);
$cur_sem = $cur_sem_re['id'];
	
$cf_id=-1;	
if(isset($_REQUEST['cf_id']))
{
	$cf_id=$_REQUEST['cf_id'];
}

$cf_id = offeredCourses($conn, $cf_id, $cur_sem);

if(isset($_POST['save']))
{
	$l_date = $_POST['l_date'];
	
	mysqli_query($conn, "INSERT INTO `kiusc_lectures`(`c_offer_id`, `date`, `period_id`, `noLecture`, `noLectureReason`) 
	VALUES ('$cf_id', '$l_date', '0', '0', '')");
}

if(isset($_GET['did']))
{
	$id = $_GET['did'];
	
	mysqli_query($conn, "DELETE FROM `kiusc_lectures` WHERE id = '$id'");
}
?>


<form action="" method="POST">

<input type="hidden" name="cf_id" value="<?php echo $cf_id ?>">
Lecture Date : <input type="date" name="l_date" required>

<input type="submit" name="save" value="Save">
</form>

<hr>

<table width="50%">
<tr>
	<th>S.No.</th>
	<th>Date</th>
	<th></th>
</tr>
<?php
$sno = 0;
$extras = mysqli_query($conn, "SELECT * FROM `kiusc_lectures` WHERE `c_offer_id` = '$cf_id' and `period_id` = 0");
while($ext = mysqli_fetch_assoc($extras))
{
	$sno++;
	echo '
	<tr>
		<td>'.$sno.'</td>
		<td>'.$ext['date'].'</td>
		<td><a href="index.php/faculty/current-courses/extra-period?did='.$ext['id'].'&cf_id='.$cf_id.'" onClick="return confirm(\'Are you sure\')"> Delete </a></td>
	</tr>
	';
}
?>
</table>



<?php
function offeredCourses($conn, $sel_course, $cur_sem)
{
$user= JFactory::getUser();
	$sel_course_offer =  mysqli_query($conn, "select cofr.*, c.name, p.name as p_name, p.session  from kiusc_course_offered cofr 
	join kiusc_courses c on c.id=cofr.course_id 
	join kiusc_programs p on cofr.prog_id = p.id 
	where fac_id='$user->id' and sem_id = '$cur_sem' order by name");
	               
	 
echo '
<form name="sel_select" id="sel_select" action="" method="post">
<h3>Select course</h3>

<select name="cf_id" style="width:500px" id="sel_id">';



 $course=-1;
while($row = mysqli_fetch_assoc($sel_course_offer))
{
	$periods = mysqli_query($conn,"select t.*, p.* from kiusc_timetable t 
		join kiusc_course_offered cf on t.c_offer_id = cf.id 
		join kiusc_programs p on cf.prog_id = p.id 
		where t.sem_id='$cur_sem' and t.c_offer_id='".$row['id']."' and t.is_changed=0");
		
	$period = mysqli_num_rows($periods);
	$sec = mysqli_fetch_assoc($periods);
	if($period == 0)
		continue;
	
	
	
	
		$s="";
		if ($course==-1)
		{	
			$course=$row['id'];
			$s = " selected ";
		}
	   if ($sel_course==$row['id']) 
	   {
			$course=$row['id'];
			$s=" selected ";
	   }
	   
	   if($sec['merge_offer_id'] ==0)
	   {
			echo '<option '.$s.' value="'.$row['id'].'">'.$row['name'] .'('.$row['p_name'].'-'.$row['session'].')</option>';
	   }
	   else
	   {
		   echo '<option '.$s.' value="'.$row['id'].'">'.$row['name'] .'('.$row['p_name'].'-'.$row['session'] . ', '. $sec['name'] .'-' . $sec['session'] .')</option>';
	   }
	   
}

echo'</select>
<br></br>
 </form>';
 
?>

<script type="text/javascript">
$("#sel_id").change(function()
	{
		$("#sel_select").trigger("submit");
	}
);

</script>

<?php
return $course;
}
?>