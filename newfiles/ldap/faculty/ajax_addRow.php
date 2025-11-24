<?php

include "../../conn.php";
$idno = $_GET['idno'];
?>

<tr>
	<td><input type="radio" name="iscurrent" value="<?php echo $idno ?>"> 
		<input type="hidden" name="iscur_control[]" value="<?php echo $idno ?>">
	<td><select name="designation_id[]" style="width:250px" onchange="checkDesignationType(this.value, <?php echo $idno ?>)">
		<option value="0"> Select Designation </option>
		<?php
		$designations = mysqli_query($conn, "SELECT * FROM `kiusc_designations`");
		while($desg = mysqli_fetch_assoc($designations))
		{
			echo '<option value="'.$desg['id'].'"> '.$desg['designation'].' </option> ';
		}
		?>
    	</select>
	</td>
	<td> <input type="date" name="start_date[]" /> </td>
	<td> <input type="date" name="end_date[]" /> </td>
	<td> <select name="acc_department_id[]" id="acc_dep_id_<?php echo $idno ?>">
			<option value="0"> Select Department </option>
		<?php
		$acc_departments = mysqli_query($conn, "SELECT * FROM `kiusc_departments`");
		while($acc_dep = mysqli_fetch_assoc($acc_departments))
		{
			echo '<option value="'.$acc_dep['id'].'"> '.$acc_dep['name'].' </option> ';
		}
		?>
		</select>
	</td>
	<td> <select name="adm_department_id[]" id="adm_dep_id_<?php echo $idno ?>">
			<option value="0"> Select Department </option>
			<?php
			$admin_departments = mysqli_query($conn, "SELECT * FROM `kiusc_admin_departments`");
			while($admi_dep = mysqli_fetch_assoc($admin_departments))
			{
				echo '<option value="'.$admi_dep['id'].'"> '.$admi_dep['name'].' </option> ';
			}
			?>
		</select>
	</td>
</tr>