<?php
include "newfiles/conn.php";
include 'newfiles/common.php';

if (checkPermission(JFactory::getUser(), "sis_settings")==0)
{
	echo"You dont have right to access this page!";
	return;
}	


if(isset($_POST['create']))
{
	$name = $_REQUEST['name'];
	$phone_no = $_REQUEST['phone_no'];
	$fax = $_REQUEST['fax'];
	$extension = $_REQUEST['extension'];
	$email = $_REQUEST['email'];
	$cell_no = $_REQUEST['cell_no'];
	$address = $_REQUEST['address'];
	$designation = $_REQUEST['designation'];

	if($_POST['dir_id'])
	{
		mysqli_query($conn, "UPDATE `kiusc_tel_directory` SET `name`='$name',`phone_no`='$phone_no',`fax`='$fax',`extension`='$extension',`email`='$email',`cell_no`='$cell_no',`address`='$address',`designation`='$designation' WHERE id = ".$_POST['dir_id']);

		mysqli_query($conn, "DELETE FROM `kiusc_tel_directory_cat` WHERE directory_id = ".$_POST['dir_id']);
		
		$directory_id = $_POST['dir_id'];
		
		$cat_ids = $_REQUEST['cat_id'];
		foreach($cat_ids as $cat_id)
		{
			mysqli_query($conn, "INSERT INTO `kiusc_tel_directory_cat`(`cat_id`, `directory_id`) VALUES ('$cat_id', '$directory_id')");
		}	
			header("location: telephone-directory");

	}
	else
	{	
	
		mysqli_query($conn, "INSERT INTO `kiusc_tel_directory`(`name`, `phone_no`, `fax`, `extension`, `email`, `cell_no`, `address`, `designation`) 
		VALUES ('$name','$phone_no','$fax','$extension','$email','$cell_no','$address','$designation')");
		
		$directory_id = mysqli_insert_id($conn);
		
		$cat_ids = $_REQUEST['cat_id'];
		foreach($cat_ids as $cat_id)
		{
			mysqli_query($conn, "INSERT INTO `kiusc_tel_directory_cat`(`cat_id`, `directory_id`) VALUES ('$cat_id', '$directory_id')");
		}	
		
		echo "<div style='background-color:green; color:white; width:400px; padding: 12px;'>
				<center> <b> Record saved successfully </b> </center>
			</div>
			<hr>
			";
	}
}
$rid="";
if(isset($_GET['eid']))
{
$res=mysqli_query($conn,"SELECT c.name as cname,dc.*,d.* FROM `kiusc_tel_directory_cat` dc
						join kiusc_tel_directory d on d.id=dc.directory_id
						join kiusc_tel_categories c on c.id=dc.cat_id
						WHERE dc.directory_id = ". $_GET['eid']);
$r =mysqli_fetch_assoc($res);
$rid =	$r['id'];
}

?>


<form action="" method="post" enctype="multipart/form-data">

<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%">
<tr>
	<td> Name : </td>
    <td> <input type="text" name="name" style="width:500px" value="<?php print isset($r['name']) ? $r['name'] : "" ?>" required /> </td>
</tr>

<tr>
	<td> Phone # : </td>
    <td> <input type="text" name="phone_no" style="width:500px" value="<?php print isset($r['phone_no']) ? $r['phone_no'] : "" ?>" /> </td>
</tr>

<tr>
	<td> Fax : </td>
    <td> <input type="text" name="fax" style="width:500px"  value="<?php print isset($r['fax']) ? $r['fax'] : "" ?>" /> </td>
</tr>

<tr>
	<td> Extension : </td>
    <td> <input type="text" name="extension" style="width:500px" value="<?php print isset($r['extension']) ? $r['extension'] : "" ?>" /> </td>
</tr>

<tr>
	<td> Email : </td>
    <td> <input type="email" name="email" style="width:500px" value="<?php print isset($r['email']) ? $r['email'] : "" ?>" /> </td>
</tr>

<tr>
	<td> Cell # : </td>
    <td> <input type="text" name="cell_no" style="width:500px" value="<?php print isset($r['cell_no']) ? $r['cell_no'] : "" ?>"/> </td>
</tr>

<tr>
	<td> Address : </td>
    <td> <input type="text" name="address" style="width:500px" value="<?php print isset($r['address']) ? $r['address'] : "" ?>" /> </td>
</tr>

<tr>
	<td> Designation : </td>
    <td> <input type="text" name="designation" style="width:500px" value="<?php print isset($r['designation']) ? $r['designation'] : "" ?>"/> </td>
</tr>
</table>

<h3> Categories </h3>

<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%" id="tbl_cat">

<tr>
	<th> Category </th>
    <th> </th>
</tr>

<?php

$res=mysqli_query($conn,"SELECT c.*,dc.* FROM `kiusc_tel_directory_cat` dc
						join kiusc_tel_directory d on d.id=dc.directory_id
						join kiusc_tel_categories c on c.id=dc.cat_id
						WHERE dc.directory_id = '$rid' ");
$re=mysqli_num_rows($res);
	if($re > 0)
	{
		while($re =mysqli_fetch_assoc($res))
		{

		?>
		<tr> 
		 
		    <td> <select name="cat_id[]" style="width:250px" />
				<?php
				$categories = mysqli_query($conn, "SELECT * FROM `kiusc_tel_categories`");
				while($cat = mysqli_fetch_assoc($categories))
				{
						$sel = "";
					if(isset($re['cat_id']))
					{
					  if($re['cat_id'] == $cat['id'])
						   $sel = "selected";
					}
					echo '<option value="'.$cat['id'].'"'.$sel.'>'.$cat['name'].'</option>';
				}
			
				?>
				 </select>
			</td>
		    <td><input type="button" onclick="deleteRow(this, 'tbl_cat')" value="Delete" /> </td>
		</tr>
		<?php 
			}
		} 
		else
		{
		?>
			<tr>   
				    <td> <select name="cat_id[]" style="width:250px" />
						<?php
						$categories = mysqli_query($conn, "SELECT * FROM `kiusc_tel_categories`");
						while($cat = mysqli_fetch_assoc($categories))
						{
							echo '<option value="'.$cat['id'].'">'.$cat['name'].'</option>';
						}
						?>
						 </select>
					</td>
				    <td> </td>
				</tr>
		<?php
		}
		?>

<tr>
	<td> <input type="hidden" name="dir_id"  value="<?php print isset($rid) ? $rid : "" ?>"/></td>
    <td> <input type="button" onclick="rowCat()" value="Add More Categories" style="background-color: burlywood; border-radius: 17px; color: black;" /> </td>
</tr>

</table>


<input type="submit" name="create" value="<?php print isset($r['id']) ? "Update" : "Save" ?>" style="background-color: burlywood; border-radius: 17px; color: black;" />
</form>



<script>
function deleteRow(o, tbl)
{
	var i = o.closest('tr').rowIndex;
	//alert(o.rowIndex);
	document.getElementById(tbl).deleteRow(i);
}

function rowCat() {
		//var c = document.getElementById("tbl_cat").rows.length;
        //document.getElementById("tbl").innerHTML = "";

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
		{
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				jQuery("#tbl_cat").append(xmlhttp.responseText);
            }
        };
        xmlhttp.open("GET", "../../newfiles/telephone_directory/ajax_addCat.php", true);
        xmlhttp.send();
}
</script>
