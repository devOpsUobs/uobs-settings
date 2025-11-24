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
				<?php
					$level = mysqli_query($conn, "SHOW COLUMNS FROM kiusc_degree_titles WHERE Field = 'level'");
					$level = mysqli_fetch_assoc($level);
					
					$level = explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2", $level['Type']));
					foreach($level as $lvl)
					{
						$sel = "";
							// if(isset($emp['level']))
							// {
							// 	if($emp['level'] == $level)
							// 		$sel = " selected ";
							// }
						
						echo "<option value='$lvl' $sel>$lvl</option>";
					}
					?>
				</select></td>
			<td>Years</td>
			<td><select name="years" class="easyui-validatebox">
				<?php
					$years = mysqli_query($conn, "SHOW COLUMNS FROM kiusc_degree_titles WHERE Field = 'years'");
					$years = mysqli_fetch_assoc($years);
					$years = explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2", $years['Type']));
					foreach($years as $year)
					{
						$sel = "";
							// if(isset($emp['years']))
							// {
							// 	if($emp['years'] == $years)
							// 		$sel = " selected ";
							// }
						
						echo "<option value='$year' $sel>$year</option>";
					}
					?>
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