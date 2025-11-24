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

$sem=-1;
if(isset($_POST['semester_id']))
{
	$sem=$_POST['semester_id'];
}

$room=-1;
if(isset($_POST['room_id']))
{
	$room=$_POST['room_id'];
}

$day=-1;
if(isset($_POST['day_id']))
{
	$day=$_POST['day_id'];
}

if (isset($_POST['insert']))
{
	$s=$_POST['start'];
	$e=$_POST['end'];
	$new_date=$_POST['newdate'];
	$s_time=date("H:i", strtotime("$s"));
	$e_time=date("H:i", strtotime("$e"));		
	
	$ndate=date_create($new_date);
	$check_day = date_format($ndate, "l");
	
	$user_id=JFactory::getUser();
	$user_id=$user_id->id;
	//echo $user_id;
	//echo "select * from kiusc_employees where id='$user_id'";
	$cnic=mysqli_query($conn,"select * from kiusc_employees where user_id='$user_id'");
	$cnic=mysqli_fetch_assoc($cnic);
	//echo $cnic['cnic'];
		if($check_day == $day)
		{
			$ins =  date_format($ndate,"Y-m-d");
			echo "INSERT INTO `kiusc_reservation`(`id`, `sem_id`, `c_offer_id`, `room_id`, `start`, `end`, `day`, `date`, `status`, `cnic`) 
						VALUES (NULL,'$sem','0','$room','$s_time','$e_time','$day','$ins','Pending','".$cnic['cnic']."')";
			mysqli_query($conn,"INSERT INTO `kiusc_reservation`(`id`, `sem_id`, `c_offer_id`, `room_id`, `start`, `end`, `day`, `date`, `status`, `cnic`) 
						VALUES (NULL,'$sem','0','$room','$s_time','$e_time','$day','$ins','Pending','".$cnic['cnic']."')");
		}
		else
		{
			date_modify($ndate,"next ".$day);
			$ins =  date_format($ndate,"Y-m-d");
			mysqli_query($conn,"INSERT INTO `kiusc_reservation`(`id`, `sem_id`, `c_offer_id`, `room_id`, `start`, `end`, `day`, `date`, `status`, `cnic`) 
						VALUES (NULL,'$sem','0','$room','$s_time','$e_time','$day','$ins','Pending','".$cnic['cnic']."')");
		}
}


$rom=1;
$room_arr = array();
$s_time="";
$e_time="";
if (isset($_POST['check']))
{
	$new_date=$_POST['newdate'];
	$s_time=$_POST['start'];
	$e_time=$_POST['end'];
	
	$temp3_arr = RoomConflict($conn, $sem, $room, $s_time, $e_time, $day,$new_date);
	$room_arr = $temp3_arr['con_arr'];
	$rom = $temp3_arr['is_con'];
	
}

?>

					<br><h1>Online Reservation</h1><br>

<?php
echo '
<table>
	<tr>
		<td> Select Semester : </td>
		<td>';
		$sem = showSemesterSel($conn, $sem, $prog=0, $dept=0);
echo '	</td>
	</tr>
	<tr>
		<td> Select Semester : </td>
		<td>';
		$room = showallRoomSel($conn, $room, $sem);
echo '	</td>
	</tr>
	<tr>
		<td> Select Semester : </td>
		<td>';
		$day = showallDaySel($conn, $day, $room, $sem);
echo '	</td>
	</tr>
	
	<form name="submit11" id="submit11" action="" method="post">
	<input type="hidden" name="semester_id" value="'.$sem.'">
	<input type="hidden" name="room_id" value="'.$room.'">
	<input type="hidden" name="day_id" value="'.$day.'">
		</td>
	</tr>';
?>
	<tr> 
		<td>
			Start Time <input type="time" name="start" value="<?php echo $s_time ?>" />
    	</td>
		<td>
    		 End Time <input type="time" name="end" value="<?php echo $e_time ?>" />
    	</td>
	</tr>
    <tr> 
		<td colspan="2">
			Start Date <input type="date" name="newdate" value="<?php echo $new_date; ?>" required/>
    	</td>
	</tr>
	<tr>
		<td colspan="2">
<?php
       		echo ' <input type="submit" value="Check"  name ="check"/>';

		if($rom==0)
		{
    		echo '<input type="submit" value="Insert"  name ="insert"/>';
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
								<br><h1>Conflict Rooms</h1><br />
<table>
	<tr>
		<th> Block Name  </th>
		<th> Room Number  </th>
	</tr>
<?php 
if($rom==1)
{
	foreach($room_arr as $con)
	{
		$rm=mysqli_query($conn,"select r.room_number as rm, b.block_name as nm from kiusc_rooms r join kiusc_blocks b on r.block_id = b.id 
		where r.id = '".$con['room_id']."'");
		$rm=mysqli_fetch_assoc($rm);
	?>
	<tr>
		<td> <?php echo $rm['nm']; ?></td>
		<td> <?php echo $rm['rm']; ?></td>
	</tr>

<?php 
	}
}
echo'
</table>';


////////////////////////////////////////////////
///////// Functions /////////////////////////
///////////////////////////////////////////////


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

function RoomConflict($conn, $sem, $room, $s_time, $e_time, $day,$new_date)
{
	$s=date("H:i", strtotime("$s_time"));
	$e=date("H:i", strtotime("$e_time"));
		
		//$room_conf= mysqli_query($conn,"SELECT `c_offer_id`, room_id FROM `kiusc_timetable` 
		//WHERE sem_id = '$sem' and start='$s_time' and end ='$e_time' and room_id = '$room'");

		$room_conf= mysqli_query($conn,"SELECT room_id FROM `kiusc_timetable` WHERE day = '$day' and sem_id = '$sem' and start='$s_time' 
		 and end ='$e_time' and end_date >= '$new_date' and room_id = '$room' and is_changed=0");
		
		$rom = 0;
		$room_arr = array();
	while($lis= mysqli_fetch_assoc($room_conf))
	{
		$res = mysqli_query($conn,"select * from kiusc_timetable where sem_id='$sem' and room_id = '$room' 
		and start='$s_time' and end ='$e_time'  and day = '$day'");
		$count=mysqli_num_rows($res);
		if($count > 0)
		{
			$rom=1;
			$room_arr[] = array('room_id'=>$lis['room_id']);
		}
	}
		return array("con_arr" => $room_arr, "is_con" => $rom);

}

function showallRoomSel($conn, $room, $sem)
{
	$room_re =  mysqli_query($conn,"select * from kiusc_rooms");
	
echo '
<form name="room_select" id="room_select" action="" method="post">

<input type="hidden" name="semester_id" value="'.$sem.'">

<select name="room_id" id="room_id">';

 $sel_room=-1;
while($row = mysqli_fetch_assoc($room_re))
{
		$s="";
		if ($sel_room==-1)
		{	
			$sel_room=$row['id'];
			$s = " selected ";
		}
	   if ($room==$row['id']) 
	   {
			$sel_room=$row['id'];
			$s=" selected ";
	   }
	   
		echo '<option '.$s.' value="'.$row['id'].'">'.$row['room_number'].'</option>';
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

function showallDaySel($conn, $day, $room, $sem)
{
echo '
<form name="day_select" id="day_select" action="" method="post">

<input type="hidden" name="semester_id" value="'.$sem.'">
<input type="hidden" name="room_id" value="'.$room.'">

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
?>
