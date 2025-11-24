<?php
include "newfiles/conn.php";
include "newfiles/common.php";

$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui-new/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui-new/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui-new/demo/demo.css");

$doc->addScript(JURI::root( true )."/jquery-easyui-new/jquery-1.6.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui-new/jquery.easyui.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui-new/datagrid-detailview.js");


if (isset($_POST['sel_dep_id']))
	$department=$_POST['sel_dep_id'];
else
	$department=-1;

// if (isset($_POST['sel_prog_id']))
// 	$program=$_POST['sel_prog_id'];
// else
// 	$program=-1;

if (isset($_POST['sel_sem_id']))
	$SemID=$_POST['sel_sem_id'];
else
	$SemID=-1;
	
// if (isset($_POST['sel_co_id']))
// 	$course_id=$_POST['sel_co_id'];
// else
// 	$course_id=-1;
	
echo"
	<h3> Evaluation Check List</h3>
	  
	";
echo '<table>';
echo'<tr><td>Select Department</td></tr>';
echo'<tr><td>';$department=showDepartmentSel($department);echo'</td><td>'; 
// 	$arr=showProramSelID($department, $program);

// $program=$arr['id'];
// $prog_name=$arr['name'];

// echo'</td></tr>';
 echo'<tr><td>Select Semester</td></tr>'; 
echo'
	<tr>
		<td>';$SemID=showSemSel($SemID, $department, 1, 1);echo'</td><td></td>';
// 		echo '<td>';$course_id=showSemCourses($SemID, $department, $program, $course_id);echo'</td>
 	echo '</tr>';
echo'<tr><td></td><td></td></tr>';
echo'<tr><td></td><td></td></tr>';

echo'</table>';	

$programs = mysqli_query($conn, "SELECT DISTINCT(co.prog_id),p.id FROM `kiusc_course_offered` co JOIN kiusc_programs p ON co.prog_id = p.id
								JOIN kiusc_eval_std es ON co.id=es.c_offer_id where p.dep_id='$department' and co.sem_id='$SemID'");
//$programs = mysqli_query($conn, "SELECT * FROM kiusc_programs where dep_id='$department'");

?>
  
<hr />

<div class="panel-header" style="width: 80%;">
	<div class="panel-title">Student Evaluation Report</div>
    <div class="panel-tool"></div>
</div>  
	
<table style="border:1px solid; width:80%">

<tr style="background-color:lightgoldenrodyellow">
    <th> Total Students </th>
    <th> Students Performed Evaluated </th>
</tr>

<?php
$sno = 0;
$attempt = 0;
$total_students=0;
$evaluated_std=0;
while($prog = mysqli_fetch_assoc($programs))
{
	$prog_id = $prog['id'];

	
	$total_stds = mysqli_query($conn,"SELECT DISTINCT(s.id) FROM `kiusc_students` s JOIN kiusc_results r ON s.id=r.stud_id where s.prog_id='$prog_id' and r.sem_id='$SemID'");
	while($total_std = mysqli_fetch_assoc($total_stds))
	{
		$total_students++;
		$std_id = $total_std['id'];
		$eval_stds = mysqli_query($conn, "SELECT * FROM kiusc_eval_std WHERE std_id='$std_id'");
		$eval_std = mysqli_num_rows($eval_stds);
		if($eval_std > 0)
			$evaluated_std++;
	}
	
}
?>
<tr>
	<td><?php echo $total_students ?></td>
	<td><?php echo $evaluated_std ?></td>
</tr>
</table>
<hr />

<table style="width:70%; margin-left:50px; ">
<tr>
	<th> Total Students </th> <td width="120px"> <?php echo $total_students; ?> </td>
    <th> Students Attempt Evaluation </th> <td width="120px"> <?php echo $evaluated_std; ?> </td>
    <th> Percentage </th> <td> <?php 
	if($total_students == 0)
		echo "0";
	else
		echo round($evaluated_std/$total_students * 100,2); 
		?> % </td>
</tr>    
</table>

<?php
/////////////////////////////////////////////////////////////////////////////////////
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