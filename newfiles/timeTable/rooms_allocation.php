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
if(isset($_REQUEST['department_id']))
{
	$dept=$_REQUEST['department_id'];
}

$prog=-1;
if(isset($_REQUEST['program_id']))
{
	$prog=$_REQUEST['program_id'];
}

$sem=-1;
if(isset($_REQUEST['semester_id']))
{
	$sem=$_REQUEST['semester_id'];
}


$block=-1;
if(isset($_POST['block_id']))
{
	$block=$_POST['block_id'];
}

$checkbox=array('-1');
if(isset($_POST['room_type']))
{
	$checkbox=$_POST['room_type'];
}
$rmcheck=array();
if (isset($_POST['insert']))
{
	$rmcheck = array(); 
	if(isset($_POST['roomcheck']))
		$rmcheck= $_POST['roomcheck'];
	
	mysqli_query($conn, "DELETE FROM `kiusc_room_program` WHERE `prog_id`= '$prog' and `sem_id` = '$sem'");
	$i=0;
	foreach($rmcheck as $rm)
	{
		/*$chk=mysqli_query($conn,"select * from kiusc_room_program where room_id='".$rmcheck[$i]."' and prog_id='$prog' and sem_id='$sem'");
		$chk=mysqli_num_rows($chk);
		if($chk<1) */
		
		mysqli_query($conn,"INSERT INTO `kiusc_room_program` (`id`, `prog_id`, `room_id`, `sem_id`) VALUES (NULL, '$prog','$rmcheck[$i]','$sem')");
		$i++;
	}
}



 if (isset($_GET['did']))
{
	mysqli_query($conn,"delete from kiusc_rooms where id=".$_GET['did']);
	
}?>
<?php
echo '<table class="table table-striped table-hover">
	<tr>
		<th> 
			Select Department : 
		</th>
		<td>';
			$dept = showDepartmentSel($conn, $dept);
echo '	</td>
	</tr>
	<tr>
		<th> 
			Select Program : 
		</th>
		<td>';
	$prog = showProgramSel($conn, $prog, $dept);
echo '	</td>
	</tr>';

echo '
	<tr>
		<th> 
			Select Semester : 
		</th>
		<td>';
		$sem = showSemesterSel($conn, $sem, $prog, $dept);
echo '	</td>
	</tr>
<tr>
	<th> Select Block : </th>
	<td>';
	$block = showBlockSel($conn, $block, $sem, $prog, $dept);
echo '</td>
</tr>';
?>
</table>
<h4> Select Room Types</h4>
<table class="table table-striped table-hover">
<tr>
	<th> Room Types </th>
</tr>
<form action="" method="post">
<?php 
	echo '
		<input type="hidden" name="department_id" value="'.$dept.'">
		<input type="hidden" name="program_id" value="'.$prog.'">
		<input type="hidden" name="semester_id" value="'.$sem.'">
		<input type="hidden" name="block_id" value="'.$block.'">';
	$room_types = mysqli_query($conn,"select * from kiusc_room_type");
	while($room_type=mysqli_fetch_assoc($room_types))
	{
		$sel = " ";
		if(in_array($room_type['id'],$checkbox))
			$sel = " checked ";
?>

<tr>
	<td>
		<input type="checkbox" name="room_type[]" <?php echo $sel ?> value="<?php echo $room_type['id'] ?>"/> <?php echo $room_type['roomtype_name'];?> 
	</td>
</tr>
<?php
	}
?>
<tr>
	<td><input type="submit" value="Show" name ="show" class="btn2 info"/></td>
</tr>

</form>
</table>

<h4> Select Rooms You Want To Allocate</h4><br />

<form action="" method="post">
<table class="table table-striped table-hover">
<?php
echo '
		<input type="hidden" name="department_id" value="'.$dept.'">
		<input type="hidden" name="program_id" value="'.$prog.'">
		<input type="hidden" name="semester_id" value="'.$sem.'">
		<input type="hidden" name="block_id" value="'.$block.'">';
		$room_types = mysqli_query($conn,"select * from kiusc_room_type");
	while($room_type=mysqli_fetch_assoc($room_types))
	{
		if(in_array($room_type['id'],$checkbox))
			echo '<input type="hidden" name="room_type[]" value="'.$room_type['id'].'"/> ';
	}
?>


	<tr>
    	<th scope="col">Room Number</th>
    	<th scope="col">Room Capacity</th>
    	<th scope="col">Room Type</th>
    	<th scope="col">Block Name</th>
    	<th scope="col">Action <input type="checkbox" id="select-all" name="select-all" /></th>
	</tr>

  <?php 
  $rtypecheck = implode(',',$checkbox);
  $res = mysqli_query($conn,"select r.*, b.block_name as b_name,rmt.roomtype_name as rmt_name from kiusc_rooms r 
  join kiusc_blocks b on r.block_id = b.id join kiusc_room_type rmt on r.roomtype_id=rmt.id
   where r.block_id =".$block." and roomtype_id in (".$rtypecheck.")");
  while($s = mysqli_fetch_assoc($res))
	{
		$chk=mysqli_query($conn,"select * from kiusc_room_program where room_id='".$s['id']."' and prog_id='$prog' and sem_id='$sem'");
		$chk=mysqli_num_rows($chk);
		$sel="";
		if($chk>0)
			$sel="checked";
?>
	<tr>
  		<td><?php echo $s['room_number'] ?></td>
 		<td><?php echo $s['room_capacity'] ?></td>
		<td><?php echo $s['rmt_name'] ?></td> 
		<td><?php echo $s['b_name'] ?></td>
 
    	<td><input type="checkbox" name="roomcheck[]" id="roomcheck[]"  <?php echo $sel ?> value="<?php echo $s['id']?>" /></td>
  </tr>
 <?php } ?>

	<tr>
		<td colspan="5"><input type="submit"  value="Insert" name ="insert"  class="btn2 info"/></td>
	</tr>
</table>
</form>

<script>

	jQuery("#select-all").change(function () {
		//alert(document.getElementByName("roomcheck").length);
		var rows = document.getElementsByName('roomcheck[]');
		for(var i=0; i<rows.length; i++)
		{
			rows[i].checked = (document.getElementById('select-all').checked);
			//jQuery("#roomcheck").prop('checked', jQuery(this).prop("checked"));	
		}
	});

</script>

<?php
//////////////////////////////
/////Functions//////////////
////////////////////////////////

function showBlockSel($conn, $blk, $sem, $prog, $dept)
{
	$blk_re =  mysqli_query($conn,"select * from kiusc_blocks order by id desc");
	 
echo '
<form name="blk_select" id="blk_select" action="" method="post">
<input type="hidden" name="department_id" value="'.$dept.'">
		<input type="hidden" name="program_id" value="'.$prog.'">
		<input type="hidden" name="semester_id" value="'.$sem.'">
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
?>