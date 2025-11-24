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


if (isset($_POST['dep_id']))
	$department_id=$_POST['dep_id'];
else
	$department_id=-1;

	if (isset($_POST['sem_id']))
	$SemID=$_POST['sem_id'];
else
	$SemID=-1;

$prog_ids=array(-1);


// if(isset($_POST['std_block']))
// {
// 	$std_ids = $_POST['std_ids'];
// 	$prog_id = $_POST['prog_id'];
// 	$date = date("Y-m-d");
// 	$exp_date = date("Y-m-d");
// 	$title = 'Account Blocked';
// 	$detail = 'Your SIS Account has been blocked. Please complete the teachers subject evaluations to regain access.';
// 	$blocked = 1;
// 	$user = JFactory::getUser();
	
// 	$evalstdid = array(); /// ids of applicant if checkbox is checked
// 	if(isset($_POST['evalstdid']))
// 		$evalstdid = $_POST['evalstdid'];

// 	foreach($std_ids as $std_id)
// 	{
// 		$student = mysqli_query($conn,"SELECT * FROM `kiusc_students` WHERE `id`='$std_id'");
// 		$stud = mysqli_fetch_assoc($student);
// 		$prog_id = $stud['prog_id'];
// 		echo "INSERT INTO `kiusc_notice_board`(`dep_id`, `prog_id`, `stud_id`, `msg_date`, `exp_date`, `title`, `detail`, `user_id`, `blocked`) VALUES ('$department_id','$prog_id','$std_id','$date','$exp_date','$title','$detail','$user->id','$blocked')";
// 		exit;
// 		mysqli_query($conn,"INSERT INTO `kiusc_notice_board`(`dep_id`, `prog_id`, `stud_id`, `msg_date`, `exp_date`, `title`, `detail`, `user_id`, `blocked`) VALUES ('$department_id','$prog_id','$std_id','$date','$exp_date','$title','$detail','$user->id','$blocked')");
// 	}

// }




?>
<form action="" method="POST">
Select Department:
<select name="dep_id" required>
<?php

$department = mysqli_query($conn,"SELECT * FROM kiusc_departments");
while($dep = mysqli_fetch_assoc($department))
{
	$sel = "";
	if($dep['id'] == $department_id)
		$sel = " selected ";
	
	echo "<option value='".$dep['id']."'".$sel.">".$dep['name']."</option>";
}
?>
</select>
Select Semester:
<select name="sem_id" required>
<?php

$semesters = mysqli_query($conn,"SELECT * FROM kiusc_semesters order by id desc");
while($sem = mysqli_fetch_assoc($semesters))
{
	$sel = "";
	if($sem['id'] == $SemID)
		$sel = " selected ";
	
	echo "<option value='".$sem['id']."'".$sel.">".$sem['sem_name']."</option>";
}
?>
</select>
<br>
<input type="submit" value="Generate" name="generate">
</form>
<br><br>
<?php
if(!isset($_POST['generate']))
	return;

	
?>


<form method="post" action="" >	
<table style="border:1px solid; width:100%">

<tr style="background-color:lightgoldenrodyellow">
	<th style="border:1px solid"> SNo. </th>
    <th style="border:1px solid"> Reg # </th>
    <th style="border:1px solid"> Name </th>
    <th style="border:1px solid"> Program Name </th>
	<!-- <th> <input type="checkbox" name="checkAll">All </th> -->
</tr>
<?php

if($department_id > 0)
{
	$programs = mysqli_query($conn, "SELECT * FROM `kiusc_programs` WHERE dep_id = '$department_id' order by session");
	while($prog = mysqli_fetch_assoc($programs))
	{
		$prog_ids[] = $prog['id'];
			
	}
}

$prog_id_str = implode(",", $prog_ids);

$rs = mysqli_query($conn,"select DISTINCT st.id as std_id, st.reg_no, st.name 
							FROM kiusc_results AS res  
							INNER JOIN kiusc_course_offered AS cof ON cof.id=res.c_offer_id  
							INNER JOIN kiusc_students AS st ON res.stud_id=st.id 
							where res.sem_id='".$SemID."' AND cof.prog_id in ($prog_id_str) order by st.reg_no");
$sno = 1;
while($std = mysqli_fetch_assoc($rs))
{

		$std_program = mysqli_query($conn,"SELECT p.name as pname,p.session,p.group,s.id FROM kiusc_programs p
											join kiusc_students s on s.prog_id = p.id
											WHERE s.id='".$std['std_id']."'");
		$stdprog = mysqli_fetch_assoc($std_program);
		

	$eval = mysqli_query($conn,"SELECT se.* FROM `kiusc_eval_std` se 
								JOIN kiusc_evaluation e on e.id = se.eval_id 
								WHERE se.std_id = '".$std['std_id']."'  and e.sem_id= '".$SemID."'");
	$no_eval = mysqli_num_rows($eval);
	$no_eval_std = mysqli_fetch_assoc($eval);

	if($no_eval > 0)
				{
					continue;
				}
	
	
?>
<tr>
	<input type="hidden" name="sem_id"  value="<?php echo $SemID?>"/>
	<input type="hidden" name="dep_id"  value="<?php echo $department_id ?>"/>
	<input type="hidden" name="std_ids[]"  value="<?php echo $std['std_id']?>"/>
	<td style="border:1px solid"> <?php echo $sno++; ?> </td>
    <td style="border:1px solid"> <?php echo $std['reg_no'] ?> </td>
    <td style="border:1px solid"> <?php echo $std['name'] ?> </td>
    <td style="border:1px solid"> <?php echo $stdprog['pname']."-".$stdprog['session']."-".$stdprog['group'] ?> </td>
	<!-- <td style="border:1px solid"><input type="checkbox" class="eval_std" name="blocked" value="<?php echo $no_eval_std['id'] ?>" <?php echo ($no_eval_std['id'] > 0) ? "checked" : "" ?>"></td> -->
</tr>
<?php
}
?>
<!-- <tr>
		<td colspan=3></td>
		<td colspan=2><input type="submit" name="std_block" value="Save"></td>
</tr> -->
</table>
</form>
<script>
$(':checkbox[name=checkAll]').click (function () {
  $('.eval_std').prop('checked', this.checked);
});
</script>
