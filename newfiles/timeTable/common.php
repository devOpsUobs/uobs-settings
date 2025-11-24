<style>
	.align-center {
		text-align: center;
	}

	.btn {
		border: 2px solid black;
		background-color: white;
		color: black;
		padding: 4px 8px;
		font-size: 12px;
		cursor: pointer;
		border-radius: 10px;
	}

	.btn2 {
		border: 2px solid black;
		background-color: white;
		color: black;
		padding: 7px 14px;
		font-size: 14px;
		cursor: pointer;
		border-radius: 18px;
	}

	/* Green */
	.success {
		border-color: #04AA6D;
		color: green;
	}

	.success:hover {
		background-color: #04AA6D;
		color: white;
	}

	/* Blue */
	.info {
		border-color: #2196F3;
		color: dodgerblue;
	}

	.info:hover {
		background: #2196F3;
		color: white;
	}

	/* Orange */
	.warning {
		border-color: #ff9800;
		color: orange;
	}

	.warning:hover {
		background: #ff9800;
		color: white;
	}

	/* Red */
	.danger {
		border-color: #f44336;
		color: red;
	}

	.danger:hover {
		background: #f44336;
		color: white;
	}

	/* Gray */
	.default {
		border-color: #e7e7e7;
		color: black;
	}

	.default:hover {
		background: #e7e7e7;
	}

	.chzn-drop>ul {
		background-color: white !important;
	}

	span {
		color: black;
	}

	.select{
		border-radius: 10px;
		width: 75%;
		box-shadow: 0 0 0.5rem rgba(0, 0, 0, 1);
	}
</style>
<?php 
function getUserGroupsname ($user)
{
$db = JFactory::getDBO();    

    $db->setQuery($db->getQuery(true)
        ->select('*')
        ->from("#__usergroups")
    );
    $groups=$db->loadRowList();

            $userGroups = $user->groups;
            $return=array();

          foreach ($groups as $key=>$g){
            if (array_key_exists($g[0],$userGroups)) array_push($return,$g[4]);
          }

          return $return;
}
function checkPermission($user,$perm_request)
{

  $groupsname=getUserGroupsname($user);
	if (in_array($perm_request, $groupsname))
	{
		return 1;
    }
	else
		return 0;
}

////////////////////////////////////////////////
///////// Functions /////////////////////////
///////////////////////////////////////////////

function showDepartmentSel($conn, $dep)
{
	$dept_re =  mysqli_query($conn,"select * from kiusc_departments");
	 
echo '
<form name="dep_select" id="dep_select" action="" method="post">
<select name="department_id" id="department_id">';

 $sel_dep=-1;
while($row = mysqli_fetch_assoc($dept_re))
{
	if (checkPermission(JFactory::getUser(),$row['group'])==1)
	{
		$s="";
		if ($sel_dep==-1)
		{	
			$sel_dep=$row['id'];
			$s = " selected ";
		}
	   if ($dep==$row['id']) 
	   {
			$sel_dep=$row['id'];
			$s=" selected ";
	   }
	   
		echo '<option '.$s.' value="'.$row['id'].'">'.$row['name'].'</option>';
	}
}

echo'</select>
 </form>';
 
?>

<script type="text/javascript">
$("#department_id").change(function()
	{
		$("#dep_select").trigger("submit");
	}
);

</script>

<?php
return $sel_dep;
}


function showProgramSel($conn, $prog,$dep)
{
	
	$prog_re =  mysqli_query($conn,"select p.* from kiusc_programs p join kiusc_departments d on d.id=p.dep_id where dep_id='$dep' order by p.id desc");
	 
echo '
<form name="prog_select" id="prog_select" action="" method="post">
<input type="hidden" name="department_id" value="'.$dep.'">
<select name="program_id" id="program_id">';

 $sel_prog=-1;
while($row = mysqli_fetch_assoc($prog_re))
{
		$s="";
		if ($sel_prog==-1)
		{	
			$sel_prog=$row['id'];
			$s = " selected ";
		}
	   if ($prog==$row['id']) 
	   {
			$sel_prog=$row['id'];
			$s=" selected ";
	   }
	   
		echo '<option '.$s.' value="'.$row['id'].'">'.$row['name'].' ('.$row['session'].')'.$row['group'].'</option>';
}

echo'</select>
 </form>';
 
?>

<script type="text/javascript">
$("#program_id").change(function()
	{
		$("#prog_select").trigger("submit");
	}
);

</script>

<?php
return $sel_prog;
}

function showSemesterSel($conn, $sem, $prog,$dep)
{
	$sem_re =  mysqli_query($conn,"select * from kiusc_semesters where active = 1 order by id desc");
	 //select s.* from kiusc_semesters s join kiusc_course_offered o on s.id=o.sem_id where prog_id=".$prog
echo '
<form name="sem_select" id="sem_select" action="" method="post">
<input type="hidden" name="department_id" value="'.$dep.'">
<input type="hidden" name="program_id" value="'.$prog.'">
<select name="semester_id" id="sem_id">';

 $sel_sem=-1;
while($row = mysqli_fetch_assoc($sem_re))
{
	$s="";
	if ($sel_sem==-1)
	{	
		$sel_sem=$row['id'];
		$s = " selected ";		
	}
	if ($sem==$row['id']) 
	{
		$sel_sem=$row['id'];
		$s=" selected ";
	}
   
	echo '<option '.$s.' value="'.$row['id'].'">'.$row['sem_name'].'</option>';
}

echo'</select>
 </form>';

?>

<script type="text/javascript">
$("#sem_id").change(function()
	{
		$("#sem_select").trigger("submit");
	}
);

</script>
<?php
return $sel_sem;
}


function showCourseSel($conn, $course, $sem, $prog, $dep)
{
	$course_re =  mysqli_query($conn,"select c.*, o.id as cf_id from kiusc_courses c join kiusc_course_offered o on c.id = o.course_id where prog_id ='$prog' and sem_id ='$sem'");
	
echo '
<form name="course_select" id="course_select" action="" method="post">

<input type="hidden" name="department_id" value="'.$dep.'">
<input type="hidden" name="program_id" value="'.$prog.'">
<input type="hidden" name="semester_id" value="'.$sem.'">
<select name="course_id" id="course_id">';

 $sel_course=-1;
while($row = mysqli_fetch_assoc($course_re))
{
		$s="";
		if ($sel_course==-1)
		{	
			$sel_course=$row['cf_id'];
			$s = " selected ";
		}
	   if ($course==$row['cf_id']) 
	   {
			$sel_course=$row['cf_id'];
			$s=" selected ";
	   }
	   
		echo '<option '.$s.' value="'.$row['cf_id'].'" required>'.$row['name'].'</option>';
}

echo'</select>
 </form>';
 
?>

<script type="text/javascript">
$("#course_id").change(function()
	{
		$("#course_select").trigger("submit");
	}
);

</script>

<?php
return $sel_course;
}


function showRoomSel($conn, $room,$course, $sem, $prog, $dep)
{
	$room_re =  mysqli_query($conn,"select distinct r.room_number,rp.room_id from kiusc_rooms r join kiusc_room_program rp on r.id = rp.room_id where prog_id='$prog' and sem_id='$sem'");
	
echo '
<form name="room_select" id="room_select" action="" method="post">

<input type="hidden" name="department_id" value="'.$dep.'">
<input type="hidden" name="program_id" value="'.$prog.'">
<input type="hidden" name="semester_id" value="'.$sem.'">
<input type="hidden" name="course_id" value="'.$course.'">

<select name="room_id" id="room_id">';

 $sel_room=-1;
while($row = mysqli_fetch_assoc($room_re))
{
		$s="";
		if ($sel_room==-1)
		{	
			$sel_room=$row['room_id'];
			$s = " selected ";
		}
	   if ($room==$row['room_id']) 
	   {
			$sel_room=$row['room_id'];
			$s=" selected ";
	   }
	   
		echo '<option '.$s.' value="'.$row['room_id'].'">'.$row['room_number'].'</option>';
}

echo'</select>
 </form>';
?>

<script type="text/javascript">
$("#room_id").change(function()
	{
		$("#room_select").trigger("submit");
	}
);

</script>

<?php
return $sel_room;
}

function programConflict($conn, $sem, $prog, $s_time, $e_time, $day)
{
	
	$s=date("H:i", strtotime("$s_time"));
	$e=date("H:i", strtotime("$e_time"));

	$prog_conf= mysqli_query($conn,"SELECT cf.*, c.name FROM `kiusc_course_offered` cf join kiusc_courses c on cf.course_id = c.id 
	WHERE `sem_id` = '$sem' and `prog_id` = '$prog'");
		
	$conflict = 0;
	$conflict_arr = array();
	while($list= mysqli_fetch_assoc($prog_conf))
	{
		$value=mysqli_query($conn,"select * from kiusc_timetable where sem_id='$sem' and start='$s_time' and end ='$e_time' and day = '$day' and is_changed = 0 and c_offer_id =".$list['id']);
		$count=mysqli_num_rows($value);
		if($count>0)
		{
			$conflict=1;
			$conflict_arr[] = array('c_name'=>$list['name']);
		}
	}
	return array("con_arr" => $conflict_arr, "is_con" => $conflict);
	
}


function StudentConflict($conn, $sem, $course, $s_time, $e_time, $day)
{
	
	$s=date("H:i", strtotime("$s_time"));
	$e=date("H:i", strtotime("$e_time"));

	$std_conf= mysqli_query($conn,"SELECT `c_offer_id`, stud_id FROM `kiusc_results` WHERE stud_id in (SELECT `stud_id` FROM `kiusc_results` 
		WHERE `c_offer_id` = '$course') and sem_id = '$sem'");
		
	$conflict = 0;
	$conflict_arr = array();
	while($list= mysqli_fetch_assoc($std_conf))
	{
		$value=mysqli_query($conn,"select * from kiusc_timetable where sem_id='$sem' and start='$s_time' and end ='$e_time' and day = '$day' and c_offer_id =".$list['c_offer_id']);
		$count=mysqli_num_rows($value);
		if($count>0)
		{
			$conflict=1;
			$conflict_arr[] = array('stud_id'=>$list['stud_id'], 'c_offer_id'=>$list['c_offer_id']);
		}
		
		//// for merge courses 
		$value=mysqli_query($conn,"select * from kiusc_timetable where sem_id='$sem' and start='$s_time' and end ='$e_time' and day = '$day' and merge_offer_id =".$list['c_offer_id']);
		$count=mysqli_num_rows($value);
		if($count>0)
		{
			$conflict=1;
			$conflict_arr[] = array('stud_id'=>$list['stud_id'], 'c_offer_id'=>$list['c_offer_id']);
		}
	}
	return array("con_arr" => $conflict_arr, "is_con" => $conflict);
	
}

function TeacherConflict($conn, $sem, $course, $fac, $s_time, $e_time, $day)
{
	$s=date("H:i", strtotime("$s_time"));
	$e=date("H:i", strtotime("$e_time"));

	$teach_conf= mysqli_query($conn,"SELECT `c_offer_id`, fac_id FROM `kiusc_timetable` WHERE fac_id = '$fac' and sem_id = '$sem' and start='$s_time' and end ='$e_time' and day = '$day'and is_changed=0");
		
	$teacher = 0;
	$teach_arr = array();
	
	$co=mysqli_num_rows($teach_conf);
	if($co > 0)
	{
		while($li= mysqli_fetch_assoc($teach_conf))
		{		
			$teacher=1;
			$teach_arr[] = array('fac_id'=>$li['fac_id'], 'c_offer_id'=>$li['c_offer_id']);
		}
	}
	
	return array("con_ar"=>$teach_arr, "is_con"=>$teacher);
}

function RoomtConflict($conn, $sem, $course, $room, $s_time, $e_time, $day)
{
	
	//echo 'sem='.$sem.'-c='.$course.'-r='.$room.'-st='.$s_time.'-et='.$e_time.'-d='.$day;
	$s=date("H:i", strtotime("$s_time"));
	$e=date("H:i", strtotime("$e_time"));
	
	//	$room_conf= mysqli_query($conn,"SELECT `c_offer_id`, room_id FROM `kiusc_timetable` WHERE room_id in (SELECT `room_id` FROM `kiusc_timetable` 
		//WHERE `c_offer_id` = '$course') and sem_id = '$sem' and start='$s_time' and end ='$e_time'");
		$room_conf= mysqli_query($conn,"SELECT `c_offer_id`, room_id FROM `kiusc_timetable` WHERE sem_id = '$sem' and start='$s_time' and end ='$e_time' 
		and room_id = '$room' and day = '$day'");

		$rom = 0;
		$room_arr = array();
	while($lis= mysqli_fetch_assoc($room_conf))
	{
		$res = mysqli_query($conn,"select * from kiusc_timetable where sem_id='$sem' and room_id = '$room' 
		and start='$s_time' and end ='$e_time'  and day = '$day' and is_changed = 0 and c_offer_id =".$lis['c_offer_id']);
		$count=mysqli_num_rows($res);
		if($count > 0)
		{
			$rom=1;
			$room_arr[] = array('room_id'=>$lis['room_id'], 'c_offer_id'=>$lis['c_offer_id']);
		}
	}
	//print '-con='.$rom .'<br>';
		return array("con_arr" => $room_arr, "is_con" => $rom);

}


function StudentChangeConflict($conn, $sem, $course, $s_time, $e_time, $day, $new_date)
{
	
	$s=date("H:i", strtotime("$s_time"));
	$e=date("H:i", strtotime("$e_time"));

	$std_conf= mysqli_query($conn,"SELECT `c_offer_id`, stud_id FROM `kiusc_results` WHERE stud_id in (SELECT `stud_id` FROM `kiusc_results` 
		WHERE `c_offer_id` = '$course') and sem_id = '$sem'");
		
	$conflict = 0;
	$conflict_arr = array();
	while($list= mysqli_fetch_assoc($std_conf))
	{
		$value=mysqli_query($conn,"select * from kiusc_timetable where sem_id='$sem' and start='$s_time' and end ='$e_time' and day = '$day' 
		and c_offer_id =".$list['c_offer_id']." and is_changed=0");
		$count=mysqli_num_rows($value);
		if($count>0)
		{
			$conflict=1;
			$conflict_arr[] = array('stud_id'=>$list['stud_id'], 'c_offer_id'=>$list['c_offer_id']);
		}
	}
	return array("con_arr" => $conflict_arr, "is_con" => $conflict);
	
}

function TeacherChangeConflict($conn, $sem, $course, $fac, $s_time, $e_time, $day, $new_date)
{
	$s=date("H:i", strtotime("$s_time"));
	$e=date("H:i", strtotime("$e_time"));

	$teach_conf= mysqli_query($conn,"SELECT `c_offer_id`, fac_id FROM `kiusc_timetable` WHERE fac_id in (SELECT `fac_id` FROM `kiusc_timetable` 
		WHERE `c_offer_id` = '$course') and sem_id = '$sem' and start='$s_time' and end ='$e_time' and day='$day'  and is_changed = 0");
		
		$teacher = 0;
		$teach_arr = array();
	while($li= mysqli_fetch_assoc($teach_conf))
	{
		$res = mysqli_query($conn,"select * from kiusc_timetable where sem_id='$sem' and start='$s_time' and end ='$e_time' 
		and  day = '$day'");
		$co=mysqli_num_rows($res);
		if($co > 0)
		{
			$teacher=1;
			$teach_arr[] = array('fac_id'=>$li['fac_id'], 'c_offer_id'=>$li['c_offer_id']);
		}
	}
	
	return array("con_ar"=>$teach_arr, "is_con"=>$teacher);
}

function RoomChangeConflict($conn, $sem, $course, $room, $s_time, $e_time, $day, $new_date)
{
	$s=date("H:i", strtotime("$s_time"));
	$e=date("H:i", strtotime("$e_time"));

		$room_conf= mysqli_query($conn,"SELECT `c_offer_id`, room_id FROM `kiusc_timetable` WHERE room_id in (SELECT `room_id` FROM `kiusc_timetable` 
		WHERE `c_offer_id` = '$course') and sem_id = '$sem' and start='$s_time' and end ='$e_time' and day='$day' and is_changed=0");
		
		$rom = 0;
		$room_arr = array();
	while($lis= mysqli_fetch_assoc($room_conf))
	{
		$res = mysqli_query($conn,"select * from kiusc_timetable where sem_id='$sem' and room_id = '$room' 
		and start='$s_time' and end ='$e_time'  and day = '$day' and c_offer_id =".$lis['c_offer_id']);
		$count=mysqli_num_rows($res);
		if($count > 0)
		{
			$rom=1;
			$room_arr[] = array('room_id'=>$lis['room_id'], 'c_offer_id'=>$lis['c_offer_id']);
		}
	}
		return array("con_arr" => $room_arr, "is_con" => $rom);

}

?>