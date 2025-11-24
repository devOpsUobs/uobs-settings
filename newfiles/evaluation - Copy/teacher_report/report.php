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

if (isset($_POST['sel_dep_id']))
	$department=$_POST['sel_dep_id'];
else
	$department=-1;

if (isset($_POST['sel_prog_id']))
	$program=$_POST['sel_prog_id'];
else
	$program=-1;

if (isset($_POST['sel_sem_id']))
	$SemID=$_POST['sel_sem_id'];
else
	$SemID=-1;
	
if (isset($_POST['sel_co_id']))
	$course_id=$_POST['sel_co_id'];
else
	$course_id=-1;
	
echo"
	<h3> Evaluation Check List</h3>
	  
	";
echo '<table>';
echo'<tr><td>Select Department</td><td>Select Program</td></tr>';
echo'<tr><td>';$department=showDepartmentSel($department);echo'</td><td>'; 
$arr=showProramSelID($department, $program);

$program=$arr['id'];
$prog_name=$arr['name'];

echo'</td></tr>';
echo'<tr><td>Select Semester</td><td>Select Course</td></tr>'; 
echo'<tr><td>';$SemID=showSemSel($SemID, $department, $program, 1);echo'</td><td>';$course_id=showSemCourses($SemID, $department, $program, $course_id);echo'</td></tr>';
echo'<tr><td></td><td></td></tr>';
echo'<tr><td></td><td></td></tr>';

echo'</table>';	

?>


<hr />

<?php
if($course_id > 0)
{
?>
<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="exportDetail()">Download Report</a>

 <form id="fm1" method="post" action="<?php echo JURI::root( true ) ?>/newfiles/evaluation/teacher_report/phpExcelReport.php" target="_blank">
			<input type="hidden" name="dept_id" value="<?php echo $department ?>">
            <input type="hidden" name="sem_id" value="<?php echo $SemID ?>" />
            <input type="hidden" name="cf_id" value="<?php echo $course_id ?>" />
 </form>
 
  <script type='text/javascript'>
	function exportDetail(){
		
			$("#fm1").trigger("submit");
		}
	
	</script>
<?php } ?>

<?php /// functions

function showSemCourses($SemID, $department, $program, $course_id)
{
$db = JFactory::getDBO();    
	$query = $db->getQuery(true);
    $query->select('coff.id as id, co.name as name');
    $query->from("kiusc_course_offered coff");
	$query->join('INNER', $db->quoteName('kiusc_courses', 'co') . ' ON (' . $db->quoteName('coff.course_id') . ' = ' . $db->quoteName('co.id') . ')');
	$query->where("coff.prog_id=".$program." AND coff.sem_id=".$SemID);
	$db->setQuery($query);
	$db->execute();
	$num_rows = $db->getNumRows();
    $row = $db->loadAssocList();
	$sel=-1;
	
//echo $query;	   
echo '
<form name="co_select" id="co_select" action="" method="post">';
echo" <input type='hidden' id='sel_dep_id' name='sel_dep_id' value='".$department."'/>";
echo"<input type='hidden' id='sel_prog_id' name='sel_prog_id' value='".$program."'/>";
echo"<input type='hidden' id='sel_sem_id' name='sel_sem_id' value='".$SemID."'/>";
 echo'<select id="sel_co_id" name="sel_co_id">';

 for ($i=0;$i<$num_rows;$i++)
 {
	if ($i==0)
	   $sel=$row[$i]['id'];
	$s="";
   if ($course_id==$row[$i]['id']) 
   {
		$sel=$row[$i]['id'];
     $s=" selected ";
	}
	echo '<option '.$s.' value="'.$row[$i]['id'].'">'.$row[$i]['name'].'</option>';
}
 echo'</select>
 </form>
	<script type="text/javascript">
	$("#sel_co_id").change(function(){
    $("#co_select").trigger("submit");
});
</script>
';
return $sel;
}
?>