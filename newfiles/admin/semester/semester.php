<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="keywords" content="jquery,ui,easy,easyui,web">
	<meta name="description" content="easyui help you build your web page easily!">
    
<?php 

$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui-new/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui-new/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui-new/demo/demo.css");

$doc->addScript(JURI::root( true )."/jquery-easyui-new/jquery-1.6.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui-new/jquery.easyui.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui-new/datagrid-detailview.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/datagrid-filter.js");
include 'newfiles/common.php';

if (checkPermission(JFactory::getUser(), "sis_settings")==0)
{
	echo"You dont have right to access this page!";
	return;
}	

?>
	<style type="text/css">
		form{
			margin:0;
			padding:0;
		}
		.dv-table td{
			border:0;
		}
		.dv-table input{
			border:1px solid #ccc;
		}
	</style>
	
	<script type="text/javascript">
		$(function(){
			$('#dg').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';
				},
				onExpandRow: function(index,row){
					var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
					ddv.panel({
						border:false,
						cache:true,
						href:'<?php echo JURI::root( true ) ?>/newfiles/admin/semester/form_semester.php?index='+index,
						onLoad:function(){
							$('#dg').datagrid('fixDetailRowHeight',index);
							$('#dg').datagrid('selectRow',index);
							$('#dg').datagrid('getRowDetail',index).find('form').form('load',row);
						}
					});
					$('#dg').datagrid('fixDetailRowHeight',index);
				}
			});
		});
		function saveItem(index){
			var row = $('#dg').datagrid('getRows')[index];
			var url = row.isNewRecord ? '<?php echo JURI::root( true ) ?>/newfiles/admin/semester/save_semester.php' : '<?php echo JURI::root( true ) ?>/newfiles/admin/semester/update_semester.php?id='+row.id;
			$('#dg').datagrid('getRowDetail',index).find('form').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(data){
					data = eval('('+data+')');
					data.isNewRecord = false;
					$('#dg').datagrid('collapseRow',index);
					$('#dg').datagrid('updateRow',{
						index: index,
						row: data
					});
				}
			});
		}
		function cancelItem(index){
			var row = $('#dg').datagrid('getRows')[index];
			if (row.isNewRecord){
				$('#dg').datagrid('deleteRow',index);
			} else {
				$('#dg').datagrid('collapseRow',index);
			}
		}
		function destroyItem(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to remove this semester?',function(r){
					if (r){
						var index = $('#dg').datagrid('getRowIndex',row);
						$.post('<?php echo JURI::root( true ) ?>/newfiles/admin/semester/delete_semester.php',{id:row.id},function(s){
		
						if (JSON.parse(s).success)
							$('#dg').datagrid('deleteRow',index);
						});
					}
				});
			}
		}
		function newItem(){
			$('#dg').datagrid('appendRow',{isNewRecord:true});
			var index = $('#dg').datagrid('getRows').length - 1;
			$('#dg').datagrid('expandRow', index);
			$('#dg').datagrid('selectRow', index);
		}
		
		$(function(){
		var dg1 = $('#dg');
            dg1.datagrid('enableFilter', [
			{
			
			}
			]);
			
        });
	</script>
</head>
<body>
	<h2>Semesters</h2>
	<div class="demo-info" style="margin-bottom:10px">
		<div class="demo-tip icon-tip">&nbsp;</div>
		<div>Manage semesters</div>
	</div>
	
	
	<table id="dg" title="My Users" style="width:100%;height:500px"
			url="<?php echo JURI::root( true ) ?>/newfiles/admin/semester/get_semesters.php"
			toolbar="#toolbar" pagination="false"
			fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="sem_name" width="50">Semester</th>
				<th field="start_date" width="50">Start Date</th>
 				<th field="mid_term_date" width="50">Mid Term Date</th>
 				<th field="final_term_date" width="50">Final Term Date</th>
                <th field="course_offer" width="40">Course Offer</th>
                <th field="course_reg" width="40">Course Reg</th>
                <th field="mid_term" width="40">Mid Term</th>
                <th field="final_term" width="40">Final Term</th>
                <th field="active" width="40">Active</th>
                <th field="result_declare" width="50">Result Declare</th>
				<th field="result_date" width="50">Result Date</th>
                
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="newItem()">New</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="destroyItem()">Destroy</a>
	</div>
	
</body>
</html>