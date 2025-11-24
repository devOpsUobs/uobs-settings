<form method="post">
	<table class="dv-table" style="width:100%;border:1px solid #ccc;padding:5px;margin-top:5px;">
		<tr>
			<td>Semester</td>
			<td><input name="sem_name" class="easyui-validatebox" required="true" style="width:190px"></input></td>
			<td>Start Date</td>
			<td><input name="start_date" type="date" class="easyui-validatebox" ></input></td>
            <td>Mid Term Date</td>
			<td><input name="mid_term_date" type="date" class="easyui-validatebox" ></input></td>
		</tr>
        <tr>
			<td>Final Term Date</td>
			<td><input name="final_term_date" type="date" class="easyui-validatebox" style="width:190px" ></input></td>
			<td>Course Offer</td>
			<td><input name="course_offer" type="checkbox" value="1" class="easyui-validatebox" ></input></td>
            <td>Course Reg</td>
			<td><input name="course_reg" type="checkbox" value="1" class="easyui-validatebox" ></input></td>
		</tr>
        <tr>
			<td>Mid Term</td>
			<td><input name="mid_term" type="checkbox" value="1" class="easyui-validatebox" ></input></td>
            <td>Final Term</td>
			<td><input name="final_term" type="checkbox" value="1" class="easyui-validatebox" ></input></td>
            <td>Active</td>
			<td><input name="active" type="checkbox" value="1" class="easyui-validatebox" ></input></td>
		</tr>
        <tr>
			<td>Result Declare</td>
			<td><input name="result_declare" type="checkbox" value="1" class="easyui-validatebox" ></input></td>
            <td>Result Date</td>
			<td><input name="result_date" type="date" class="easyui-validatebox" ></input></td>
            <td></td>
			<td></td>
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