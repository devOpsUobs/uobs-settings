<?php
$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/demo.css");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.easyui1.min.js");

include "newfiles/conn.php";
include "common.php";

$user_array = JFactory::getUser();
$user_id =$user_array->id;

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
$chours=-1;
if(isset($_POST['chours_id']))
{
	$chours=$_POST['chours_id'];	

}

$day=-1;
if(isset($_POST['day_id']))
{
	$day=$_POST['day_id'];	

}
$current_date = date("Y-m-d");
$change_room = 0;
if (isset($_POST['insert']))
{
	$s=$_POST['start'];
	$e=$_POST['end'];
	$fac=$_POST['fac_id'];
	$new_date=$_POST['newdate'];
	$change_room=$_POST['change_room'];

	$s=date("H:i", strtotime("$s"));
	$e=date("H:i", strtotime("$e"));
	
	$date=mysqli_query($conn,"select * from kiusc_semesters where id = '$sem'");
	$date=mysqli_fetch_assoc($date); 
	
	$pers=mysqli_query($conn,"select * from kiusc_timetable where id = '$chours'");
	$per=mysqli_fetch_assoc($pers); 

	if($change_room == 1)
	{
		mysqli_query($conn,"UPDATE `kiusc_timetable` SET room_id = '$room', updated_by = '$user_id', updated_date = 'NOW()' where id = '$chours'");
	}
	else
	{
	mysqli_query($conn,"UPDATE `kiusc_timetable` SET end_date = '$new_date', is_changed = 1 where id = '$chours'");
	
	mysqli_query($conn,"INSERT INTO `kiusc_timetable` (`id`, `sem_id`, `c_offer_id`, `room_id`, `fac_id`, `start`, `end`, `day`, `period`, `start_date`, `end_date`, updated_by, updated_date) 
	VALUES (NULL, '$sem', '$course', '$room', '$fac', '$s', '$e', '$day', '".$per['period']."', '$new_date', '". $date['final_term_date'] ."', '$user_id','NOW()')");
	}
	$conflict=1;
	$teacher=1;
	$rom=1;
	$change_room = 0;
	
	//$new_period_id = mysqli_insert_id($conn);
	
	/*
	mysqli_query($conn,"delete from kiusc_lectures where c_offer_id='$course' and period_id='$chours' and date >= '$new_date'");
	

		$edate=date_create($date['final_term_date']);
		$sdate = date_create($new_date);
		$check_day = date_format($sdate, "l");
		if($check_day == $day)
		{

			for($i = $sdate; $i <=$edate; $i = date_modify($i,"+1 week") )
			{
				$ins =  date_format($i,"Y-m-d");
				mysqli_query($conn,"INSERT INTO `kiusc_lectures` (`id`, `date`, `c_offer_id`, `period_id`) VALUES (NULL, '$ins', '$course', '$new_period_id')");
			}
		}
		else
		{
			date_modify($sdate,"next ".$day);
			for($i = $sdate; $i <=$edate; $i = date_modify($i,"+1 week") )
			{
				$ins =  date_format($i,"Y-m-d");
				mysqli_query($conn,"INSERT INTO `kiusc_lectures` (`id`, `date`, `c_offer_id`, `period_id`) VALUES (NULL, '$ins', '$course', '$new_period_id')");
			}
		}
		*/
}
$conflict=1;
$teacher=1;
$rom=1;
$conflict_arr = array();
$teach_arr = array();
$room_arr = array();
$s_time="";
$e_time="";
$invalid_date = 0;
if(isset($_POST['change_room']))
{
	$s_time=$_POST['start'];
	$e_time=$_POST['end'];
	$fac=$_POST['fac_id'];
	$new_date=$_POST['newdate'];
	$change_room = $_POST['change_room'];
	$conflict=0;
	$teacher=0;
	$rom=0;
	$temp3_arr = RoomChangeConflict($conn, $sem, $course, $room, $s_time, $e_time, $day, $new_date);
	$room_arr = $temp3_arr['con_arr'];
	$rom = $temp3_arr['is_con'];
	echo $rom;
}
if (isset($_POST['check']) && !isset($_POST['change_room']))
{
	$s_time=$_POST['start'];
	$e_time=$_POST['end'];
	$fac=$_POST['fac_id'];
	$new_date=$_POST['newdate'];
	
	$periods = mysqli_query($conn,"select * from kiusc_timetable where sem_id='$sem' and c_offer_id='$course' and is_changed=0");
	$period = mysqli_fetch_assoc($periods);
	
	$merge_cf_id = $period['merge_offer_id'];
	
	
	$sem_dates = mysqli_query($conn, "select * from kiusc_semesters where id = '$sem'");
	$sem_dates = mysqli_fetch_assoc($sem_dates);
	
	// if($new_date < $sem_dates['start_date'] or $new_date > $sem_dates['final_term_date'])
	// {
	// 	$invalid_date = 1;
	// }
	
	$temp_arr = StudentChangeConflict($conn, $sem, $course, $s_time, $e_time, $day, $new_date);
	$conflict_arr = $temp_arr['con_arr'];
	$conflict = $temp_arr['is_con'];
	
	if($merge_cf_id != 0)
	{
		$temp_arr = StudentChangeConflict($conn, $sem, $merge_cf_id, $s_time, $e_time, $day, $new_date);
		$conflict_arr2 = $temp_arr['con_arr'];
		
		$conflict_arr=array_merge($conflict_arr,$conflict_arr2);
		if($conflict == 0)
			$conflict = $temp_arr['is_con'];
	}	
	$temp2_arr = TeacherChangeConflict($conn, $sem, $course, $fac, $s_time, $e_time, $day, $new_date);
	$teach_arr = $temp2_arr['con_ar'];
	$teacher = $temp2_arr['is_con'];
	
	$temp3_arr = RoomChangeConflict($conn, $sem, $course, $room, $s_time, $e_time, $day, $new_date);
	$room_arr = $temp3_arr['con_arr'];
	$rom = $temp3_arr['is_con'];
	
	$temp4_arr = programConflict($conn, $sem, $prog, $s_time, $e_time, $day);
	$prog_arr = $temp4_arr['con_arr'];
	$prog_con = $temp4_arr['is_con'];
	
	
	if($merge_cf_id != 0)
	{
		$prog2 = mysqli_query($conn, "select * from kiusc_course_offered where id = '$merge_cf_id'");
		$prog2 = mysqli_fetch_assoc($prog2);
		
		$temp4_arr = programConflict($conn, $sem, $prog, $s_time, $e_time, $day);
		$prog_arr2 = $temp4_arr['con_arr'];
		
		$prog_arr=array_merge($prog_arr,$prog_arr2);
		if($prog_con == 0)
			$prog_con = $temp4_arr['is_con'];	
	}
	
}

?>


<?php
echo '
<table  class="table table-striped table-hover">
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
		<td> Select Course to change: </td>
		<td>';
			$course = showCourseSel($conn, $course, $sem, $prog, $dept);
			$se=mysqli_query($conn,"select u.* from s04cf_users u join kiusc_course_offered o on o.fac_id= u.id where o.id='$course'");
			$fe=mysqli_fetch_assoc($se);
			$fac = $fe['id'];

?>
		</td>
	</tr>
<?php
echo '
	<tr>
		<td> Select New Room : </td>
		<td>';
	$room = showRoomSel($conn, $room,$course, $sem, $prog, $dept);
echo '
		</td>
	</tr>
	<tr>
		<td> Select Period to change : </td>';
		?>
		<td>
				<?php	$chours = showC_hoursSel($conn, $chours,$room,$course, $sem, $prog, $dept);
		 echo '
		</td>
	</tr>
	<tr>
		<td> Faculty Name </td>
    	<td>';
		?>
        
   	  	<input type="text" name="facname" value="<?php echo $fe['name']; ?>" readonly="readonly" />
	 <?php echo '
	 	</td>
	</tr>
	<tr>
		<td> Select New Day </td>
    	<td>';
   	  		$day= showDaySel($conn, $day,$chours, $room,$course, $sem, $prog, $dept);
	  		echo '
		</td>';
?>
  
	<?php 
 	echo '<form name="submit11" id="submit11" action="" method="post">
	<input type="hidden" name="department_id" value="'.$dept.'">
	<input type="hidden" name="program_id" value="'.$prog.'">
	<input type="hidden" name="semester_id" value="'.$sem.'">
	<input type="hidden" name="course_id" value="'.$course.'">
	<input type="hidden" name="room_id" value="'.$room.'">
	<input type="hidden" name="chours_id" value="'.$chours.'">
	<input type="hidden" name="day_id" value="'.$day.'"> 
	<input type="hidden" name="fac_id" value="'.$fac.'">';?>
	<tr> 
		<td>
			Start Time <input type="time" name="start" value="<?php echo $s_time; ?>" required/>
    	</td>
		<td>
    		 End Time <input type="time" name="end" value="<?php echo $e_time; ?>" required/>
    	</td>
	</tr>
    <tr> 
		<td colspan="2">
			Start Date <input type="date" name="newdate" value="<?php echo $current_date; ?>" required/>
    	</td>
	</tr>
	<?php
	$checked="";
	if($change_room == 1)
		$checked = "checked";
	?>
    <tr> 
		<td>Change room</td>
		<td>
			<input type="checkbox" name="change_room" value="1" style="width:20px;height:20px" <?php echo $checked ?>>
    	</td>
	</tr>
	<tr>
		<td colspan="2">
<?php
		if($course!=-1)
       		echo ' <input type="submit" value="Check"  name ="check" class="btn2 success"/>';
	

		// if($invalid_date == 1)
		// {
		// 	echo '<font color="red"> Invalid date! please select date within same semester </font>';
		// }
		if($rom==0 && $teacher==0 && $invalid_date==0 && $prog_con==0)
		{
    		echo '<input type="submit" value="Insert"  name ="insert" class="btn2 success"/>';
		}
?>
    	</td>
	</tr> 
</table>
</form>
<?php
	$re=mysqli_query($conn,"select HOUR(start) as hs, MINUTE(start) as ms,  HOUR(end) as he, MINUTE(end) as me from kiusc_timetable 
					where sem_id= '$sem' and room_id = '$room' and day = '$day' and is_changed=0");
	while($r=mysqli_fetch_assoc($re))
	{
		fillarray($conn, $r['hs'], $r['ms'], $r['he'] , $r['me']);
	}?>
    
					<br><h1>Reserved Times</h1><br />

<table cellpadding="3px" cellspacing="2px" width="650" border="1" align="center" style="bordercolor:"#003300""  class="table table-striped table-hover">
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
//////////////////////////room id????
		$re=mysqli_query($conn,"select HOUR(start) as hs, MINUTE(start) as ms,  HOUR(end) as he, MINUTE(end) as me from kiusc_timetable 
					where sem_id= '$sem'  and fac_id='$fac' and day='$day' and is_changed=0");
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

<table>
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
		$std=mysqli_query($conn,"select * from kiusc_students where id = '".$con['stud_id']."'");
		$std=mysqli_fetch_assoc($std);
		$cour=mysqli_query($conn,"select c.* from kiusc_courses c join kiusc_course_offered o on c.id=o.course_id  
		where o.id  = '".$con['c_offer_id']."'");
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
<table>
	<tr>
		<th> Faculty Name  </th>
		<th> Name of Subject 	</th>
	</tr>';

if($teacher==1)
{
	foreach($teach_arr as $con)
	{
		//print_r ($con);
		//echo "select * from kiusc_students where id = '".$con['stud_id']."'";
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
<table>
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

<table>
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

function showC_hoursSel($conn, $chours, $room,$course, $sem, $prog, $dep)
{
	$chours_re =  mysqli_query($conn,"select t.*,r.room_number from kiusc_timetable t join kiusc_rooms r on r.id = t.room_id where c_offer_id = '$course' and is_changed=0");
echo '
<form name="chours_select" id="chours_select" action="" method="post">

<input type="hidden" name="department_id" value="'.$dep.'">
<input type="hidden" name="program_id" value="'.$prog.'">
<input type="hidden" name="semester_id" value="'.$sem.'">
<input type="hidden" name="course_id" value="'.$course.'">
<input type="hidden" name="room_id" value="'.$room.'">

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
	   
		echo '<option '.$s.' value="'.$row['id'].'">'.$row['day'].'  ('.$row['period'].'hrs) - '.$row['room_number'].'</option>';
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

function showDaySel($conn, $day, $chours, $room,$course, $sem, $prog, $dep)
{
echo '
<form name="day_select" id="day_select" action="" method="post">

<input type="hidden" name="department_id" value="'.$dep.'">
<input type="hidden" name="program_id" value="'.$prog.'">
<input type="hidden" name="semester_id" value="'.$sem.'">
<input type="hidden" name="course_id" value="'.$course.'">
<input type="hidden" name="room_id" value="'.$room.'">
<input type="hidden" name="chours_id" value="'.$chours.'">

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