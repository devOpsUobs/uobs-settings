<?php

include "../../conn.php";

$dep = mysqli_query($conn,"select * from kiusc_departments");
$degree_tilte = mysqli_query($conn,"SELECT * FROM `kiusc_degree_titles`");
?>

<script type="text/javascript">

function getText()
{
	var sel = document.getElementById("dep_id");
	document.getElementById("dep_name").value = sel.options[sel.selectedIndex].text;
}

function getDegreeTitleText()
{
	var sel = document.getElementById("degree_title_id");
	document.getElementById("degree_title").value = sel.options[sel.selectedIndex].text;
}

</script>

<form method="post">
	<table class="dv-table" style="width:100%;border:0px solid #ccc;padding:5px;margin-top:5px;">
		<tr>
			<td>Prog. Name</td>
			<td><input name="name" class="easyui-validatebox" required="true"></input></td>
			<td>Group</td>
			<td><input name="group" class="easyui-validatebox" ></input></td>
            <td>Year</td>
			<td><input name="session" class="easyui-validatebox" ></input></td>
		</tr>
        <tr>
			<td>Session</td>
			<td><input name="session_name" class="easyui-validatebox" required="true"></input></td>
			<td>Department</td>
			<td> <select name="dep_id" class="easyui-validatebox" onchange="getText()" id="dep_id">
					<?php while($row = mysqli_fetch_assoc($dep)){ ?>
                    
                       <option value="<?php echo $row['id'] ?>"> <?php echo $row['name'] ?>  </option>
                       
					<?php } ?>
            	</select></td>
			
			<td>Degree Title</td>
			<td> <select name="degree_title_id" class="easyui-validatebox" onchange="getDegreeTitleText()" id="degree_title_id">
					<?php while($dt = mysqli_fetch_assoc($degree_tilte)){ ?>
                    
                       <option value="<?php echo $dt['id'] ?>"> <?php echo $dt['degree_title'].'('.$dt['level'].')' ?>  </option>
                       
					<?php } ?>
            	</select></td>
				
		</tr>
        <input name="dep_name" type="hidden" id="dep_name" ></input>
		<input name="degree_title" type="hidden" id="degree_title" ></input>
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