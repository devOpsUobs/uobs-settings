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

$sem=-1;
if(isset($_REQUEST['semester_id']))
{
	$sem=$_REQUEST['semester_id'];
}
$previous_sem = $sem-1;

$room_type=-1;
if(isset($_POST['room_type']))
{
	$room_type=$_POST['room_type'];
}
if (isset($_POST['assign']))
{
	$query = "SELECT DISTINCT(t.room_id) as room_id, p.id as prog_id, p.name, p.session_type, p.session, r.room_number 
				FROM kiusc_programs p 
					JOIN kiusc_course_offered co on p.id = co.prog_id
					JOIN kiusc_timetable t on co.id = t.c_offer_id
					JOIN kiusc_rooms r on t.room_id = r.id
					WHERE p.active = 1 and r.roomtype_id = '$room_type' and t.sem_id='$previous_sem'";
	$rows=mysqli_query($conn, $query);
	echo "
		<table class='table table-striped table-hover'>
			<tr>
				<td>Programs</td>
				<td>Rooms</td>
				<td>Status</td>
			</tr>";
			while($data = mysqli_fetch_assoc($rows))
			{
				$name = $data['name'];
				$session_type = $data['session_type'];
				$session = $data['session'];
				$prog_id = $data['prog_id'];
				$room_id = $data['room_id'];
				$room_number = $data['room_number'];
				$query = "SELECT * FROM `kiusc_room_program` 
							WHERE prog_id = '$prog_id' 
							AND room_id = '$room_id' 
							AND sem_id = '$sem'";
				$check = mysqli_query($conn, $query);
				$if_exist = mysqli_num_rows($check);
				if($if_exist > 0)
				{
					echo "
					<tr style='background:red'>
						<td>".$session_type."-".$name." (".$session.")</td>
						<td>".$room_number."</td>
						<td>Already Assigned</td>
					</tr>";
				}
				else
				{
					mysqli_query($conn,"INSERT INTO `kiusc_room_program` (`id`, `prog_id`, `room_id`, `sem_id`) VALUES (NULL, '$prog_id','$room_id','$sem')");
					echo "
					<tr>
						<td>".$session_type."-".$name." (".$session.")</td>
						<td>".$room_number."</td>
						<td>Assigned</td>
					</tr>";
				}
			}
			echo "
		</table>";
}
?>
<?php
echo '
<table class="table table-striped table-hover">
	<tr>
		<th> 
			Select Semester : 
		</th>
		<td>';
			$sem = showSemesterSel($conn, $sem, $prog, $dept);
			echo '	
		</td>
	</tr>';
	?>
	<tr>
		<th> Room Types </th>
		<form action="" method="post">
			<input type="hidden" name="semester_id" value="<?php echo $sem;?>">
			<td>
				<select name="room_type" id="room_type">
					<option value="0">Select Room Type</option>
					<?php
					$room_types = mysqli_query($conn,"select * from kiusc_room_type");
					while($room_type=mysqli_fetch_assoc($room_types))
					{
						$sel = " ";
						if(in_array($room_type['id'],$checkbox))
							$sel = " selected ";
						echo "<option value='".$room_type['id']."' ".$sel.">".$room_type['roomtype_name']."</option>";
					}
					?>
				</select>
			</td>
		<tr>
			<td colspan=2><input type="submit" value="Assign" name ="assign" class="btn2 info"/></td>
		</tr>

	</form>
</table>