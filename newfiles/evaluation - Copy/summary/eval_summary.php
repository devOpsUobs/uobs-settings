<?php
$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/demo.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/color.css");
$doc->addStyleSheet(JURI::root( true )."/myfiles/mycss.css");

$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.easyui.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/datagrid-filter.js");
$doc->addScript(JURI::root( true )."/myfiles/students/myScripts.js");

include 'newfiles/common.php';
include 'newfiles/conn.php';

if (checkPermission(JFactory::getUser(), "faculty_evaluation")==0)
{
	echo"You dont have right to access this page!";
	return;
}	

$dept_id = -1;
if(isset($_REQUEST['sel_dep_id']))
	$dept_id = $_REQUEST['sel_dep_id'];

$evl_id = -1;
if(isset($_REQUEST['evl_id']))
	$evl_id = $_REQUEST['evl_id'];

	
	
echo'<body>';

echo "Select Department: "; $dept_id = showDepartmentSel($dept_id);
echo "Select Evaluation: "; $evl_id = evalDropDown($conn, $evl_id, $dept_id);


?>


<hr />

<?php
if($dept_id > 0 and $evl_id > 0)
{
?>
<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="exportDetail()">Download Report</a>

 <form id="fm1" method="post" action="<?php echo JURI::root( true ) ?>/newfiles/evaluation/summary/phpExcelReport.php" target="_blank">
			<input type="hidden" name="sel_dep_id" value="<?php echo $dept_id ?>">
            <input type="hidden" name="evl_id" value="<?php echo $evl_id ?>" />
 </form>
 
  <script type='text/javascript'>
	function exportDetail(){
		
			$("#fm1").trigger("submit");
		}
	
	</script>
<?php } ?>

<?php /// functions

function evalDropDown($conn, $evl_id, $dept_id)
{
echo '	
<form id="evl_select" action="" method="post">
<input type="hidden" name="sel_dep_id" value="'.$dept_id.'">
<select name="evl_id" id="evl_id">';

$evaluations = mysqli_query($conn,"select * from kiusc_evaluation where active = 1");
$i=0;
while($eval = mysqli_fetch_assoc($evaluations))
{
	if($i==0)
	{
		$sel_evl_id = $eval['id'];
	}
	$i++;
	$sel = "";
	if($evl_id == $eval['id'])
	{
		$sel = "selected";
		$sel_evl_id = $eval['id'];
	}
 echo" <option value='". $eval['id'] ."' ". $sel ."> ". $eval['description'] ."</option>";
}

echo ' 
</select>
</form>

	<script type="text/javascript">
	$("#evl_id").change(function(){
    $("#evl_select").trigger("submit");
	});

	</script>';
	
return $sel_evl_id;
}
?>