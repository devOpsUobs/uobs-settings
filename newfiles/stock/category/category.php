<?php 
include 'newfiles/common.php';

if (checkPermission(JFactory::getUser(), "payroll_settings")==0)
{
	echo"You dont have right to access this page!";
	return;
}

$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui-new/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui-new/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui-new/demo/demo.css");

$doc->addScript(JURI::root( true )."/jquery-easyui-new/jquery-1.6.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui-new/jquery.easyui.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui-new/datagrid-detailview.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/datagrid-filter.js");




?>

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
						href:'<?php echo JURI::root( true ) ?>/newfiles/stock/category/form.php?index='+index,
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
			var url = row.isNewRecord ? '<?php echo JURI::root( true ) ?>/newfiles/stock/category/save.php' : '<?php echo JURI::root( true ) ?>/newfiles/stock/category/update.php?id='+row.id;
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
				$.messager.confirm('Confirm','Are you sure you want to remove this item?',function(r){
					if (r){
						var index = $('#dg').datagrid('getRowIndex',row);
						$.post('<?php echo JURI::root( true ) ?>/newfiles/stock/category/delete.php',{id:row.id},function(s){
																																	   		
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
				   var dg1= $('#dg');
				   dg1.datagrid('enableFilter',[
										{
										}
										]);
				   });
				   
	</script>
</head>
<body>	
	
	<table id="dg" title="My Users" style="height:400px"
			url="<?php echo JURI::root( true ) ?>/newfiles/stock/category/get_data.php"
			toolbar="#toolbar" pagination="false"
			fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="id">ID</th>
				<th field="category" width="40">Category</th>
				<th field="description" width="40">Description</th>
				<th field="active" width="20">Active?</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="newItem()" style="color:black !important">New</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="destroyItem()" style="color:black !important">Delete</a>
	</div>
	
</body>
</html>
<style>
	footer {
    clear: both;
    position: relative;
    /* height: 200px; */
    margin-top: 200px;
}
</style>