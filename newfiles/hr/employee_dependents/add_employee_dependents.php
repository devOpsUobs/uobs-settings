<?php
$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/demo.css");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.easyui1.min.js");

include 'newfiles/common.php';
include 'newfiles/conn.php';
include 'newfiles/my_ldap.php';
$emp_id=$_GET['emp_id'];

if (checkPermission(JFactory::getUser(), "HRM")==0)
{
	echo"You dont have right to access this page!";
	return;
}
if(isset($_POST['submit']))
{
	$verified = 0;
	$verified =  $_POST['verified'];

	mysqli_query($conn, "UPDATE `kiusc_employees` SET `verified`='$verified' WHERE id='$emp_id'");
}
$employees = mysqli_query($conn, "select * from kiusc_employees WHERE id='$emp_id'");
$employee = mysqli_fetch_assoc($employees);
$verified="";
if($employee['verified'] == 1)
	$verified="Checked";
if(isset($_POST['add_education']))
{
	$is_highest=0;
	$degree_name =  $_POST['degree_name'];
	$degree_title = $_POST['degree_title'];
	$year_of_passing = $_POST['year_of_passing'];
	$institute = $_POST['institute'];
	$institute_country = $_POST['institute_country'];
	$examinig_institue = $_POST['examinig_institue'];
	$examinig_institue_country = $_POST['examinig_institue_country'];
	$transcript_no = $_POST['transcript_no'];
	$result_dec_date = $_POST['result_dec_date'];
	$title_of_research = $_POST['title_of_research'];
	$discipline = $_POST['discipline'];
	$sub_discipline = $_POST['sub_discipline'];
	$specialized_area = $_POST['specialized_area'];
	$emp_id = $_POST['emp_id'];
	if(isset($_POST['is_highest']))
		$is_highest = $_POST['is_highest'];

	$desig_id="";
	if($_POST['emp_edu_id'] != NULL)
	{
		$emp_edu_id = $_POST['emp_edu_id'];
		
		if($is_highest == 1)
		{
			$emp_edu_cur=mysqli_query($conn, "SELECT * FROM `kiusc_emp_educations` where emp_id='$emp_id' and is_highest = 1");
			$emp_edu_cur=mysqli_num_rows($emp_edu_cur);
			if($emp_edu_cur > 0)
			{
				print "<font color='green'> Your Highest Degree is Changed, Please Confirm! </font>";
				mysqli_query($conn, "UPDATE `kiusc_emp_educations` SET `is_highest`='0' WHERE emp_id='$emp_id'");
			}
			
		}
		mysqli_query($conn, "UPDATE `kiusc_emp_educations` SET `emp_id`='$emp_id',`degree_name`='$degree_name',`degree_title`='$degree_title',`year_of_passing`='$year_of_passing',`institute`='$institute',`institute_country`='$institute_country',`examinig_institue`='$examinig_institue',`examinig_institue_country`='$examinig_institue_country',`transcript_no`='$transcript_no',`result_dec_date`='$result_dec_date',`title_of_research`='$title_of_research',`discipline`='$discipline',`sub_discipline`='$sub_discipline',`specialized_area`='$specialized_area',`is_highest`='$is_highest' WHERE id='$emp_edu_id'"); 
	}
	else
	{
		if($is_highest == 1)
		{
			$emp_edu_cur=mysqli_query($conn, "SELECT * FROM `kiusc_emp_educations` where emp_id='$emp_id' and is_highest = 1");
			$emp_edu_cur=mysqli_num_rows($emp_edu_cur);
			if($emp_edu_cur > 0)
			{
				print "<font color='green'> Your Highest Degree is Changed, Please Confirm! </font>";
				mysqli_query($conn, "UPDATE `kiusc_emp_educations` SET `is_highest`='0' WHERE emp_id='$emp_id'");
			}
			
		}
		mysqli_query($conn, "INSERT INTO `kiusc_emp_educations`(`emp_id`, `degree_name`, `degree_title`, `year_of_passing`, `institute`, `institute_country`, `examinig_institue`, `examinig_institue_country`, `transcript_no`, `result_dec_date`, `title_of_research`, `discipline`, `sub_discipline`, `specialized_area`,`is_highest`) VALUES ('$emp_id','$degree_name','$degree_title','$year_of_passing','$institute','$institute_country','$examinig_institue','$examinig_institue_country','$transcript_no','$result_dec_date','$title_of_research','$discipline','$sub_discipline','$specialized_area','$is_highest')"); 
	}
}

$checked="";
if(isset($_POST['edit']))
{
	$edu_id = $_POST['edu_id'];
	$emp_edu=mysqli_query($conn, "SELECT * FROM `kiusc_emp_educations` where id='$edu_id'");
	$emp_edu=mysqli_fetch_assoc($emp_edu);

	if($emp_edu['is_highest'] == 1)
		$checked="Checked";
}
if(isset($_POST['delete']))
{
	$edu_id = $_POST['edu_id'];
	mysqli_query($conn, "DELETE FROM `kiusc_emp_educations` WHERE id='$edu_id'");
}


?>

<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="emp_id" value="<?php echo isset($emp_id) ? $emp_id : "" ?>">
	<h3>Degree Information</h3>
	<table class="table table-striped table-hover">
		<tr>
			<td> Degree/ Certificate Name: </td>
			<td> <input type="text" name="degree_name" style="width:500px" value="<?php echo isset($emp_edu['degree_name']) ? $emp_edu['degree_name'] : "" ?>"/> </td>
		</tr>
		<tr>
			<td> Degree Program/Certificate Title: </td>
			<td> <input type="text" name="degree_title" style="width:500px" value="<?php echo isset($emp_edu['degree_title']) ? $emp_edu['degree_title'] : "" ?>"/> </td>
		</tr>
		<tr>
			<td> Year of Passing: </td>
			<td> <input type="text" name="year_of_passing" style="width:500px" value="<?php echo isset($emp_edu['year_of_passing']) ? $emp_edu['year_of_passing'] : "" ?>"/> </td>
		</tr>
		<tr>
			<td> Institue: </td>
			<td> <input type="text" name="institute" style="width:500px" value="<?php echo isset($emp_edu['institute']) ? $emp_edu['institute'] : "" ?>"/> </td>
		</tr>
		<tr>
			<td> Institue Country: </td>
			<td> <input type="text" name="institute_country" style="width:500px" value="<?php echo isset($emp_edu['institute_country']) ? $emp_edu['institute_country'] : "" ?>"/> </td>
		</tr>
		<tr>
			<td> Examining Institute: </td>
			<td> <input type="text" name="examinig_institue" style="width:500px" value="<?php echo isset($emp_edu['examinig_institue']) ? $emp_edu['examinig_institue'] : "" ?>"/> </td>
		</tr>
		<tr>
			<td> Examining Institute Country: </td>
			<td> <input type="text" name="examinig_institue_country" style="width:500px" value="<?php echo isset($emp_edu['examinig_institue_country']) ? $emp_edu['examinig_institue_country'] : "" ?>"/> </td>
		</tr>
		<tr>
			<td> Transcript No.: </td>
			<td> <input type="text" name="transcript_no" style="width:500px" value="<?php echo isset($emp_edu['transcript_no']) ? $emp_edu['transcript_no'] : "" ?>"/> </td>
		</tr>
		<tr>
			<td> Final Result Declaration Date: </td>
			<td> <input type="date" name="result_dec_date" style="width:500px" value="<?php echo isset($emp_edu['result_dec_date']) ? $emp_edu['result_dec_date'] : "" ?>"/> </td>
		</tr>
		<tr>
			<td> Title of Research: </td>
			<td> <input type="text" name="title_of_research" style="width:500px" value="<?php echo isset($emp_edu['title_of_research']) ? $emp_edu['title_of_research'] : "" ?>"/> </td>
		</tr>
		<tr>
			<td> Discipline: </td>
			<td> <input type="text" name="discipline" style="width:500px" value="<?php echo isset($emp_edu['discipline']) ? $emp_edu['discipline'] : "" ?>"/> </td>
		</tr>
		<tr>
			<td> Sub-Discipline: </td>
			<td> <input type="text" name="sub_discipline" style="width:500px" value="<?php echo isset($emp_edu['sub_discipline']) ? $emp_edu['sub_discipline'] : "" ?>"/> </td>
		</tr>
		<tr>
			<td> Specialized Area: </td>
			<td> <input type="text" name="specialized_area" style="width:500px" value="<?php echo isset($emp_edu['specialized_area']) ? $emp_edu['specialized_area'] : "" ?>"/> </td>
		</tr>
		<tr>
			<td> Is Highest? </td>
			<td> <input type="checkbox" name="is_highest" style="width:500px" value="1" <?php echo $checked ?>/> </td>
		</tr>
		<input type="hidden" name="emp_edu_id" value="<?php echo isset($emp_edu['id']) ? $emp_edu['id'] : "" ?>">
		<tr>
		<td></td>
		<td style="text-align:right">
			<input type="submit" name="add_education" value="Add Education"  class="btn success"/>
		</td>	
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
			<td> Is Verified? </td>
			<td> <input type="checkbox" name="verified" style="width:500px" value="1" <?php echo $verified ?>/> </td>
		</tr>
		<tr>
			<td>
				<input type="submit" name="back" value="Back"  class="btn success"/>
				<input type="submit" name="submit" value="Submit"  class="btn success"/></td>
			<td></td>
		</tr>
	</table>
</form>
<br><br><br>
<?php
if(isset($_POST['back']))
	header("location:faculty-designations?emp_id=".$emp_id."");
?>
<table class="table table-striped table-hover">
	<tr>
		<th>Serial No.</th>
		<th>Degree/ Certificate Name:</th>
		<th>Degree Program/Certificate Title:</th>
		<th>Year of Passing:</th>
		<th>Institue:</th>
		<th>Institue Country:</th>
		<th>Examining Institute:</th>
		<th>Examining Institute Country:</th>
		<th>Transcript No.:</th>
		<th>Final Result Declaration Date:</th>
		<th>Title of Research:</th>
		<th>Discipline:</th>
		<th>Sub-Discipline:</th>
		<th>Specialized Area:</th>
		<th>Highest Degree:</th>
		<th>Action</th>
	</tr>
	<?php
	$i=0;
	$educations = mysqli_query($conn, "SELECT * FROM `kiusc_emp_educations` where emp_id='$emp_id'");
	while($education = mysqli_fetch_assoc($educations))
	{
		$i++;			
		?>
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $education['degree_name'];?></td>
			<td><?php echo $education['degree_title'];?></td>
			<td><?php echo $education['year_of_passing'];?></td>
			<td><?php echo $education['institute'];?></td>
			<td><?php echo $education['institute_country'];?></td>
			<td><?php echo $education['examinig_institue'];?></td>
			<td><?php echo $education['examinig_institue_country'];?></td>
			<td><?php echo $education['transcript_no'];?></td>
			<td><?php echo $education['result_dec_date'];?></td>
			<td><?php echo $education['title_of_research'];?></td>
			<td><?php echo $education['discipline'];?></td>
			<td><?php echo $education['sub_discipline'];?></td>
			<td><?php echo $education['specialized_area'];?></td>
			<td><?php echo ($education['is_highest'] == '1' ? "Yes" : "No")?></td>
			<td width="100px">
				<form action="" method="POST">
					<input type="hidden" name="edu_id" value="<?php echo isset($education['id']) ? $education['id'] : "" ?>">
					<input type="submit" name="edit" value="Edit" class="btn primary"/>
					<input type="submit" name="delete" value="Delete" class="btn danger"/>
				</form>
			</td>
		</tr>
		<?php
	}
	?>
</table>

<script>
var idno = 1;
function rowAdd() {
	idno++;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
		{
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				jQuery("#tbl").append(xmlhttp.responseText);
            }
        };
        xmlhttp.open("GET", "../../newfiles/ldap/faculty/ajax_addRow.php?idno="+idno, true);
        xmlhttp.send();
}
</script>

<script>
function checkDesignationType(v, no) {
       var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
		{
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				if(xmlhttp.responseText.trim() == "Faculty")
				{
					document.getElementById('adm_dep_id_'+no).value = 0;
					document.getElementById('adm_dep_id_'+no).hidden = true;
					document.getElementById('acc_dep_id_'+no).hidden = false;
				}
				else
				{
					document.getElementById('acc_dep_id_'+no).value = 0;
					document.getElementById('acc_dep_id_'+no).hidden = true;
					document.getElementById('adm_dep_id_'+no).hidden = false;
				}
            }
        };
        xmlhttp.open("GET", "../newfiles/ldap/faculty/ajax_check_designation_type.php?desg_id="+v, true);
        xmlhttp.send();
}

 
$('#cnic').keypress(function(){

  //allow  backspace, tab, ctrl+A, escape, carriage return
  if (event.keyCode == 8 || event.keyCode == 9 
                    || event.keyCode == 27 || event.keyCode == 13 
                    || (event.keyCode == 65 && event.ctrlKey === true) )
                        return;
	
	evt = window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		event.preventDefault();

  var length = $(this).val().length;
	if (length > 14)
		event.preventDefault();  
            
  if(length == 5 || length == 13)
   $(this).val($(this).val()+'-');

 });

</script>
