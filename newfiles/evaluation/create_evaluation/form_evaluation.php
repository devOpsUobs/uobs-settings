<form method="post">
	<table class="dv-table" style="width:100%;border:1px solid #ccc;padding:5px;margin-top:5px;">
		<tr>
			<td>Description</td>
			<td><input name="description" class="easyui-validatebox"></input></td>
			<td>Start Date</td>
			<td><input type="date" name="start_date" /></td>
			<td>End Date</td>
			<td><input type="date" name="end_date" /></td>
		</tr>
		<tr>
			<td> Select Semester: </td>
			<td>
				<select name="sem_id">
					<?php
					include "../../conn.php";
					$semester = mysqli_query($conn, "select * from kiusc_semesters where active = 1");
					while ($sem = mysqli_fetch_assoc($semester)) {
						echo "<option value='" . $sem['id'] . "'> " . $sem['sem_name'] . " </option>";
					}
					?>
				</select>
			</td>
			<td> Enable for students: </td>
			<td> <input type="checkbox" name="enable_std" value="1" /> </td>
			<td> Enable for Faculty: </td>
			<td> <input type="checkbox" name="enable_fac" value="1" /> </td>
			<td> Active: </td>
			<td> <input type="checkbox" name="active" value="1" /> </td>
		</tr>

	</table>
	<div style="padding:5px 0;text-align:right;padding-right:30px">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" plain="true"
			onclick="save1(this)">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" plain="true"
			onclick="cancel1(this)">Cancel</a>
	</div>
</form>
<script type="text/javascript">
	function save1(target) {
		var tr = $(target).closest('.datagrid-row-detail').closest('tr').prev();
		var index = parseInt(tr.attr('datagrid-row-index'));
		saveItem(index);
	}
	function cancel1(target) {
		var tr = $(target).closest('.datagrid-row-detail').closest('tr').prev();
		var index = parseInt(tr.attr('datagrid-row-index'));
		console.log(index)
		cancelItem(index);
	}
</script>