<?php
include 'newfiles/common.php';
include "newfiles/conn.php";


if (checkPermission(JFactory::getUser(), "sis_settings")==0)
{
	echo"You dont have right to access this page!";
	return;
}	

if($_POST)
{
	$name= $_POST['name'];
	$desg= $_POST['desg'];
	$desrp= $_POST['desrp'];
	$per= $_POST['per'];

	$img_name = $_FILES['img']['name'];
	$img_temp = $_FILES['img']['tmp_name'];
	$img_type = $_FILES['img']['type'];
	
	if($img_name != '')
	{
		$name1 = pathinfo($img_name, PATHINFO_FILENAME);
		$extension = pathinfo($img_name, PATHINFO_EXTENSION);
					
		$i = 1;
		// add a suffix of '1' to the file name until it no longer conflicts
		$tmp = $name1;
		while(file_exists("newfiles/code_contributions/images/" . $tmp . "." .$extension)) 
		{
			$tmp = $name1 . $i;
			$i++;
		}
					
		$newname = $tmp. ".". $extension ;
		
		
		$path = "newfiles/code_contributions/images/".$newname;
			
		move_uploaded_file($img_temp, $path);
	}
	
	if($_POST['b_id'] != '')
	{
		mysqli_query($conn, "UPDATE `kiusc_contributions` SET `name`='$name',`designation`='$desg',`description`='$desrp',`priority`='$per' WHERE id= '".$_POST['b_id']."'");
		
		if($img_name != '')
		{
			$ex = mysqli_query($conn, "select * from kiusc_contributions where id = ". $_POST['b_id']);
			$ex = mysqli_fetch_assoc($ex);
			
			unlink($ex['picture']);
			mysqli_query($conn, "UPDATE `kiusc_contributions` SET `name`='$name',`designation`='$desg',`description`='$desrp',`picture` = '$path', `priority`='$per' WHERE id= '".$_POST['b_id']."'");
		}
	}
	else
	{
		mysqli_query($conn, "INSERT INTO `kiusc_contributions`(`id`, `name`, `designation`, `description`, `picture`, `priority`) 
				VALUES (NULL,'$name','$desg','$desrp','$path','$per')");
	     print "Insert Successfull";  
		
	}
}

if(isset($_GET['did']))
{
	$ex = mysqli_query($conn, "select * from kiusc_contributions where id = ". $_GET['did']);
	$ex = mysqli_fetch_assoc($ex);
	
	mysqli_query($conn, "delete from kiusc_contributions where id = ". $_GET['did']);
	unlink($ex['picture']);
}

if(isset($_GET['eid']))
{
	$res = mysqli_query($conn, "select * from kiusc_contributions where id = ". $_GET['eid']);
	$blk = mysqli_fetch_assoc($res);
}

?>



<div align="center">

<form  action="" method="post" enctype="multipart/form-data">

<fieldset>
<table class="table table-bordered table-striped">
<tr>
<td>Name </td> <td><input type="text" name="name" value="<?php print isset($blk['name']) ? $blk['name'] : "" ?>" required/></td></tr>
<tr><td> Designation </td><td><input type="text" name="desg" value="<?php print isset($blk['designation']) ? $blk['designation'] : "" ?>"required/></td></tr>
<tr><td>Description </td><td><textarea name="desrp" required><?php print isset($blk['description']) ? $blk['description'] : "" ?></textarea><br><br>
<tr><td>Priority </td><td><input type="text" name="per" value="<?php print isset($blk['priority']) ? $blk['priority'] : "" ?>"required/></td></tr>
<tr><td>Select Picture </td><td><input type="file" name="img" value="<?php print isset($blk['picture']) ? $blk['picture'] : "" ?>"/></td></tr>


      <input type="hidden" name="b_id" value="<?php print isset($blk['id']) ? $blk['id'] : "" ?>" />
<tr>
	<td colspan="2">     
     <input type="submit"  value="<?php print isset($blk['id']) ? "Update" : "Insert" ?>" />
	   </td>
	   </tr>
	   </table>
	   </fieldset>
</form>
</div>



<br/>
<table border="1px" style="width:100%">
  
  <?php 
  $re = mysqli_query($conn, "select * from kiusc_contributions"); 
  while($b = mysqli_fetch_assoc($re))
	{
  ?>
  <tr>
		<th rowspan="2"><img src = "../../<?php echo $b['picture'] ?>" width="100px" height="100px"></th>
  </tr>
  <tr>
		<th>Name : <?php echo $b['name'] ?></th>
		<th>Designation : <?php echo $b['designation'] ?></th>
  </tr>
  <tr>
		<td colspan="3" rowspan="2"> <?php echo $b['description'] ?> </td>
 </tr>
		<th rowspan="2"><a href="index.php/cms-admin/add-contributions?eid=<?php echo $b['id'] ?>"> Edit </a> |
		<a href="index.php/cms-admin/add-contributions?did=<?php echo $b['id'] ?>"> Delete </a></th>
 </tr>
 <?php } ?>
 
</table>