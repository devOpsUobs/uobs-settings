<?php
include '../conn.php';
?>
<tr>    
	 <td> 
	 <select name="cat_id[]" style="width:250px">
	 <?php
		$categories = mysqli_query($conn, "SELECT * FROM `kiusc_tel_categories`");
		while($cat = mysqli_fetch_assoc($categories))
		{ 
			echo '<option value="' . $cat['id'] . '" > ' . $cat['name'] . ' </option>';
		}
		?>
	</select>
	</td>
	
	<td> <input type="button" onclick="deleteRow(this, 'tbl_cat')" value="Delete" /> </td>
</tr>