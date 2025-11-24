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

$prog=-1;
if(isset($_POST['program_id']))
{
	$prog=$_POST['program_id'];
}


	
if (isset($_POST['insert']))
{
	
	$s=$_POST['start'];
	$e=$_POST['end'];
	$break_start=$_POST['breakstart'];
	$break_end=$_POST['breakend'];
	

	$s=date("H:i", strtotime("$s"));
	$e=date("H:i", strtotime("$e"));
	$break_start=date("H:i", strtotime("$break_start"));
	$break_end=date("H:i", strtotime("$break_end"));
	
		$count2=mysqli_query($conn,"select * from kiusc_timetable_setting where prog_id='$prog'");
		$count2=mysqli_num_rows($count2);
		

		if($count2>0)
		{
			mysqli_query($conn,"UPDATE `kiusc_timetable_setting` SET `start_time`='$s',`end_time`='$e' ,
			`friday_break_start` = '$break_start' ,`friday_break_end`='$break_end' WHERE `prog_id`='$prog'");
		}
		else
		{
			mysqli_query($conn,"INSERT INTO `kiusc_timetable_setting`(`id`, `start_time`, `end_time`, `prog_id`,`friday_break_start`,`friday_break_end`) 
			VALUES (NULL,'$s','$e','$prog','$break_start','$break_end')");		
		}
}

?>
					<br><h1>Timetable Setting</h1><br>

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
		<td> Select Program : </td>
		<td>';
	$prog = showProgramSel($conn, $prog, $dept);
echo '	</td>
	</tr>';
?>
  
<?php 

	$get_times=mysqli_query($conn,"select * from kiusc_timetable_setting where prog_id='$prog'");
	$get_time=mysqli_fetch_assoc($get_times);
	$start_time=$get_time['start_time'];
	$end_time=$get_time['end_time'];
	$break_start=$get_time['friday_break_start'];
	$break_end=$get_time['friday_break_end'];

 echo '<form name="submit11" id="submit11" action="" method="post">
<input type="hidden" name="department_id" value="'.$dept.'">
<input type="hidden" name="program_id" value="'.$prog.'">';
?>
	<tr> 
		<td>
			Start Time <input type="time" name="start" value="<?php print isset($start_time) ? $start_time : "" ?>" />
    	</td>
		<td>
    		 End Time <input type="time" name="end" value="<?php print isset($end_time) ? $end_time : "" ?>" />
    	</td>
	</tr>
	<tr> 
		<td>
			Friday Break Start <input type="time" name="breakstart" value="<?php print isset($break_start) ? $break_start : "" ?>" />
    	</td>
		<td>
    		 Friday Break End <input type="time" name="breakend" value="<?php print isset($break_end) ? $break_end : "" ?>" />
    	</td>
	</tr>
	<tr>
		<td colspan="2">
    	 <input type="submit"  name ="insert" value="Save" />
    	</td>
	</tr> 
</table>
</form>
