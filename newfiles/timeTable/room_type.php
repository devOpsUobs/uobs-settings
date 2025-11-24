<?php
include "newfiles/conn.php";
include "common.php";
if(checkPermission(JFactory::getUser(),"timetable_setting")==0)
{
	echo "You cannot access this site";	
	return ;
}
if($_POST)
{
	
	$rmt_name= $_POST['rm_type'];

		if($_POST['rt_id'])
		{
			mysqli_query($conn,"UPDATE kiusc_room_type SET roomtype_name='$rmt_name' WHERE id = ". $_POST['rt_id']);

		}
		else
		{
			$a=mysqli_query($conn,"select * from kiusc_room_type where roomtype_name='$rmt_name'");
			$count=mysqli_num_rows($a);
			if($count>0)
			{
				echo "Data already exist";
			}
			else
			{
		mysqli_query($conn,"INSERT INTO kiusc_room_type ( id,roomtype_name) VALUES('','$rmt_name')");
 
			}
		}
}

if(isset($_GET['did']))
{
	$re=mysqli_query($conn,"select * from kiusc_rooms where block_id=". $_GET['did']);
	$no=mysqli_num_rows($re);
	if($no > 0)
	{
		echo "You Cannot delete this...";
	}
	else
	{
	mysqli_query($conn,"delete from kiusc_room_type where id = ". $_GET['did']);
	}
}


if(isset($_GET['eid']))
{
	$res = mysqli_query($conn,"select * from kiusc_room_type where id = ". $_GET['eid']);
	$rmt = mysqli_fetch_assoc($res);
}
?>

<form  action="" method="post">

<fieldset>
 <br><br>
Room Type <input type="text" name="rm_type" value="<?php print isset($rmt['roomtype_name']) ? $rmt['roomtype_name'] : "" ?>"required/>

      <input type="hidden" name="rt_id" value="<?php print isset($rmt['id']) ? $rmt['id'] : "" ?>" />
     
     <input type="submit"  value="<?php print isset($rmt['id']) ? "Update" : "Insert" ?>" />
	   
	   </fieldset>
</form>

<br />


<table cellpadding="5px" cellspacing="2px" width="600" border="1" align="center" style="background-color:#CCC">
  <tr>
    <th>ID</th>
    <th>Room Type</th>
    <th>Action</th>
    
 </tr>
  <?php 
  $re = mysqli_query($conn,"select * from kiusc_room_type"); 
  while($r = mysqli_fetch_assoc($re))
	{
  ?>
  <tr>
    <td><?php echo $r['id'] ?></td>
    <td><?php echo $r['roomtype_name'] ?></td>

    <td><a href="<?php echo JURI::root(true)?>/index.php/cms-admin/time-table/room-type?eid=<?php echo $r['id'] ?>"> Edit </a> | <a href="index.php/cms-admin/time-table/room-type?did=<?php echo $r['id'] ?>"> Delete </a></td>
  </tr>
 <?php } ?>
 
</table>
