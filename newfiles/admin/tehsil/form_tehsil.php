<?php

include "../../conn.php";

$dis = mysqli_query($conn,"select * from kiusc_districts");
?>

<script type="text/javascript">

function getText()
{
	var sel = document.getElementById("district_id");
	document.getElementById("district_name").value = sel.options[sel.selectedIndex].text;
}

</script>

<form method="post">
	<table class="dv-table" style="width:100%;border:0px solid #ccc;padding:5px;margin-top:5px;">
		<tr>
			<td>Tehsil Name</td>
			<td><input name="name" class="easyui-validatebox" required="true"></input></td>
			<td>District</td>
			<td> <select name="district_id" class="easyui-validatebox" onchange="getText()" id="district_id">
					<?php while($row = mysqli_fetch_assoc($dis)){ ?>
                       <option value="<?php echo $row['id'] ?>"> <?php echo $row['name'] ?>  </option>
                       
					<?php } ?>
            	</select></td>
		</tr>
        <input name="district_name" type="hidden" id="district_name" ></input>
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