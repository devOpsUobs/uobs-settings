<?php
$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/demo.css");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.easyui1.min.js");

$user_array = JFactory::getUser();
$user_id =$user_array->id;

$current_date = date("Y-m-d");
include "newfiles/conn.php";
include "common.php";
if(checkPermission(JFactory::getUser(),"timetable_setting")==0)
{
	echo "You cannot access this site";	
	return ;
}
class fac_second
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

$chours=-1;
if(isset($_POST['chours_id']))
{
	$chours=$_POST['chours_id'];	
}


$depart=-1;
if(isset($_POST['depart_id']))
{
	$depart=$_POST['depart_id'];
}

$program=-1;
if(isset($_POST['prog_id']))
{
	$program=$_POST['prog_id'];
}

$semester=-1;
if(isset($_POST['semes_id']))
{
	$semester=$_POST['semes_id'];
}

$co=-1;
if(isset($_POST['co_id']))
{
	$co=$_POST['co_id'];	

}

$period=-1;
if(isset($_POST['period_id']))
{
	$period=$_POST['period_id'];	

}

if (isset($_POST['insert']))
{
	$fac=$_POST['fac_id'];
	$fac_second=$_POST['fac_second_id'];
	$new_date=$_POST['newdate'];
	
	$date=mysqli_query($conn,"select * from kiusc_semesters where id = '$sem'");
	$date=mysqli_fetch_assoc($date); 
	
	$ch=mysqli_query($conn,"select * from kiusc_timetable where id = '$chours'");
	$ch=mysqli_fetch_assoc($ch); 	
	$per=mysqli_query($conn,"select * from kiusc_timetable where id = '$period'");
	$per=mysqli_fetch_assoc($per); 
	
	mysqli_query($conn,"UPDATE `kiusc_timetable` SET end_date = '$new_date', is_changed = 1, updated_by = '$user_id', updated_date = 'NOW()' where id = '$chours'");
	mysqli_query($conn,"UPDATE `kiusc_timetable` SET end_date = '$new_date', is_changed = 1, updated_by = '$user_id', updated_date = 'NOW()' where id = '$period'");
	
	$first = mysqli_query($conn,"select * from kiusc_timetable where id = '$chours'");
	$first = mysqli_fetch_assoc($first);
	$s_time_first=$first['start'];
	$e_time_first=$first['end'];
	$day=$first['day'];
	$room = $first['room_id'];
	
	$second = mysqli_query($conn,"select * from kiusc_timetable where id = '$period'");
	$second = mysqli_fetch_assoc($second);
	$s_time_second=$second['start'];
	$e_time_second=$second['end'];
	$day_second = $second['day'];
	$room_second = $second['room_id'];
	
	mysqli_query($conn,"INSERT INTO `kiusc_timetable` (`id`, `sem_id`, `c_offer_id`, `room_id`, `fac_id`, `start`, `end`, `day`, `period`, `start_date`, `end_date`, updated_by, updated_date) 
	VALUES (NULL, '$sem', '$course', '$room_second', '$fac', '$s_time_second', '$e_time_second', '$day_second', '".$ch['period']."', '$new_date', '". $date['final_term_end_date'] ."', '$user_id','NOW()')");
	
	//$new_period_id = mysqli_insert_id($conn);
	//mysqli_query($conn,"delete from kiusc_lectures where c_offer_id='$course' and period_id='$chours' and date >= '$new_date'");
	
	mysqli_query($conn,"INSERT INTO `kiusc_timetable` (`id`, `sem_id`, `c_offer_id`, `room_id`, `fac_id`, `start`, `end`, `day`, `period`, `start_date`, `end_date`, updated_by, updated_date) 
	VALUES (NULL, '$semester', '$co', '$room', '$fac_second', '$s_time_first', '$e_time_first', '$day', '".$per['period']."', '$new_date', '". $date['final_term_end_date'] ."', '$user_id','NOW()')");
	
	//$new_second_period_id = mysqli_insert_id($conn);
	//mysqli_query($conn,"delete from kiusc_lectures where c_offer_id='$co' and period_id='$period' and date >= '$new_date'");
	
		/*
		$sdate=date_create($new_date);
		date_modify($sdate,"next ".$day_second);
		$edate=date_create($date['final_term_end_date']);

		for($i = $sdate; $i <=$edate; $i = date_modify($i,"+1 week") )
		{
			$ins =  date_format($i,"Y-m-d");
			mysqli_query($conn,"INSERT INTO `kiusc_lectures` (`id`, `date`, `c_offer_id`, `period_id`) VALUES (NULL, '$ins', '$course', '$new_period_id')");
		}
		
		$sdate=date_create($new_date);
		
		$check_day = date_format($sdate, "l");
		if($check_day == $day)
		{
			$edate=date_create($date['final_term_end_date']);

			for($i = $sdate; $i <=$edate; $i = date_modify($i,"+1 week") )
			{
				$ins =  date_format($i,"Y-m-d");
				mysqli_query($conn,"INSERT INTO `kiusc_lectures` (`id`, `date`, `c_offer_id`, `period_id`) VALUES (NULL, '$ins', '$co', '$new_second_period_id')");
			}
		}
		else
		{
			date_modify($sdate,"next ".$day);
			$edate=date_create($date['final_term_end_date']);

			for($i = $sdate; $i <=$edate; $i = date_modify($i,"+1 week") )
			{
				$ins =  date_format($i,"Y-m-d");
				mysqli_query($conn,"INSERT INTO `kiusc_lectures` (`id`, `date`, `c_offer_id`, `period_id`) VALUES (NULL, '$ins', '$co', '$new_second_period_id')");
			}
		}
		*/
}


$conflict=1;
$std_conflict=1;
$teacher=1;
$teacher2=1;
$conflict_arr = array();
$std_conflict_arr = array();
$teach_arr = array();
$teach_arr2 = array();
$s_time_first="";
$e_time_first="";
$s_time_second="";
$e_time_second="";
//$day="";
//$day_second = "";
$invalid_date = 0;
if (isset($_POST['check']))
{
	$period=$_POST['period_id'];
	
	$fac=$_POST['fac_id'];
	$fac_second=$_POST['fac_second_id'];
	$new_date=$_POST['newdate'];

	echo $new_date;
	
	$sem_dates = mysqli_query($conn, "select * from kiusc_semesters where id = '$sem'");
	$sem_dates = mysqli_fetch_assoc($sem_dates);
	
	// if($new_date < $sem_dates['start_date'] or $new_date > $sem_dates['final_term_date'])
	// {
	// 	$invalid_date = 1;
	// }
	
	$first_con = mysqli_query($conn,"select * from kiusc_timetable where id = '$chours'");
	$first_con = mysqli_fetch_assoc($first_con);
	$s_time_first=$first_con['start'];
	$e_time_first=$first_con['end'];
	$day=$first_con['day'];
	
	$second_con = mysqli_query($conn,"select * from kiusc_timetable where id = '$period'");
	$second_con = mysqli_fetch_assoc($second_con);
	$s_time_second=$second_con['start'];
	$e_time_second=$second_con['end'];
	$day_second = $second_con['day'];
	
	
	$periods = mysqli_query($conn,"select * from kiusc_timetable where sem_id='$sem' and c_offer_id='$course' and is_changed=0");
	$periods = mysqli_fetch_assoc($periods);
	$merge_cf_id1 = $periods['merge_offer_id'];
	
	$periods = mysqli_query($conn,"select * from kiusc_timetable where sem_id='$semester' and c_offer_id='$co' and is_changed=0");
	$periods = mysqli_fetch_assoc($periods);
	$merge_cf_id2 = $periods['merge_offer_id'];
	
	$temp_arr = StudentChangeConflict($conn, $sem, $course, $s_time_second, $e_time_second, $day_second, $new_date);
	$conflict_arr = $temp_arr['con_arr'];
	$conflict = $temp_arr['is_con'];
	
	if($merge_cf_id1 != 0)
	{
		$temp_arr = StudentChangeConflict($conn, $sem, $merge_cf_id1, $s_time_second, $e_time_second, $day_second, $new_date);
		$conflict_arr2 = $temp_arr['con_arr'];
		
		$conflict_arr=array_merge($conflict_arr,$conflict_arr2);
		if($conflict == 0)
			$conflict = $temp_arr['is_con'];
	}

	
	$temp2_arr = TeacherChangeConflict($conn, $sem, $course, $fac, $s_time_second, $e_time_second, $day_second, $new_date);
	$teach_arr = $temp2_arr['con_ar'];
	$teacher = $temp2_arr['is_con'];
	
	$temp3_arr = StudentChangeConflict($conn, $semester, $co, $s_time_first, $e_time_first, $day, $new_date);
	$std_conflict_arr = $temp3_arr['con_arr'];
	$std_conflict = $temp3_arr['is_con'];
	
	if($merge_cf_id2 != 0)
	{
		$temp_arr = StudentChangeConflict($conn, $semester, $merge_cf_id2, $s_time_first, $e_time_first, $day, $new_date);
		$conflict_arr22 = $temp_arr['con_arr'];
		
		$std_conflict_arr=array_merge($std_conflict_arr,$conflict_arr22);
		if($std_conflict == 0)
			$std_conflict = $temp_arr['is_con'];
	}
	
	$temp4_arr = TeacherChangeConflict($conn, $semester, $co, $fac_second, $s_time_first, $e_time_first, $day, $new_date);
	$teach_arr2= $temp4_arr['con_ar'];
	$teacher2 = $temp4_arr['is_con'];	

	$temp5_arr = programConflict($conn, $sem, $prog, $s_time_second, $e_time_second, $day_second);
	$prog_arr1 = $temp5_arr['con_arr'];
	$prog_con1 = $temp5_arr['is_con'];	
	
	$temp6_arr = programConflict($conn, $semester, $program, $s_time_first, $e_time_first, $day);
	$prog_arr2 = $temp6_arr['con_arr'];
	$prog_con2 = $temp6_arr['is_con'];	
}

?>

					<br><h1>Swap Periods</h1><br>

<?php
echo '
<table class="table table-striped table-hover">
	<tr>
		<td>  1st Period </td>
		<td> 2nd period </td>
	</tr>
	<tr>
		<td> ';$dept = showDepartmentSel($conn, $dept);
	echo '</td>
		<td>';
			$depart = swapDepartmentSel($conn, $depart, $chours, $course, $sem, $prog, $dept);
echo '	</td>
	</tr>';

echo '
	<tr>
		<td>';
	$prog = showProgramSel($conn, $prog, $dept);
echo '	</td>
		<td>'; $program = swapProgramSel($conn, $program, $depart, $chours, $course, $sem, $prog, $dept);
		echo '</td>
	</tr>';

echo '
	<tr>
		<td>';
		$sem = showSemesterSel($conn, $sem, $prog, $dept);
echo '	</td>
		<td>';
				$semester = swapSemesterSel($conn, $semester, $program, $depart, $chours, $course, $sem, $prog, $dept);
		echo '</td>
	</tr>';

echo '
	<tr>
		<td>';
			$course = showCourseSel($conn, $course, $sem, $prog, $dept);
			$fac_f=mysqli_query($conn,"select u.* from s04cf_users u join kiusc_course_offered o on o.fac_id= u.id where o.id='$course'");
			$fac_f=mysqli_fetch_assoc($fac_f);
			$fac = $fac_f['id'];
			

	echo '	</td>
        		<td> ';
				$co = swapCourseSel($conn, $co, $semester, $program, $depart, $chours, $course, $sem, $prog, $dept);
				$fac_sec=mysqli_query($conn,"select u.* from s04cf_users u join kiusc_course_offered o on o.fac_id= u.id where o.id='$co'");
				$fac_sec=mysqli_fetch_assoc($fac_sec);
				$fac_second= $fac_sec['id'];
echo '	</td>
	</tr>


	<tr>';
		 /*
			$a='';
			$b='';
			$per=mysql_query ("select * from kiusc_timetable where c_offer_id = '$course'");
			$per=mysqli_fetch_assoc($per);
		 	if($per['start']!=0)
			{
				$a = "style='background-color:#C45811'";
				
				$b = "Assigned";
			}
			///<td <?php echo $a;?> >
			*/
			?>
			<td>
				<?php	$chours = showC_hoursSel($conn, $chours, $course, $sem, $prog, $dept);
				//echo $b;
		 echo '
		</td>
		<td> ';
		$period = swapC_hoursSel($conn, $period, $co, $semester, $program, $depart, $chours, $course, $sem, $prog, $dept);
		echo ' </td>
	</tr>
	<tr>
		<td>'; ?>
		<input type="text" name="facname" value="<?php echo $fac_f['name']; ?>" readonly="readonly" /> 
		<?php
        echo '</td>
    	<td>';
		?>
        
   	  	<input type="text" name="fac_second_name" value="<?php echo $fac_sec['name']; ?>" readonly="readonly" />
	 <?php echo '
	 	</td>
	</tr>';
?>
	<?php 
 	echo '<form name="submit11" id="submit11" action="" method="post">
	<input type="hidden" name="department_id" value="'.$dept.'">
	<input type="hidden" name="program_id" value="'.$prog.'">
	<input type="hidden" name="semester_id" value="'.$sem.'">
	<input type="hidden" name="course_id" value="'.$course.'">
	<input type="hidden" name="chours_id" value="'.$chours.'">
	<input type="hidden" name="depart_id" value="'.$depart.'">
	<input type="hidden" name="prog_id" value="'.$program.'">
	<input type="hidden" name="semes_id" value="'.$semester.'">
	<input type="hidden" name="co_id" value="'.$co.'">
	<input type="hidden" name="period_id" value="'.$period.'">
	<input type="hidden" name="fac_id" value="'.$fac.'">
	<input type="hidden" name="fac_second_id" value="'.$fac_second.'">
	';?>
    <tr> 
		<td colspan="2">
			Start Date <input type="date" name="newdate" value="<?php echo $current_date ?>" required/>
    	</td>
	</tr>
	<tr>
		<td colspan="2">
<?php
		if($course!=-1)
       		echo ' <input type="submit" value="Check"  name ="check"/>';
		
		if($invalid_date == 1)
		{
			echo '<font color="red"> Invalid date! please select date within same semester </font>';
		}
		
		//if($conflict==0 && $std_conflict==0 && $teacher==0 && $teacher2==0 && $invalid_date==0)
		if($teacher==0 && $teacher2==0 && $invalid_date==0)
		{
    		echo '<input type="submit" value="Insert"  name ="insert"/>';
		}
?>
    	</td>
	</tr> 
</table>
</form>

							<br><h1>Reserved Times</h1><br />

<?php
	$first_con = mysqli_query($conn,"select * from kiusc_timetable where id = '$chours'");
	$first_con = mysqli_fetch_assoc($first_con);
	$day=$first_con['day'];
	
	$second_con = mysqli_query($conn,"select * from kiusc_timetable where id = '$period'");
	$second_con = mysqli_fetch_assoc($second_con);
	$day_second = $second_con['day'];

		$re=mysqli_query($conn,"select HOUR(start) as hs, MINUTE(start) as ms,  HOUR(end) as he, MINUTE(end) as me from kiusc_timetable 
					where sem_id= '$sem'  and fac_id='$fac' and day='$day' and is_changed=0");
		while($f=mysqli_fetch_assoc($re))
		{
			fillfac($conn, $f['hs'], $f['ms'], $f['he'] , $f['me']);
		}
?>
<table border="1px">
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
		<td colspan="24">&nbsp;</td>
	</tr>
<?php
//////////////////////////room id????
		$re=mysqli_query($conn,"select HOUR(start) as hs, MINUTE(start) as ms,  HOUR(end) as he, MINUTE(end) as me from kiusc_timetable 
					where sem_id= '$sem'  and fac_id='$fac_second' and day='$day_second' and is_changed=0");
		while($f=mysqli_fetch_assoc($re))
		{
			fillfac_second($conn, $f['hs'], $f['ms'], $f['he'] , $f['me']);
		}
?>
	<tr>
		<td colspan="2">
    		<?php
			$se=mysqli_query($conn,"select * from s04cf_users where id='$fac_second'");
			$fe=mysqli_fetch_assoc($se);
			print $fe['name'];
			?>
		</td>
<?php

for ($i=18; $i<40;$i++)
{
 if (fac_second::$timaArray[$i]==1)
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
								<br><h1>Conflict Students of First Faculty</h1><br />

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
?>
</table>
								<br><h1>Conflict Students of Sceond Faculty</h1><br />

<table class="table table-striped table-hover">
	<tr>
		<th> Reg #  </th>
    	<th> Name of Student </th>
    	<th> Name of Subject 	</th>
	</tr>
<?php 
if($std_conflict==1)
{
	foreach($std_conflict_arr as $con)
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
?>
</table>

								<br><h1>Conflict First Faculty</h1><br />
<table class="table table-striped table-hover">
	<tr>
		<th> Faculty Name  </th>
		<th> Name of Subject 	</th>
	</tr>
<?php
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
?>
</table>

								<br><h1>Conflict Sceond Faculty</h1><br />
<table class="table table-striped table-hover">
	<tr>
		<th> Faculty Name  </th>
		<th> Name of Subject 	</th>
	</tr>
<?php
if($teacher2==1)
{
	foreach($teach_arr2 as $con)
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
</table>';

?>

<br><h1>Program1 Conflicts</h1><br />

<table class="table table-striped table-hover">
	<tr>
		<th> Course Name  </th>
	</tr>
<?php 
if($prog_con1==1)
{
	foreach($prog_arr1 as $con)
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

?>

<br><h1>Program2 Conflicts</h1><br />

<table class="table table-striped table-hover">
	<tr>
		<th> Course Name  </th>
	</tr>
<?php 
if($prog_con2==1)
{
	foreach($prog_arr2 as $con)
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


function showC_hoursSel($conn, $chours, $course, $sem, $prog, $dep)
{
	$chours_re =  mysqli_query($conn,"select t.*,r.room_number from kiusc_timetable t join kiusc_rooms r on r.id = t.room_id where c_offer_id = '$course' and is_changed=0");
echo '
<form name="chours_select" id="chours_select" action="" method="post">

<input type="hidden" name="department_id" value="'.$dep.'">
<input type="hidden" name="program_id" value="'.$prog.'">
<input type="hidden" name="semester_id" value="'.$sem.'">
<input type="hidden" name="course_id" value="'.$course.'">

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

function swapDepartmentSel($conn, $depart, $chours, $course, $sem, $prog, $dep)
{
	$depart_re =  mysqli_query($conn,"select * from kiusc_departments");
	 
echo '
<form name="depart_select" id="depart_select" action="" method="post">
<input type="hidden" name="department_id" value="'.$dep.'">
<input type="hidden" name="program_id" value="'.$prog.'">
<input type="hidden" name="semester_id" value="'.$sem.'">
<input type="hidden" name="course_id" value="'.$course.'">
<input type="hidden" name="chours_id" value="'.$chours.'">

<select name="depart_id" id="depart_id">';

 $sel_depart=-1;
while($row = mysqli_fetch_assoc($depart_re))
{
		$s="";
		if ($sel_depart==-1)
		{	
			$sel_depart=$row['id'];
			$s = " selected ";
		}
	   if ($depart==$row['id']) 
	   {
			$sel_depart=$row['id'];
			$s=" selected ";
	   }
	   
		echo '<option '.$s.' value="'.$row['id'].'">'.$row['name'].'</option>';
}

echo'</select>
 </form>';
 
?>

<script type="text/javascript">
$("#depart_id").change(function()
	{
		$("#depart_select").trigger("submit");
	}
);

</script>

<?php
return $sel_depart;
}


function swapProgramSel($conn, $program, $depart, $chours, $course, $sem, $prog, $dep)
{
	
	$program_re =  mysqli_query($conn,"select p.* from kiusc_programs p join kiusc_departments d on d.id=p.dep_id where dep_id='$depart' ORDER BY id DESC");
	 
echo '
<form name="program_select" id="program_select" action="" method="post">
<input type="hidden" name="department_id" value="'.$dep.'">
<input type="hidden" name="program_id" value="'.$prog.'">
<input type="hidden" name="semester_id" value="'.$sem.'">
<input type="hidden" name="course_id" value="'.$course.'">
<input type="hidden" name="chours_id" value="'.$chours.'">
<input type="hidden" name="depart_id" value="'.$depart.'">

<select name="prog_id" id="prog_id">';

 $sel_program=-1;
while($row = mysqli_fetch_assoc($program_re))
{
		$s="";
		if ($sel_program==-1)
		{	
			$sel_program=$row['id'];
			$s = " selected ";
		}
	   if ($program==$row['id']) 
	   {
			$sel_program=$row['id'];
			$s=" selected ";
	   }
	   
		echo '<option '.$s.' value="'.$row['id'].'">'.$row['name'].' ('.$row['session'].')'.$row['group'].'</option>';
}

echo'</select>
 </form>';
 
?>

<script type="text/javascript">
$("#prog_id").change(function()
	{
		$("#program_select").trigger("submit");
	}
);

</script>

<?php
return $sel_program;
}

function swapSemesterSel($conn, $semester, $program, $depart, $chours, $course, $sem, $prog, $dep)
{
	$semes_re =  mysqli_query($conn,"select * from kiusc_semesters ORDER BY id DESC");
echo '
<form name="semester_select" id="semester_select" action="" method="post">
<input type="hidden" name="department_id" value="'.$dep.'">
<input type="hidden" name="program_id" value="'.$prog.'">
<input type="hidden" name="semester_id" value="'.$sem.'">
<input type="hidden" name="course_id" value="'.$course.'">
<input type="hidden" name="chours_id" value="'.$chours.'">
<input type="hidden" name="depart_id" value="'.$depart.'">
<input type="hidden" name="prog_id" value="'.$program.'">

<select name="semes_id" id="semes_id">';

 $sel_semester=-1;
while($row = mysqli_fetch_assoc($semes_re))
{
	$s="";
	if ($sel_semester==-1)
	{	
		$sel_semester=$row['id'];
		$s = " selected ";		
	}
	if ($semester==$row['id']) 
	{
		$sel_semester=$row['id'];
		$s=" selected ";
	}
   
	echo '<option '.$s.' value="'.$row['id'].'">'.$row['sem_name'].'</option>';
}

echo'</select>
 </form>';

?>

<script type="text/javascript">
$("#semes_id").change(function()
	{
		$("#semester_select").trigger("submit");
	}
);

</script>

<?php
return $sel_semester;
}


function swapCourseSel($conn, $co, $semester, $program, $depart, $chours, $course, $sem, $prog, $dep)
{
	$co_re =  mysqli_query($conn,"select c.*, o.id as cf_id from kiusc_courses c join kiusc_course_offered o on c.id = o.course_id 
	where prog_id ='$program' and sem_id ='$semester'");
	
echo '
<form name="co_select" id="co_select" action="" method="post">
<input type="hidden" name="department_id" value="'.$dep.'">
<input type="hidden" name="program_id" value="'.$prog.'">
<input type="hidden" name="semester_id" value="'.$sem.'">
<input type="hidden" name="course_id" value="'.$course.'">
<input type="hidden" name="chours_id" value="'.$chours.'">
<input type="hidden" name="depart_id" value="'.$depart.'">
<input type="hidden" name="prog_id" value="'.$program.'">
<input type="hidden" name="semes_id" value="'.$semester.'">

<select name="co_id" id="co_id">';

 $sel_co=-1;
while($row = mysqli_fetch_assoc($co_re))
{
		$s="";
		if ($sel_co==-1)
		{	
			$sel_co=$row['cf_id'];
			$s = " selected ";
		}
	   if ($co==$row['cf_id']) 
	   {
			$sel_co=$row['cf_id'];
			$s=" selected ";
	   }
	   
		echo '<option '.$s.' value="'.$row['cf_id'].'">'.$row['name'].'</option>';
}

echo'</select>
 </form>';
 
?>

<script type="text/javascript">
$("#co_id").change(function()
	{
		$("#co_select").trigger("submit");
	}
);

</script>

<?php
return $sel_co;
}

function swapC_hoursSel($conn, $period, $co, $semester, $program, $depart, $chours, $course, $sem, $prog, $dep)
{
	$chours_re =  mysqli_query($conn,"select t.*,r.room_number from kiusc_timetable t join kiusc_rooms r on r.id = t.room_id 
	where c_offer_id = '$co' and is_changed=0");
echo '
<form name="period_select" id="period_select" action="" method="post">
<input type="hidden" name="department_id" value="'.$dep.'">
<input type="hidden" name="program_id" value="'.$prog.'">
<input type="hidden" name="semester_id" value="'.$sem.'">
<input type="hidden" name="course_id" value="'.$course.'">
<input type="hidden" name="chours_id" value="'.$chours.'">
<input type="hidden" name="depart_id" value="'.$depart.'">
<input type="hidden" name="prog_id" value="'.$program.'">
<input type="hidden" name="semes_id" value="'.$semester.'">
<input type="hidden" name="co_id" value="'.$co.'">

<select name="period_id" id="period_id">';

 $sel_period=-1;
while($row = mysqli_fetch_assoc($chours_re))
{
		$s="";
		if ($sel_period==-1)
		{	
			$sel_period=$row['id'];
			$s = " selected ";
		}
	   if ($period==$row['id']) 
	   {
			$sel_period=$row['id'];
			$s=" selected ";
	   }
	   
		echo '<option '.$s.' value="'.$row['id'].'">'.$row['day'].'  ('.$row['period'].'hrs) - '.$row['room_number'].'</option>';
}

echo'</select>
 </form>';
 
?>

<script type="text/javascript">
$("#period_id").change(function()
	{
		$("#period_select").trigger("submit");
	}
);

</script>
<?php
return $sel_period;
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

function fillfac_second($conn, $hs, $ms, $he, $me)
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
	   fac_second::$timaArray[$i] = 1;
	   }
	//echo $x.'---'.$x1;
	//echo "<br>";
	//for ($i=17;$i<35;$i++)
	//echo gvar::$timaArray[$i].",";
}
?>