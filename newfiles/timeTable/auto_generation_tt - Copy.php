<?php
$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/demo.css");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.easyui1.min.js");

include "newfiles/conn.php";
include "common.php";

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

$sem=-1;
if(isset($_POST['semester_id']))
{
	$sem=$_POST['semester_id'];
}


$conflict=1;
$teacher=1;
$rom=1;
$prog_con=1;
$conflict_arr = array();
$teach_arr = array();
$room_arr = array();
$s_time="";
$e_time="";
if (isset($_POST['generate']))
{
$days = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");

	
$programs=mysqli_query($conn,"select * from kiusc_programs where dep_id='$dept'");
while($program=mysqli_fetch_assoc($programs))
{
	$prog=$program['id'];
	$courses=mysqli_query($conn,"select * from kiusc_course_offered where prog_id='".$program['id']."' and sem_id='$sem'");
	while($corse=mysqli_fetch_assoc($courses))
	{
		$course=$corse['id'];
		$periods = mysqli_query($conn,"select * from kiusc_timetable where sem_id='$sem' and c_offer_id='$course' and is_changed=0");
		while($period = mysqli_fetch_assoc($periods))
		{
			$merge_cf_id = $period['merge_offer_id'];
			$id=$period['id'];
			$fac=$period['fac_id'];
			
			$ex = mysqli_query($conn,"SELECT * FROM `kiusc_timetable` WHERE `id`= '$id'");
			$ex = mysqli_fetch_assoc($ex);					
			if($ex['day'] != '')
			{
				continue;
			}
			
			
			//$room=$period['room_id'];
            $period=$period['period'];
			$rooms=mysqli_query($conn,"select r.* from kiusc_rooms r join kiusc_room_program rp on r.id = rp.room_id where rp.prog_id='".$program['id']."' and sem_id=".$sem);
			//echo "select r.* from kiusc_rooms r join kiusc_room_program rp on r.id = rp.room_id where rp.prog_id='".$program['id']."' and sem_id=".$sem;
			//exit;
			$found=0;
			while($rm=mysqli_fetch_assoc($rooms))
			{
				if ($found==1)
							break;
				$room=$rm['id'];
				if($merge_cf_id == 0)
				{
					$times=mysqli_query($conn,"select * from kiusc_timetable_setting where prog_id='".$program['id']."'");	
					$time = mysqli_fetch_assoc($times);
					
					$s_time=$time['start_time'];
					$e_time=$time['end_time'];
					
					$friday_break_start = $time['friday_break_start'];
					$friday_break_end = $time['friday_break_end'];
				}
				else
				{
					$time1=mysqli_query($conn,"select * from kiusc_timetable_setting where prog_id='".$program['id']."'");	
					$time1 = mysqli_fetch_assoc($time1);
					
					$time2=mysqli_query($conn,"SELECT t.* FROM `kiusc_timetable_setting` t join kiusc_course_offered cf 
					on t.prog_id = cf.prog_id WHERE cf.id = '$merge_cf_id'");	
					$time2 = mysqli_fetch_assoc($time2);
					
					if(strtotime($time1['start_time']) <= strtotime($time2['start_time']))
						$s_time=$time2['start_time'];
					else
						$s_time=$time1['start_time'];
					
					if(strtotime($time1['end_time']) <= strtotime($time2['end_time']))
						$e_time=$time1['end_time'];
					else
						$e_time=$time2['end_time'];
					
					$friday_break_start = $time1['friday_break_start'];
					$friday_break_end = $time1['friday_break_end'];
					
					$friday_break_start2 = $time2['friday_break_start'];
					$friday_break_end2 = $time2['friday_break_end'];
				}
				
				
				$pro_end_time=new DateTime();
				//$pro_st_time=new DateTime($pro_st_time);
				//echo $pro_st_time->format('H:i');
				//exit;
				
				
				foreach($days as $day)
					{
						$pro_st_time=new DateTime($s_time);
						if ($found==1)
							break;
						
						while (1)	
						{
				
							$sst=$pro_st_time->format("H:i");//date_format("H:i",$pro_st_time);
	
							$pro_end_time=$pro_st_time->add(new DateInterval("PT".($period*60)."M"));
							//$pro_st_time = date('H:i:s', strtotime($pro_st_time));

							//$pro_end_time = date('H:i:s', strtotime($pro_end_time));
						//$pro_end_time=date("H:i", strtotime("$pro_end_time"));
					 //$s=$pro_end_time->format('H:i');
					//echo $pro_end_time->format('H:i');;
					//$pro_end_time=new DateTime($pro_end_time);
					//$pro_end_time->format('H:i');

							$set= $pro_end_time->format("H:i");//date_format("H:i",$pro_end_time);
					//echo $sst.'--'.$set."==".$pro_end_time->format('H:i');
					//exit;
					
					if($day == 'Friday')
					{
						if(strtotime($sst) >= strtotime($friday_break_start) && strtotime($sst) < strtotime($friday_break_end))
							continue;
						if(strtotime($set) > strtotime($friday_break_start) && strtotime($set) <= strtotime($friday_break_end))
							continue;
						
						if($merge_cf_id != 0)
						{
							if(strtotime($sst) >= strtotime($friday_break_start2) && strtotime($sst) < strtotime($friday_break_end2))
							continue;
							if(strtotime($set) > strtotime($friday_break_start2) && strtotime($set) <= strtotime($friday_break_end2))
							continue;
						}
						
					}
					
					if(isset($_POST['ignore_std_conf']))
					{
						$conflict = 0;
					}
					else
					{
						$temp_arr = StudentConflict($conn, $sem, $course, $sst, $set, $day);
						//$conflict_arr = $temp_arr['con_arr'];
						$conflict = $temp_arr['is_con'];
						
						if($merge_cf_id != 0 and $conflict == 0)
						{
							$temp_arr = StudentConflict($conn, $sem, $merge_cf_id, $sst, $set, $day);
							//$conflict_arr = $temp_arr['con_arr'];
							$conflict = $temp_arr['is_con'];
						}
					}
					
					
					
							$temp2_arr = TeacherConflict($conn, $sem, $course, $fac, $sst, $set, $day);
					//$teach_arr = $temp2_arr['con_ar'];
							$teacher = $temp2_arr['is_con'];
			                             //RoomtConflict($sem, $course, $room, $s_time, $e_time, $day)
						
							$temp3_arr = RoomtConflict($conn, $sem, $course, $room, $sst, $set, $day);
					//$room_arr = $temp3_arr['con_ar r'];
					//print_r($temp3_arr);
							$rom = $temp3_arr['is_con'];
							
							
							$temp4_arr = programConflict($conn, $sem, $prog, $sst, $set, $day);
							$prog_con = $temp4_arr['is_con'];
						
							if($merge_cf_id != 0 and $prog_con == 0)
							{
								$prog2 = mysqli_query($conn, "select * from kiusc_course_offered where id = '$merge_cf_id'");
								$prog2 = mysqli_fetch_assoc($prog2);
								
								
								$temp4_arr = programConflict($conn, $sem, $prog2['prog_id'], $sst, $set, $day);
								$prog_con = $temp4_arr['is_con'];
							}
							
							$s=date("H:i", strtotime($sst));
							$e=date("H:i", strtotime($set));
							$stt=date("H:i",strtotime($e_time));	
							
							
							//calculate
							
							if(strtotime($s)>=strtotime($stt))
							{
								//echo $s."---".$stt.'<br>';
								break;
							}
							////////// one peri0d per day
							$one_p_per_day=1;
							$one_period=mysqli_query($conn,"select * from kiusc_timetable where c_offer_id='$course' and day='$day'");
							//echo "select * from kiusc_timetable where c_offer_id='$course' and day='$day'".'--';
							
							$one_period=mysqli_num_rows($one_period);
							//echo $one_period.'<br>';
							//exit;
							
							if($one_period>0)
							{
								break;
							}
							////////// max faculty peri0d
							//$max_periods=mysqli_query($conn,"select * from kiusc_general_timetable_setting where dep_id='$dept'");
							//$max_periods=mysqli_fetch_assoc($max_periods);
							//$max_period=$max_periods['max_fac_period'];
							//echo $max_period.'<br>';
							$fac_p=0;
							//$fac_periods=mysqli_query($conn,"select s.max_fac_period from kiusc_employees e join kiusc_emp_designation ed on e.id=ed.emp_id 
								//		join kiusc_general_timetable_setting s on s.dep_id=ed.acc_department_id where e.user_id='$fac'");
							$fac_hours=mysqli_query($conn,"select sum(period) as fhrs from kiusc_timetable where fac_id='$fac'");
							$fac_hour=mysqli_fetch_assoc($fac_hours);
							$max_period= ceil ($fac_hour['fhrs']/(5*1.5))+ 1;
							$fac_periods=mysqli_query($conn,"select * from kiusc_timetable where fac_id='$fac' and day='$day'");
							$fac_periods=mysqli_num_rows($fac_periods);
							
							
							if (($fac_periods>=$max_period))
							{	
								//echo "select * from kiusc_timetable where fac_id='$fac' and day='$day'".'---'.$fac_periods.'-'.$max_period.'<br>';
								break;
								
							}
							
							 $total_periods=mysqli_query($conn,"select count(period) as countp from kiusc_timetable t join kiusc_course_offered o on o.id=t.c_offer_id 
							 where prog_id='$prog' and day='$day'");
							 
							 $total_period=mysqli_fetch_assoc($total_periods);
							 $t_period_prog=$total_period['countp'];
							 
							$prog_hours=mysqli_query($conn,"select sum(period) as phrs from kiusc_timetable t join kiusc_course_offered o on o.id=t.c_offer_id
							where prog_id='$prog'");
							$prog_hour=mysqli_fetch_assoc($prog_hours);
							$max_prog_period= ceil ($prog_hour['phrs']/(5*1.5));
							if(isset($_POST['increase_prog_period']))
							{							
								$max_prog_period++;
							}
							
							if (($t_period_prog>$max_prog_period))
							{
								//echo "select * from kiusc_timetable where fac_id='$fac' and day='$day'".'---'.$fac_periods.'-'.$max_period.'<br>';
								break;
								
							}								
							
							
							//if($sst=='14:00' && $day=='Friday')
								//print $conflict. "-". $teacher. '-' . $rom ."-". $prog_con. "<br>";
							
							if ($conflict ==0 && $teacher==0 && $rom==0 && $prog_con==0)
							{
			
								mysqli_query($conn,"UPDATE `kiusc_timetable` SET `room_id` = '$room',`start` = '$s', `end` = '$e', `day` = '$day' where id =".$id);
								
								/*
								$result = mysqli_query($conn,"select * from kiusc_timetable where id = '$id'");
								$result= mysqli_fetch_assoc($result);
							
								$sdate=date_create($result['start_date']);
								
								$check_day = date_format($sdate, "l");
								if($check_day == $day)
								{
									$edate=date_create($result['end_date']);

									for($i = $sdate; $i <=$edate; $i = date_modify($i,"+1 week") )
									{
										$ins =  date_format($i,"Y-m-d");
										mysqli_query($conn,"INSERT INTO `kiusc_lectures` (`id`, `date`, `c_offer_id`, `period_id`) 
										VALUES (NULL, '$ins', '$course', '$id')");	
									}

								}
								else
								{
									date_modify($sdate,"next ".$day);
									$edate=date_create($result['end_date']);

									for($i = $sdate; $i <=$edate; $i = date_modify($i,"+1 week") )
									{
										$ins =  date_format($i,"Y-m-d");
										mysqli_query($conn,"INSERT INTO `kiusc_lectures` (`id`, `date`, `c_offer_id`, `period_id`) 
										VALUES (NULL, '$ins', '$course', '$id')");	
									}
								}
								*/
								
								$found=1;
								break;
							}
							else
							{
								//exit;
								$pro_st_time=$pro_end_time;
								
							}
							
						}
					}
			}
		}
	}
}
	
	
}
?>

					<br><h1>Grenerate Timetable</h1><br>

<?php
echo '
<table>
	<tr>
		<td> Select Department : </td>
		<td>';
			$dept = showDepartmentSel($conn, $dept);
echo '	</td>
	</tr>';
echo '
	<tr>
		<td> Select Semester : </td>
		<td>';
		$sem = showSemesterSel($conn, $sem, $prog=0, $dept);
echo '	</td>
	</tr>';
 	echo '<form name="submit11" id="submit11" action="" method="post">
	<input type="hidden" name="department_id" value="'.$dept.'">
	<input type="hidden" name="semester_id" value="'.$sem.'">';
	
	?>
	<tr>
		<td> Ignore Student Conflicts :</td>
		<td> <input type="checkbox" value="1" name="ignore_std_conf"> </td>
	</tr>
	<tr>
		<td> Increase Program Perdio Per Day by 1 :</td>
		<td> <input type="checkbox" value="1" name="increase_prog_period"> </td>
	</tr>
	<tr>
		<td colspan="2">
<?php
		
    		echo '<input type="submit" value="Generate"  name ="generate"/>';
?>
    	</td>
	</tr> 
</table>
</form>

