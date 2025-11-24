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
	$blk_name= $_POST['block_name'];
	$blk_no= $_POST['block_number'];
	
		if($_POST['b_id'])
	{
	
		mysqli_query($conn,"UPDATE kiusc_blocks SET block_name='$blk_name',block_number='$blk_no' WHERE id = ". $_POST['b_id']);
	}
	else
	{
		$a=mysqli_query($conn,"select * from kiusc_blocks where block_name='$blk_name' and block_number='$blk_no'");
		$count=mysqli_num_rows($a);
		if($count>0)
		{
			echo "Data Already Exist";	
		}
		else
		{
		mysqli_query($conn,"INSERT INTO kiusc_blocks ( id,block_name,block_number) VALUES ('','$blk_name','$blk_no')");
	     print "Insert Successfull";  
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
	mysqli_query($conn,"delete from kiusc_blocks where id = ". $_GET['did']);
	}
}

if(isset($_GET['eid']))
{
	$res = mysqli_query($conn,"select * from kiusc_blocks where id = ". $_GET['eid']);
	$blk = mysqli_fetch_assoc($res);
}

?>




<form  action="" method="post">

<fieldset>
Block Name <input type="text" name="block_name" value="<?php print isset($blk['block_name']) ? $blk['block_name'] : "" ?>" required/>
Block Number <input type="text" name="block_number" value="<?php print isset($blk['block_number']) ? $blk['block_number'] : "" ?>"required/>

      <input type="hidden" name="b_id" value="<?php print isset($blk['id']) ? $blk['id'] : "" ?>" />
     
     <input type="submit"  value="<?php print isset($blk['id']) ? "Update" : "Insert" ?>" />
	   
	   </fieldset>
</form>

<br/>
<table cellpadding="5px" cellspacing="2px" width="600" border="1" align="center" style="background-color:#CCC">
  <tr>
    <th>ID</th>
    <th>Block Name</th>
    <th scope="col">Block Number</th>
    <th>Action</th>
 </tr>
  <?php 
  $re = mysqli_query($conn,"select * from kiusc_blocks"); 
  while($b = mysqli_fetch_assoc($re))
	{
  ?>
  <tr>
    <td><?php echo $b['id'] ?></td>
    <td><?php echo $b['block_name'] ?></td>
    <td><?php echo $b['block_number'] ?></td>
 
     <td><a href="<?php echo JURI::root(true)?>/index.php/cms-admin/time-table/block-setting?eid=<?php echo $b['id'] ?>"> Edit </a> | <a href="index.php/cms-admin/time-table/block-setting?did=<?php echo $b['id'] ?>"> Delete </a></td>
    
  </tr>
 <?php } ?>
 
</table>

