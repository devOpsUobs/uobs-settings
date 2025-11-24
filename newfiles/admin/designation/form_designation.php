<?php

include "../../conn.php";
?>
<form method="post">
	<table class="dv-table" style="width:100%;border:1px solid #ccc;padding:5px;margin-top:5px;">
		<tr>
			<td>Designation</td>
			<td><input name="designation" class="easyui-validatebox" required="true"></input></td>
			<td>Type</td>
			<td><select name="type" class="easyui-validatebox">
				<?php
					$type = mysqli_query($conn, "SHOW COLUMNS FROM kiusc_designations WHERE Field = 'type'");
					$type = mysqli_fetch_assoc($type);
					$type = explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2", $type['Type']));
					foreach($type as $type)
					{
						$sel = "";
							// if(isset($emp['type']))
							// {
							// 	if($emp['type'] == $type)
							// 		$sel = " selected ";
							// }
						
						echo "<option value='$type' $sel>$type</option>";
					}
					?>
				</select> </td>
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