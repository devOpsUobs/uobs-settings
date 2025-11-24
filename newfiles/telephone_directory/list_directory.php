<?php

$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/demo.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/color.css");

$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.easyui.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/datagrid-filter.js");
//$doc->addScript(JURI::root( true )."/myfiles/students/myScripts.js");

include 'newfiles/common.php';
include 'newfiles/conn.php';

if (checkPermission(JFactory::getUser(), "sis_settings")==0)
{
	echo"You dont have right to access this page!";
	return;
}	

$cat_ids = array();
$cat_ids_str = '-1';
if(isset($_POST['cat_ids']))
{
	$cat_ids = $_POST['cat_ids'];
	$cat_ids_str = implode(",", $cat_ids);
}
?>
<script type="text/javascript">
	
	function myformatter2(value,row,index)
		{
		
			var e='<a href=\"add-contact?eid='+row.id+'\" style="color:black !important">Edit</a>';
			
			return e;
			
		}
</script>

<form action="" method="POST">
Select Categories:
<select name="cat_ids[]" multiple>
	<?php
	$categories = mysqli_query($conn, "SELECT * FROM `kiusc_tel_categories`");
	foreach($categories as $cat)
	{
		$sel = " ";
		if(in_array($cat['id'], $cat_ids))
			$sel = " selected ";
		
		echo '<option value="'.$cat['id'].'" '.$sel.'>'.$cat['name'].'</option>';
	}
	?>
</select>
<br>
<input type="submit" value="Search">
</form>

<hr>
<?php
echo'<body>
	<table id="dg" title="Students" class="easyui-datagrid" style="height:800px"
			url="'.JURI::root( true ).'/newfiles/telephone_directory/get_directory.php?cat_ids='.$cat_ids_str.'"
			toolbar="#toolbar" pagination="false"
			rownumbers="true" fitColumns="false" fit="false" singleSelect="true" >
		<thead>
			<tr>
				<th field="id" width="50" sortable="true" hidden="true">ID</th>
				<th field="name" width="100" sortable="true">Name</th>
				<th field="phone_no" width="80" sortable="true">Phone #</th>
				<th field="fax" width="80" sortable="true">Fax</th>
				<th field="extension" width="80" sortable="true">Extension</th>
				<th field="email" width="120" sortable="true">Email</th>
				<th field="cell_no" width="80" sortable="true">Cell #</th>
				<th field="address" width="120" sortable="true">Address</th>
				<th field="designation" width="100" sortable="true">Designation</th>
                <th field="action" width="50" data-options="formatter:myformatter2">Action</th>

			</tr>
		</thead>
	</table>
	<div id="toolbar">';
if (checkPermission(JFactory::getUser(), "ldap_create_account")==1)	
	echo '<a href="index.php/cms-setting/telephone-directory/add-contact" class="easyui-linkbutton" iconCls="icon-add" plain="true">Add Contact</a>';
/*if (checkPermission(JFactory::getUser(), "ldap_create_account")==1)	
	echo '<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editFaculty()">Edit Record</a>';*/

	//echo '<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="exportData()">Export</a>';

echo '</div>';
	
echo'	<form id="edit_fac" method="post" novalidate action="'.JURI::root( true ).'/index.php/faculty-edit-record">
		  <input type="hidden" name="emp_id" value="" id="emp_id">
		</form>';
		
	echo "
	<script type='text/javascript'>
		var url;
		$(function(){
		var dg1 = $('#dg');
			
            dg1.datagrid('enableFilter', [
			{
			
			}
			]);
			
        });
	
	function editFaculty(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				document.getElementById('emp_id').value = row.id;
				document.getElementById('edit_fac').submit();
			}
		}
		
	function myformatter(date){
            var y = date.getFullYear();
            var m = date.getMonth()+1;
            var d = date.getDate();
            
			return ((d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y);
        }
        function myparser(s){
            if (!s) return new Date();
            var ss = (s.split('/'));
            var d = parseInt(ss[0],10);
            var m = parseInt(ss[1],10);
			var y = parseInt(ss[2],10);
            if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
                return new Date(y,m-1,d);
            } else {
                return new Date();
            }
        }
	</script>";
?>