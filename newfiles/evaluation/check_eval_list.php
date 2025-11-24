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
echo'<tr><td>Select Semester</td><td></td></tr>'; 
echo'<tr><td>';$SemID=showSemSel($SemID, $department, $program, 1);echo'</td><td></td>
</tr>';
echo'<tr><td></td><td></td></tr>';
echo'<tr><td></td><td></td></tr>';

echo'</table>';	

?>

  
<hr />

<div class="panel-header" style="width: 100%;">
	<div class="panel-title">Student Evaluation Check List</div>
    <div class="panel-tool"></div>
</div>  
	
<table style="border:1px solid; width:100%">

<tr style="background-color:lightgoldenrodyellow">
	<th style="border:1px solid"> SNo. </th>
    <th style="border:1px solid"> Reg # </th>
    <th style="border:1px solid"> Name </th>

<?php

$course = mysqli_query($conn,"SELECT coff.id as id, co.name
							FROM `kiusc_course_offered` coff
							join kiusc_courses co on co.id = coff.course_id
							where coff.prog_id = '$program' and coff.sem_id='$SemID'");
							$cse_ids = array();
							while($sub = mysqli_fetch_assoc($course))
							{
								$cse_ids[] = $sub['id'];
								$names[] = $sub['name'];
								echo '<th style="border:1px solid"> '.$sub['name'].'</th>';
								// echo '<th style="border:1px solid"> '.$sub['name'].'<br>('.$sub['total_marks'].') </th>';
							}
echo "</tr>";

$rs = mysqli_query($conn,"select DISTINCT st.id as std_id, st.reg_no, st.name  
							FROM kiusc_results AS res  
							INNER JOIN kiusc_course_offered AS cof ON cof.id=res.c_offer_id  
							INNER JOIN kiusc_students AS st ON res.stud_id=st.id 
							where res.sem_id='".$SemID."' AND cof.prog_id ='".$program."' order by st.reg_no");
?>


<?php
$sno = 1;
$attempt = 0;
while($std = mysqli_fetch_assoc($rs))
{	
?>
<tr>
	<td style="border:1px solid"> <?php echo $sno++; ?> </td>
    <td style="border:1px solid"> <?php echo $std['reg_no'] ?> </td>
    <td style="border:1px solid"> <?php echo $std['name'] ?> </td>
	<?php
			for($i = 0; $i < count($cse_ids); $i++)
			{
				$eval = mysqli_query($conn,"SELECT * FROM `kiusc_eval_std` WHERE std_id = '".$std['std_id']."' and c_offer_id = '$cse_ids[$i]'");
				$no_eval = mysqli_num_rows($eval);
				?>
				<td style="border:1px solid"> 
				<?php 
				if($no_eval > 0)
				{
					$attempt++;
					echo "<font color='green'> Yes </font>";
				}
				else
					echo "<font color='red'> No </font>"; ?>
					 </td>
			<?php
				
				}
	?>
    
</tr>
<?php
}
?>
</table>
<hr />

<!-- <table style="width:70%; margin-left:50px; ">
<tr>
	<th> Total Students </th> <td width="120px"> <?php echo $sno; ?> </td>
    <th> Students Attempt Evaluation </th> <td width="120px"> <?php echo $attempt; ?> </td>
    <th> Percentage </th> <td> <?php 
	if($sno == 0)
		echo "0";
	else
		echo round($attempt/$sno * 100,2); 
		?> % </td>
</tr>    
</table> -->

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