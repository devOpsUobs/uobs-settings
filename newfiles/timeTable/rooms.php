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

$block=-1;
if(isset($_POST['block_id']))
{
	$block=$_POST['block_id'];
}
$roomtype=-1;
if(isset($_POST['rt_id']))
{
	$roomtype=$_POST['rt_id'];
}
if (isset($_POST['insert'])) {
	$rm_no = $_POST['room_number'];
	$rm_cap = $_POST['room_capacity'];
	$rm_seats = $_POST['room_seats'];

	$ex = mysqli_query($conn, "SELECT * FROM kiusc_rooms WHERE room_number='$rm_no' AND block_id='$block'");
	if (mysqli_num_rows($ex) > 0) {
		echo "Data Already Exist";
	} else {
		mysqli_query($conn, "INSERT INTO kiusc_rooms (room_number, room_capacity, block_id, roomtype_id, room_seats) 
			VALUES ('$rm_no', '$rm_cap', '$block', '$roomtype', '$rm_seats')");
	}
}



if (isset($_POST['update_id'])) {
    $room_id = $_POST['update_id'];
    $room_number = $_POST['edit_room_number'];
    $room_capacity = $_POST['edit_room_capacity'];
    $room_seats = $_POST['edit_seats'];

    mysqli_query($conn, "UPDATE kiusc_rooms SET room_number = '$room_number', room_capacity = '$room_capacity', room_seats = '$room_seats' WHERE id = $room_id");
}


 if (isset($_GET['did']))
{
	mysqli_query($conn,"delete from kiusc_rooms where id=".$_GET['did']);
	
}?>
							<h1> Room Setting</h1><br />
<?php
echo '<table>
<tr>
	<td> Select Block : </td>
	<td>';
	$block = showBlockSel($conn, $block);
echo '</td>
</tr>';

echo '<tr>
	<td> Select Room Type : </td>
	<td>';
	$roomtype = showRoomtypeSel($conn, $roomtype,$block);
echo '</td>
</tr>';
?>

<form  action="" method="post">
<?php echo '<input type="hidden" name="block_id" value="'.$block.'">
<input type="hidden" name="rt_id" value="'.$roomtype.'">' ?>
<tr>
	<td>
		Room Number
	</td>
    <td>
     <input type="text" name="room_number" placeholder="Please insert room number..." value="" required/> 
     </td>
</tr>
<tr>
	<td>
		Room Capacity 
    </td>
    <td>
    <input type="text" name="room_capacity" placeholder="Please insert room Capacity..."  value="" required/> 
    </td>
</tr>

<tr>
	<td>Seats</td>
	<td><input type="number" name="room_seats" placeholder="Insert seat count..." required /></td>
</tr>
<tr>
     <input type="hidden" name="r_id" value="<?php print isset($rm['id']) ? $rm['id'] : "" ?>" />
<tr>
     <td colspan="2">
		<input type="submit"  value="Insert" name ="insert"/>
     </td>
</tr>
</form>
</table>
<br /><br />
<table cellpadding="5px" cellspacing="2px" width="650" border="1" align="center" style="background-color:#CCC">
  <tr>
    <th scope="col">Room Number</th>
    <th scope="col">Room Capacity</th>
	<th scope="col">Seats</th>

    <th scope="col">Room Type</th>
    <th scope="col">Block Name</th>
    <th scope="col">Action</th>
 </tr>
  <?php 
  $res = mysqli_query($conn,"select r.*, b.block_name as b_name,rmt.roomtype_name as rmt_name from kiusc_rooms r join kiusc_blocks b on r.block_id = b.id join kiusc_room_type rmt on r.roomtype_id=rmt.id where r.block_id =".$block); 
  while($s = mysqli_fetch_assoc($res))
	{
  ?>
  <tr>
    <td><?php echo $s['room_number'] ?></td>
    <td><?php echo $s['room_capacity'] ?></td>
	<td><?php echo $s['room_seats']; ?></td>

   <td><?php echo $s['rmt_name'] ?></td> 
   <td><?php echo $s['b_name'] ?></td>
	<td>
		<a href="index.php/cms-admin/time-table/rooms?did=<?php echo $s['id'] ?>">Delete</a> |
		<a href="javascript:void(0);" onclick='editRoom(<?php echo json_encode($s); ?>)'>Edit</a>
	</td>
  </tr>
 <?php } ?>
</table>

<?php
// Summary logic
$totalRooms = 0;
$totalCapacity = 0;
$totalSeats = 0;

$summaryQuery = mysqli_query($conn, "SELECT COUNT(*) as total_rooms, 
                                            SUM(room_capacity) as total_capacity, 
                                            SUM(room_seats) as total_seats 
                                     FROM kiusc_rooms 
                                     WHERE block_id = $block");

if ($summary = mysqli_fetch_assoc($summaryQuery)) {
    $totalRooms = $summary['total_rooms'];
    $totalCapacity = $summary['total_capacity'];
    $totalSeats = $summary['total_seats'];
}
?>

<!-- Summary Section -->
<h3>Room Summary</h3>
<table cellpadding="5px" cellspacing="2px" width="400" border="1" align="center" style="background-color:#EEE">
    <tr>
        <th>Total Rooms</th>
        <th>Total Capacity</th>
        <th>Total Seats</th>
        <th>Total Required</th>
    </tr>
    <tr>
        <td align="center"><?php echo $totalRooms; ?></td>
        <td align="center"><?php echo $totalCapacity; ?></td>
        <td align="center"><?php echo $totalSeats; ?></td>
        <td align="center"><?php echo  $totalCapacity-$totalSeats; ?></td>
    </tr>
</table>





<?php
//////////////////////////////
/////Functions//////////////
////////////////////////////////

function showBlockSel($conn, $blk)
{
	$blk_re =  mysqli_query($conn,"select * from kiusc_blocks");
	 
echo '
<form name="blk_select" id="blk_select" action="" method="post">

<select name="block_id" id="block_id">';

 $sel_blk=-1;
while($row = mysqli_fetch_assoc($blk_re))
{
		$s="";
		if ($sel_blk==-1)
		{	
			$sel_blk=$row['id'];
			$s = " selected ";
		}
	   if ($blk==$row['id']) 
	   {
			$sel_blk=$row['id'];
			$s=" selected ";
	   }
	   
		echo '<option '.$s.' value="'.$row['id'].'">'.$row['block_name'].'</option>';
}

echo'</select>
 </form>';
 
?>

<script type="text/javascript">
$("#block_id").change(function()
	{
		$("#blk_select").trigger("submit");
	}
);

</script>

<?php
return $sel_blk;
}

function showRoomtypeSel($conn, $rt,$block)
{
	$rt_re =  mysqli_query($conn,"select * from kiusc_room_type");
	 
echo '
<form name="rt_select" id="rt_select" action="" method="post">
<input type="hidden" name="block_id" value="'.$block.'">

<select name="rt_id" id="rt_id">';

 $sel_rt=-1;
while($row = mysqli_fetch_assoc($rt_re))
{
		$s="";
		if ($sel_rt==-1)
		{	
			$sel_rt=$row['id'];
			$s = " selected ";
		}
	   if ($rt==$row['id']) 
	   {
			$sel_rt=$row['id'];
			$s=" selected ";
	   }
	   
		echo '<option '.$s.' value="'.$row['id'].'">'.$row['roomtype_name'].'</option>';
}

echo'</select>
 </form>';
 
?>

<script type="text/javascript">
$("#rt_id").change(function()
	{
		$("#rt_select").trigger("submit");
	}
);

</script>

<?php
return $sel_rt;
}
?>

<div id="editDlg" class="easyui-dialog" title="Edit Room" style="width:400px;height:300px;padding:10px"
     closed="true" buttons="#dlg-buttons" modal="true">
    <form id="editForm" method="post">
        <input type="hidden" name="update_id" id="update_id">
        <div style="margin-bottom:10px">
            Room Number: <br/>
            <input name="edit_room_number" id="edit_room_number" class="easyui-textbox" style="width:100%" required>
        </div>
        <div style="margin-bottom:10px">
            Room Capacity: <br/>
            <input name="edit_room_capacity" id="edit_room_capacity" class="easyui-textbox" style="width:100%" required>
        </div>
		<div style="margin-bottom:10px">
			Seats: <br/>
			<input name="edit_seats" id="edit_seats" class="easyui-textbox" style="width:100%" required>
		</div>
    </form>
</div>

<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitEdit()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:$('#editDlg').dialog('close')">Cancel</a>
</div>

<script type="text/javascript">
    function editRoom(room) {
        $('#editDlg').dialog('open');
        $('#update_id').val(room.id);
        $('#edit_room_number').textbox('setValue', room.room_number);
        $('#edit_room_capacity').textbox('setValue', room.room_capacity);
		$('#edit_seats').textbox('setValue', room.room_seats);

    }

    function submitEdit() {
        $('#editForm').submit();
    }
</script>
