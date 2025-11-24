<?php
 include "newfiles/common.php";
 include "newfiles/conn.php";
 
 
 $doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/demo.css");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.easyui1.min.js");



if (checkPermission(JFactory::getUser(), "sis_settings")==0)
{
	echo"You dont have right to access this page!";
	return;
}	

//$event_array= array('National Event','Hijri Event','KIU Event');
$event_array= array('National Event','Hijri Event');

//********************************************** Select year function *************************************************

$year=date('Y');

if(isset($_REQUEST['year']))
	
	$year = $_REQUEST['year'];
	
$etype="";

if(isset($_REQUEST['etype']))
	
	$etype =$_REQUEST['etype'];


$year = yearDropDown($conn, $year);
$etype = showEventSel($conn, $event_array, $year, $etype);
 
 /// if($etype == 'kiu_event')
 /// select * from holiday where kiu_event_id > 0 and year = '$year' 

if(isset($_POST['submit']))	
{
		$event_id = $_POST['event_id'];
		$h_id=$_POST['h_id'];
		$days=$_POST['days'];
		$start=$_POST['start'];
		$show = array(0);
			 
		if(isset($_POST['show']))
			$show = $_POST['show'];
		
		//$reason = "";  //// for noLecture Reason
	     $i = 0;
		 foreach($days as $dd)
		 {
			 $sh = 0;
			 if(in_array($event_id[$i], $show))
				 $sh = 1;
			 
			if($h_id[$i])
			{
				if($etype=="KIU Event")
				{
					mysqli_query($conn, "UPDATE `lms_holidays` SET `k_id`='$event_id[$i]',`days`='$days[$i]',`start`='$start[$i]',`show_student`='$sh',`year_id`='$year' WHERE `h_id` = '$h_id[$i]'");
				   
				}
				else if($etype=="Hijri Event")
				{
					mysqli_query($conn, "UPDATE `lms_holidays` SET `is_id`='$event_id[$i]',`days`='$days[$i]',`start`='$start[$i]',`show_student`='$sh',`year_id`='$year' WHERE `h_id` = '$h_id[$i]'");
				}
				else
				{
					mysqli_query($conn, "UPDATE `lms_holidays` SET `n_id`='$event_id[$i]',`days`='$days[$i]',`start`='$start[$i]',`show_student`='$sh',`year_id`='$year' WHERE `h_id` = '$h_id[$i]'");
				}
			}
			else
			{
				if($etype=="KIU Event")
				 {
					mysqli_query($conn, "Insert into lms_holidays (`h_id`, `k_id`, `days`, `start`, `show_student`, `year_id`)
					VALUES ('','$event_id[$i]','$days[$i]','$start[$i]','$sh','$year')");
					
					
					//	$eve_detail = mysqli_query($conn, "SELECT k.*, ken.event_name FROM `lms_kiu_events` k join lms_kiu_event_name ken join k.eve_id = ken.id WHERE k.id = '$event_id'");
					//	$eve_detail = mysqli_fetch_assoc($eve_detail);
					
					//	$reason = $eve_detail['event_name'];
				 }
				 else if($etype=="Hijri Event")
				 {
					  mysqli_query($conn, "Insert into lms_holidays (`h_id`, `is_id`, `days`, `start`, `show_student`, `year_id`)
					 VALUES ('','$event_id[$i]','$days[$i]','$start[$i]','$sh','$year')");
					 
					//	$eve_detail = mysqli_query($conn, "SELECT * FROM `lms_islamic_events` WHERE `id` = '$event_id'");
					//	$eve_detail = mysqli_fetch_assoc($eve_detail);
					
					//	$reason = $eve_detail['event_name'];
					
				 }
				 else
				 {
					mysqli_query($conn, "Insert into lms_holidays (`h_id`, `n_id`, `days`, `start`, `show_student`, `year_id`)
					 VALUES ('','$event_id[$i]','$days[$i]','$start[$i]','$sh','$year')");

					//	$eve_detail = mysqli_query($conn, "SELECT * FROM `lms_national_events` WHERE id = '$event_id'");
					//	$eve_detail = mysqli_fetch_assoc($eve_detail);
					
					//	$reason = $eve_detail['event_name'];				 
				 }
			}
			
			$i++;
		 }
}
	
	echo "<h3> Show holiday </h3>";
?>

<div align="center" style="font-color:#CCC;"></div>
	
<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:90%">

<tr>
    <th>Year</th>
    <th>Event Name</th>
	<th>Days</th>
	<th>Start</th>
	<th>Show Student</th>
</tr>  
    
<?php
if($etype=="KIU Event")
{
	$sql="SELECT k.*, ken.event_name FROM `lms_kiu_events` k join lms_kiu_event_name ken on k.eve_id = ken.id"; 
}
else if($etype=="Hijri Event")
{
	$sql="SELECT * FROM `lms_islamic_events`"; 
}
 else
{
	$sql="SELECT * FROM `lms_national_events`"; 
}

$events=mysqli_query($conn, $sql);
?>

<form method="POST" action="" >
<?php
while($row = mysqli_fetch_array($events))
{
	if($etype=="KIU Event")
		$sql="SELECT * FROM `lms_holidays` WHERE `k_id` = '".$row['id']."' and `year_id` = '$year'"; 
	else if($etype=="Hijri Event")
		$sql="SELECT * FROM `lms_holidays` WHERE `is_id` = '".$row['id']."' and `year_id` = '$year'"; 
	else
		$sql="SELECT * FROM `lms_holidays` WHERE `n_id` = '".$row['id']."' and `year_id` = '$year'"; 	

	$holiday = mysqli_query($conn, $sql);
	$holiday = mysqli_fetch_array($holiday);
?>

<input type="hidden" name="event_id[]" value="<?php echo $row['id'] ?>">
<input type="hidden" name="h_id[]" value="<?php echo $holiday['h_id'] ?>">
<tr>
	<td><?php echo $year;?></td>
	<td> <?php echo  $row['event_name'];?></td>
	<td><input type="number" name="days[]" min="0" value="<?php echo $holiday['days'];?>"></td>
	<td>
		<?php 
		$start_arr = array('0'=>'Same Day', '-1'=>'One day before','-2'=>'Two days before','-3'=>'Three days before', );
		?>
		<select name="start[]">
			<?php foreach($start_arr as $key=>$value) {
					$sel = "";
					if($key == $holiday['start'])
						$sel = " selected ";
					
					echo "<option value='".$key."' ".$sel." >".$value."</option>";
			}
			?>
		</select>
	<td><input type="checkbox" <?php echo ($holiday['show_student'] == 1) ? 'checked' : '' ?> name="show[]" value="<?php echo $row['id'] ?>" ></td>
</tr>
<?php
}
?>
	<input type="hidden" name="etype" value="<?php echo $etype ?>" >
	<input type="hidden" name="year" value="<?php echo $year ?>" >
<tr>
	<td colspan=4> </td>
	<td><input type="submit" name="submit" value="Save"  style="background-colour: burlywood; border-radius: 17px" /></td>
</tr>
</form>
</table>




<?php 

function yearDropDown($conn, $year)
{
	$start = 2016;
	$cur_year = date('Y');
echo '
<form name="year_select" id="year_select" action="" method="post">
<h3>Select Year</h3>


<select name="year" style="width:500px" id="year">';


	$sel_year = -1;
	for($i = $start; $i<=$cur_year+1; $i++)
	{
		$sel = "";
		if($sel_year==-1)
		{	
			$sel_year=$cur_year;
			$sel = " selected ";
		}
		if($year == $i)
		{
			$sel_year = $i;
			$sel = " selected ";	
		}
		 
			echo '<option value="'.$i.'" '. $sel . '>'.$i.'</option>';

		}
echo'
</select>
<br>
 </form>';
?>

<script type="text/javascript">
$("#year").change(function()
	{
		$("#year_select").trigger("submit");
	}
);

</script>

<?php		
return $sel_year;
}	 


function showEventSel($conn, $event_array,$year, $etype)
{

echo '
<form name="type_select" id="type_select" action="" method="post">
<input type="hidden" name="year" value="'.$year.'">
<h3>Select Event Type</h3>


<select name="etype" style="width:500px" id="etype">';


        // echo '<option>Select event</option>';
		 $sel_type = -1;
		foreach($event_array as $ev)
		{
			$sel = "";
			if($sel_type==-1)
		
		     {	
			$sel_type=$row['id'];
			$sel = " selected ";
		     }
			if($etype == $ev)
			{
				$sel_type = $ev;
				$sel = " selected ";
				
			}
		 
			echo '<option value="'.$ev.'" '. $sel . '>'.$ev.'</option>';

		}
echo'
</select>
<br>
 </form>';
?>

<script type="text/javascript">
$("#etype").change(function()
	{
		$("#type_select").trigger("submit");
	}
);

</script>

<?php		
return $sel_type;
}	 
?>