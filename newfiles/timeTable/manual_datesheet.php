<?php
$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/demo.css");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.easyui1.min.js");

include "newfiles/conn.php";
include "dateSheetCommon.php";
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

$course=-1;
if(isset($_POST['course_id']))
{
	$course=$_POST['course_id'];	

}

$room=-1;
if(isset($_POST['room_id']))
{
	$room=$_POST['room_id'];	

}

$date=date('Y-m-d');
if(isset($_POST['date']))
{
	$date=$_POST['date'];	
}

$exam="Mid Term";
if(isset($_POST['exam']))
{
	$exam=$_POST['exam'];	
}

$merge_cf_id = 0;
if(isset($_POST['merge_cf_id']))  // after check button click
{
	$merge_cf_id=$_POST['merge_cf_id'];	
}

if (isset($_POST['insert']))
{
	$s=$_POST['start'];
	$e=$_POST['end'];
	$fac=$_POST['fac_id'];
$rooms=$_POST['rooms'];
	$s=date("H:i", strtotime("$s"));
	$e=date("H:i", strtotime("$e"));		
	
	$ex_re = mysqli_query($conn, "SELECT * FROM `kiusc_datesheet` WHERE `c_offer_id` = '$course' and `exam` = '$exam'");
	$no_ex = mysqli_num_rows($ex_re);
	if($no_ex > 0)
	{
		echo "<font color='red'>Datesheet already exists for this course</font>";
		return;
	}
	
	mysqli_query($conn,"INSERT INTO `kiusc_datesheet`(`sem_id`, `c_offer_id`, `room_id`, `fac_id`, `date`, `start`, `end`, `merge_offer_id`, `exam`,rooms) 
				VALUES ('$sem', '$course', '$room', '$fac', '$date', '$s', '$e', '$merge_cf_id', '$exam','$rooms')");
				
	
	$datesheet_id = mysqli_insert_id($conn);
	
	///// insert in quiz /////
	
	$end_date = date("Y-m-d", strtotime($date . "+1 day"));
	mysqli_query($conn, "INSERT INTO `lms_quiz_create`(`cf_id`, `title`, `start_date`,`end_date`, `start_time`, `end_time`, `no_of_questions`,`datesheet_id`, `no_of_text_questions`) 
							VALUES ('$course', 'Final Exam Spring 2020', '$date', '$end_date', '$s', '$e', '20', '$datesheet_id', '2')");
							
	
}


$conflict=1;
$teacher=1;
$rom=1;
$prog_con = 1;
$conflict_arr = array();
$teach_arr = array();
$room_arr = array();
$prog_arr = array();

$s_time="";
$e_time="";

if (isset($_POST['check']))
{
	$s_time=$_POST['start'];
	$e_time=$_POST['end'];
	$fac=$_POST['fac_id'];
	
	$periods = mysqli_query($conn,"select * from kiusc_timetable where sem_id='$sem' and c_offer_id='$course' and `is_changed` = 0");
	$period = mysqli_fetch_assoc($periods);
	
	$merge_cf_id = $period['merge_offer_id'];
	
	$temp_arr = StudentConflict($conn, $sem, $course, $s_time, $e_time, $date,$exam);
	$conflict_arr = $temp_arr['con_arr'];
	$conflict = $temp_arr['is_con'];
	
	if($merge_cf_id != 0)
	{
		$temp_arr = StudentConflict($conn, $sem, $merge_cf_id, $s_time, $e_time, $date,$exam);
		$conflict_arr2 = $temp_arr['con_arr'];
		
		$conflict_arr=array_merge($conflict_arr,$conflict_arr2);
		if($conflict == 0)
			$conflict = $temp_arr['is_con'];
	}
	
	$temp2_arr = TeacherConflict($conn, $sem, $course, $fac, $s_time, $e_time, $date,$exam);
	$teach_arr = $temp2_arr['con_ar'];
	$teacher = $temp2_arr['is_con'];
	
	$temp3_arr = RoomtConflict($conn, $sem, $course, $room, $s_time, $e_time, $date,$exam);
	$room_arr = $temp3_arr['con_arr'];
	$rom = $temp3_arr['is_con'];
	
	$temp4_arr = programConflict($conn, $sem, $prog, $s_time, $e_time, $date,$exam);
	$prog_arr = $temp4_arr['con_arr'];
	$prog_con = $temp4_arr['is_con'];
	
	
	if($merge_cf_id != 0)
	{
		$prog2 = mysqli_query($conn, "select * from kiusc_course_offered where id = '$merge_cf_id'");
		$prog2 = mysqli_fetch_assoc($prog2);
		
		$temp4_arr = programConflict($conn, $sem, $prog2['prog_id'], $s_time, $e_time, $date,$exam);
		$prog_arr2 = $temp4_arr['con_arr'];
		
		$prog_arr=array_merge($prog_arr,$prog_arr2);
		if($prog_con == 0)
			$prog_con = $temp4_arr['is_con'];	
	}
}

?>


<?php
echo '
<table class="table table-striped table-hover">
	<tr>
		<td> Select Department : </td>
		<td>';
			$dept = showDepartmentSel($conn, $dept);
echo '	</td>
	</tr>';

echo '
	<tr>
		<td> Select Program : </td>
		<td>';
	$prog = showProgramSel($conn, $prog, $dept);
echo '	</td>
	</tr>';

echo '
	<tr>
		<td> Select Semester : </td>
		<td>';
		$sem = showSemesterSel($conn, $sem, $prog, $dept);
echo '	</td>
	</tr>';

echo '
	<tr>
		<td> Select Course : </td>
		<td>';
			$course = showCourseSel($conn, $course, $sem, $prog, $dept);
			$se=mysqli_query($conn,"select u.* from s04cf_users u join kiusc_course_offered o on o.fac_id= u.id where o.id='$course'");
			$fe=mysqli_fetch_assoc($se);
			$fac = $fe['id'];
			
			$periods = mysqli_query($conn,"select * from kiusc_timetable where sem_id='$sem' and merge_offer_id='$course' and `is_changed` = 0");
			$period = mysqli_fetch_assoc($periods);
			if($period['id'])
			{
				echo "<font color='red'> Merged Course </font>";
				return;
			}
?>
		</td>
	</tr>
<?php
echo '
	<tr>
		<td> Select Room : </td>
		<td>';
	$room = showRoomSel($conn, $room,$course, $sem, $prog, $dept);
echo '
		</td>
	</tr>
	<tr>
		<td> Select Exam </td>
    	<td>';
			$exam = examDropDown($exam, $room, $course, $sem, $prog, $dept);
	  		echo '
		</td>
	</tr>';
echo '
	<tr>
		<td> Faculty Name </td>
    	<td>';
		?>
        
   	  	<input type="text" name="facname" value="<?php echo $fe['name']; ?>" readonly="readonly" />
	 <?php echo '
	 	</td>
	</tr>
	<tr>
		<td> Select Date </td>
    	<td>';
   	  		$date= showDateSel($conn,$date, $room, $course, $sem, $prog, $dept, $exam);
	  		echo '
		</td>
	</tr>';
	
?>
  
	<?php 
 	echo '<form name="submit11" id="submit11" action="" method="post">
	<input type="hidden" name="department_id" value="'.$dept.'">
	<input type="text" name="rooms" >
	<input type="hidden" name="program_id" value="'.$prog.'">
	<input type="hidden" name="semester_id" value="'.$sem.'">
	<input type="hidden" name="course_id" value="'.$course.'">
	<input type="hidden" name="room_id" value="'.$room.'">
	<input type="hidden" name="date" value="'.$date.'"> 
	<input type="hidden" name="fac_id" value="'.$fac.'">
	<input type="hidden" name="exam" value="'.$exam.'">
	<input type="hidden" name="merge_cf_id" value="'.$merge_cf_id.'">
	';
	
	?>
    
	<tr> 
		<td>
			Start Time <input type="time" name="start" value="<?php echo $s_time ?>" required/>
    	</td>
		<td>
    		 End Time <input type="time" name="end" value="<?php echo $e_time ?>" required/>
    	</td>
	</tr>
	<tr>
		<td colspan="2">
<?php
	
		$per=mysqli_query($conn, "select * from kiusc_datesheet where c_offer_id = '$course' and exam = '$exam'");
		$per=mysqli_fetch_assoc($per);
		
		$per1=mysqli_query($conn, "select * from kiusc_datesheet where merge_offer_id = '$course' and exam = '$exam'");
		$per1=mysqli_fetch_assoc($per1);
				
		if($course!=-1)
       		echo ' <input type="submit" value="Check"  name ="check"/>';
		if($per['start']!=0 or $per1['start']!=0)
		{
			echo "<font color='red'> Assigned </font>";
		}
		if($conflict==0 && $rom==0 && $teacher==0 && $per['start']==0 && $prog_con==0)
		{
    		echo '<input type="submit" value="Insert"  name ="insert"/>';
		}
?>
    	</td>
	</tr> 
</table>
</form>
<?php
	$re=mysqli_query($conn,"select HOUR(start) as hs, MINUTE(start) as ms,  HOUR(end) as he, MINUTE(end) as me from kiusc_datesheet 
					where sem_id= '$sem' and room_id = '$room' and date = '$date' and exam='$exam'");
	while($r=mysqli_fetch_assoc($re))
	{
		fillarray($conn, $r['hs'], $r['ms'], $r['he'] , $r['me']);
	}?>
    
					<br><h1>Reserved Times</h1><br />

<table cellpadding="3px" cellspacing="2px" width="650" border="1" align="center" style="bordercolor:"#003300"" >
	<tr>
		<td colspan="2">Room Reserved</td>
<?php

	for ($i=18; $i<40;$i++)
	{
 		if (gvar::$timaArray[$i]==1)
		echo '
		<td  style="background-color:#666">&nbsp</td>';
	else
		echo '
		<td>&nbsp</td>';
	}
?>
	</tr>
	<tr>
		<td colspan="24">&nbsp;</td>
	</tr>
<?php
//////////////////////////room id	
		$re=mysqli_query($conn,"select HOUR(start) as hs, MINUTE(start) as ms,  HOUR(end) as he, MINUTE(end) as me from kiusc_datesheet 
					where sem_id= '$sem'  and fac_id='$fac' and date='$date' and exam='$exam'");
		while($f=mysqli_fetch_assoc($re))
		{
			fillfac($conn, $f['hs'], $f['ms'], $f['he'] , $f['me']);
		}
?>
	<tr>
		<td colspan="2">
    		<?php
			$se=mysqli_query($conn,"select * from s04cf_users where id='$fac'");
			$fe=mysqli_fetch_assoc($se);
			print $fe['name'];
			?>
		</td>
<?php

for ($i=18; $i<40;$i++)
{
 if (fac::$timeArray[$i]==1)
	echo '
		<td  style="background-color:#666">
			&nbsp
		</td>';
else
	echo '
		<td>
			&nbsp
		</td>';
}
?>
	</tr>
	<tr>
		<td colspan="2"></td>
		<td colspan="2">09:00</td>
		<td colspan="2">10:00</td>
		<td colspan="2">11:00</td>
		<td colspan="2">12:00</td>
		<td colspan="2">01:00</td>
		<td colspan="2">02:00</td>
		<td colspan="2">03:00</td>
		<td colspan="2">04:00</td>
		<td colspan="2">05:00</td>
		<td colspan="2">06:00</td>
		<td colspan="2">07:00</td>
	</tr>
</table>
								<br><h1>Conflict Students</h1><br />

<table class="table table-striped table-hover">
	<tr>
		<th> Reg #  </th>
    	<th> Name of Student </th>
    	<th> Name of Subject 	</th>
	</tr>
<?php 
if($conflict==1)
{
	foreach($conflict_arr as $con)
	{
		//print $con['stud_id'];
		$std=mysqli_query($conn,"select * from kiusc_students where id = '".$con['stud_id']."'");
		$std=mysqli_fetch_assoc($std);
		$cour=mysqli_query($conn,"select c.* from kiusc_courses c join kiusc_course_offered o on c.id=o.course_id 
		where o.id = ". $con['c_offer_id']);
		$cour=mysqli_fetch_assoc($cour);
	?>

	<tr>
		<td> <?php echo $std['reg_no']; ?> </td>
	    <td> <?php echo $std['name']; ?></td>
	    <td> <?php echo $cour['name']; ?>	</td>
	</tr>

<?php 
	}
}
echo'
</table>
<br><h1>Conflict Faculty</h1><br />
<table class="table table-striped table-hover">
	<tr>
		<th> Faculty Name  </th>
		<th> Name of Subject 	</th>
	</tr>';
if($teacher==1)
{
	foreach($teach_arr as $con)
	{
		$fac=mysqli_query($conn,"select * from s04cf_users where id = '".$con['fac_id']."'");
		$fac=mysqli_fetch_assoc($fac);
		$cour=mysqli_query($conn,"select c.* from kiusc_courses c join kiusc_course_offered o on c.id=o.course_id  
		where o.id  = '".$con['c_offer_id']."'");
		$cour=mysqli_fetch_assoc($cour);
	?>

<tr>
    <td> <?php echo $fac['name']; ?></td>
    <td> <?php echo $cour['name']; ?>	</td>
</tr>

<?php 
	}
}
echo'
</table>
								<br><h1>Conflict Rooms</h1><br />
<table class="table table-striped table-hover">
	<tr>
		<th> Block Name  </th>
		<th> Room Number  </th>
	    <th> Name of Subject 	</th>
	</tr>'; 
if($rom==1)
{
	foreach($room_arr as $con)
	{
		$rm=mysqli_query($conn,"select r.room_number as rm, b.block_name as nm from kiusc_rooms r join kiusc_blocks b on r.block_id = b.id 
		where r.id = '".$con['room_id']."'");
		$rm=mysqli_fetch_assoc($rm);
		$cour=mysqli_query($conn,"select c.* from kiusc_courses c join kiusc_course_offered o on c.id=o.course_id  
		where o.id  = '".$con['c_offer_id']."'");
		$cour=mysqli_fetch_assoc($cour);
	?>
	<tr>
		<td> <?php echo $rm['nm']; ?></td>
		<td> <?php echo $rm['rm']; ?></td>
		<td> <?php echo $cour['name']; ?>	</td>
	</tr>

<?php 
	}
}
echo'
</table>';
?>

<br><h1>Program Conflicts</h1><br />

<table class="table table-striped table-hover">
	<tr>
		<th> Course Name  </th>
	</tr>
<?php 
if($prog_con==1)
{
	foreach($prog_arr as $con)
	{
	?>
	<tr>
		<td> <?php echo $con['c_name']; ?> (in same program) </td>
	</tr>

<?php 
	}
}
echo'
</table>';

////////////////////////////////////////////////
///////// Functions /////////////////////////
///////////////////////////////////////////////


function examDropDown($exam,$room,$course, $sem, $prog, $dept)
{
echo '
<form name="exam_select" id="exam_select" action="" method="post">

<input type="hidden" name="department_id" value="'.$dept.'">
<input type="hidden" name="program_id" value="'.$prog.'">
<input type="hidden" name="semester_id" value="'.$sem.'">
<input type="hidden" name="course_id" value="'.$course.'">
<input type="hidden" name="room_id" value="'.$room.'">

<select name="exam" id="exam">';
 
$sel_exam=-1;
$ex_arr = array('Mid Term', 'Final Term');
foreach($ex_arr as $exm)
{
	$sel = "";
	if($exam == $exm)
	{
		$sel = " selected ";
		$sel_exam = $exm;
	}
	echo '<option value="'.$exm.'" '.$sel.'> '.$exm.' </option>';
}
			
echo'</select>
</form>';
 
?>

<script type="text/javascript">
$("#exam").change(function()
	{
		$("#exam_select").trigger("submit");
	}
);

</script>
<?php
return $sel_exam;
}



function showC_hoursSel($conn, $chours, $room,$course, $sem, $prog, $dep, $exam)
{
	$chours_re =  mysqli_query($conn,"select * from kiusc_datesheet where c_offer_id = '$course' and is_changed=0 and exam='$exam'");
	
echo '
<form name="chours_select" id="chours_select" action="" method="post">

<input type="hidden" name="department_id" value="'.$dep.'">
<input type="hidden" name="program_id" value="'.$prog.'">
<input type="hidden" name="semester_id" value="'.$sem.'">
<input type="hidden" name="course_id" value="'.$course.'">
<input type="hidden" name="room_id" value="'.$room.'">
<input type="hidden" name="exam" value="'.$exam.'">

<select name="chours_id" id="chours_id">';

 $sel_chours=-1;
while($row = mysqli_fetch_assoc($chours_re))
{
		$s="";
		if ($sel_chours==-1)
		{	
			$sel_chours=$row['id'];
			$s = " selected ";
		}
	   if ($chours==$row['id']) 
	   {
			$sel_chours=$row['id'];
			$s=" selected ";
	   }
	   
		echo '<option '.$s.' value="'.$row['id'].'">'.$row['period'].'</option>';
}

echo'</select>
 </form>';
 
?>

<script type="text/javascript">
$("#chours_id").change(function()
	{
		$("#chours_select").trigger("submit");
	}
);

</script>
<?php
return $sel_chours;
}

function showDaySel($conn, $day, $chours, $room,$course, $sem, $prog, $dep, $exam)
{
echo '
<form name="day_select" id="day_select" action="" method="post">

<input type="hidden" name="department_id" value="'.$dep.'">
<input type="hidden" name="program_id" value="'.$prog.'">
<input type="hidden" name="semester_id" value="'.$sem.'">
<input type="hidden" name="course_id" value="'.$course.'">
<input type="hidden" name="room_id" value="'.$room.'">
<input type="hidden" name="chours_id" value="'.$chours.'">
<input type="hidden" name="exam" value="'.$exam.'">

<select name="day_id" id="day_id">';
$sel_day=-1;
$days = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");

foreach($days as $d)
	{
			$s="";
		if ($sel_day==-1)
		{	
			$sel_day=$d;
			$s = " selected ";
		}
	   if ($day==$d) 
	   {
			$sel_day=$d;
			$s=" selected ";
	   }
		echo '<option '.$s.' value="'.$d.'">'.$d.'</option>';
	}

echo'</select>
 </form>'; 
?>

<script type="text/javascript">
$("#day_id").change(function()
	{
		$("#day_select").trigger("submit");
	}
);

</script>
<?php
return $sel_day;
}


function fillarray($conn, $hs, $ms, $he, $me)
{
//	 global $timaArray;  
	  //gvar::$timaArray =& $_GLOBALS['timaArray'];
	$x=$hs*2;
	if ($ms==30)
	$x=$x+1;
	
     $x1=$he*2;
	if ($me==30)
	$x1=$x1+1;

   
   	
	for($i=$x;$i<$x1;$i++)
	   {
	   gvar::$timaArray[$i] = 1;
	   }
	//echo $x.'---'.$x1;
	//echo "<br>";
	//for ($i=17;$i<35;$i++)
	//echo gvar::$timaArray[$i].",";
}

function fillfac($conn, $hs, $ms, $he, $me)
{
//	 global $timaArray;  
	  //gvar::$timaArray =& $_GLOBALS['timaArray'];
	$x=$hs*2;
	if ($ms==30)
	$x=$x+1;
	
     $x1=$he*2;
	if ($me==30)
	$x1=$x1+1;

   
   	
	for($i=$x;$i<$x1;$i++)
	   {
	   fac::$timeArray[$i] = 1;
	   }
	//echo $x.'---'.$x1;
	//echo "<br>";
	//for ($i=17;$i<35;$i++)
	//echo gvar::$timaArray[$i].",";
}

?>