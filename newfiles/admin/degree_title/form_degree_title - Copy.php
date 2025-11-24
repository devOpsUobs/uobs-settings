<?php

include "../../conn.php";
?>
<form method="post">
	<table class="dv-table" style="width:100%;border:1px solid #ccc;padding:5px;margin-top:5px;">
		<tr>
			<td>Degree Title</td>
			<td><input name="degree_title" class="easyui-validatebox" required="true" style="width:190px"></input></td>
			<td>No. of Semesters</td>
			<td><input name="no_of_sem" type="text" class="easyui-validatebox" ></input></td>
            <td>Required Cr. Hrs</td>
			<td><input name="req_cr_hours" type="text" class="easyui-validatebox" ></input></td>
		</tr>
        <tr>
			<td>Level</td>
			<td><select name="level" class="easyui-validatebox">
				<option value="BS">BS</option>
				<option value="Master">Master</option>
				<option value="PhD">PhD</option>
				<option value="Associate">Associate</option>
				<option value="Diploma">Diploma</option>
				<option value="BS Bridge">BS Bridge</option>
				<option value="PGD">PGD</option>
				<option value="MS">MS</option>
				</select></td>
			<td>Years</td>
			<td><select name="years" class="easyui-validatebox">
			<option value="16 Years">16 Years</option>
				<option value="Master">18 Years</option>
				<option value="PhD">PhD</option>
				</select></td>
            <td>Final Degree Title</td>
			<td><input name="f_degree_title" type="text" class="easyui-validatebox" ></input></td>
		</tr>
	</table>
	<div style="padding:5px 0;text-align:right;padding-right:30px">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="save1(this)">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancel1(this)">Cancel</a>
	</div>
</form>
<script type="text/javascript">
	function save1(target){
		var tr = $(target).closest('.datagrid-row-detail').closest('tr').prev();
		var index = parseInt(tr.attr('datagrid-row-index'));
		saveItem(index);
	}
	function cancel1(target){
		var tr = $(target).closest('.datagrid-row-detail').closest('tr').prev();
		var index = parseInt(tr.attr('datagrid-row-index'));
		console.log(index)
		cancelItem(index);
	}
</script>