<?php
include "newfiles/conn.php";
include 'newfiles/common.php';

if (checkPermission(JFactory::getUser(), "Students_EDIT")==0)
{
	echo"You dont have right to access this page!";
	return;
}

$reg_no = "";
if(isset($_REQUEST['reg_number']))
		$reg_no = $_REQUEST['reg_number'];

if(isset($_POST['std_form']))
{
	$std_id = $_REQUEST['std_id'];
	$prog_id = $_REQUEST['program_id'];
	$department_id = $_REQUEST['department_id'];
	$reg_no = $_REQUEST['reg_no'];
	$name = $_REQUEST['name'];
	$fname = $_REQUEST['fname'];
	$dob = $_REQUEST['dob'];
	$cnic = $_REQUEST['cnic'];
	$cell = $_REQUEST['cell'];
	$permanent_address = $_REQUEST['permanent_address'];
	$gender = $_REQUEST['gender'];
	$remarks = $_REQUEST['remarks'];
	$email = $_REQUEST['email'];
	$district_id = $_REQUEST['district_id'];
	$tehsil_id = $_REQUEST['tehsil_id'];
	$village = $_REQUEST['village'];
	$postal_address = $_REQUEST['postal_address'];
	$guardian_name = $_REQUEST['guardian_name'];
	$father_occupation = $_REQUEST['father_occupation'];
	$guardian_occupation = $_REQUEST['guardian_occupation'];
	$father_phone = $_REQUEST['father_phone'];
	$guardian_phone = $_REQUEST['guardian_phone'];
	$father_phone = $_REQUEST['father_phone'];
	
	$d_id = $_REQUEST['d_id'];
	
	if(isset($_REQUEST['marksheets']))
		$marksheets = $_REQUEST['marksheets'];
	else
		$marksheets = 0;
		
	if(isset($_REQUEST['domicile']))
		$domicile = $_REQUEST['domicile'];
	else
		$domicile = 0;
	
	if(isset($_REQUEST['migration']))
		$migration = $_REQUEST['migration'];
	else
		$migration = 0;
		
	if(isset($_REQUEST['cnic']))
		$cnic = $_REQUEST['cnic'];
	else
		$cnic = 0;
	
	if(isset($_REQUEST['affidavit']))
		$affidavit = $_REQUEST['affidavit'];
	else
		$affidavit = 0;
	
	$img_path = $reg_no . ".jpeg";

if($_FILES['picture']['name'])
{
	if($_FILES['picture']['type'] == "image/gif" || $_FILES['picture']['type'] == "image/jpeg" || $_FILES['picture']['type'] == "image/jpg" || $_FILES['picture']['type'] == "image/png" || $_FILES['picture']['type'] == "image/bmp")
	{
		
		if(move_uploaded_file($_FILES['picture']['tmp_name'], "newfiles/std_pics/".$img_path))
		{ 
				$src_img = imagecreatefromjpeg("newfiles/std_pics/".$img_path); 
				
				   ///////////// resize //////////////
							  $old_x          =   imageSX($src_img);
							  $old_y          =   imageSY($src_img);
						  
							  if($old_x > $old_y) 
							  {
								  $thumb_w    =   150;
								  $thumb_h    =   $old_y*(200/$old_x);
							  }
						  
							  if($old_x < $old_y) 
							  {
								  $thumb_w    =   $old_x*(150/$old_y);
								  $thumb_h    =   200;
							  }
						  
							  if($old_x == $old_y) 
							  {
								  $thumb_w    =   150;
								  $thumb_h    =   200;
							  }
						  
							  $dst_img        =   ImageCreateTrueColor($thumb_w,$thumb_h);
						  
							  imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
				/////////////////   end resize ///////////////
				
				imagejpeg($dst_img, "newfiles/std_pics/".$img_path, 80);
				
				imagedestroy($dst_img);
				imagedestroy($src_img);
		}
		else
		{
			echo "Could not upload picture";
		}
		
	}
	else
	{
		echo "File formate should be jpg, gif, png, bmp";
	}
}
			mysqli_query($conn,"UPDATE `kiusc_students` SET `prog_id`='$prog_id', `department_id`='$department_id', `name`='$name', `fname`='$fname', `dob`='$dob', `cnic`='$cnic', `cell`='$cell', `permanent_address`='$permanent_address', `gender`='$gender', `remarks`='$remarks', `email`='$email', `district_id`='$district_id', `tehsil_id`='$tehsil_id', `village`='$village', `postal_address`='$postal_address', `guardian_name`='$guardian_name', `father_occupation`='$father_occupation', `guardian_occupation`='$guardian_occupation', `father_phone`='$father_phone', `guardian_phone`='$guardian_phone', `picture`='$img_path' WHERE id = $std_id");
			
			//////////////  Student Documents////
			
			if($d_id)
			{
				mysqli_query($conn,"UPDATE `kiusc_std_documents` SET `marksheets`='$marksheets', `domicile`='$domicile', `migration`='$migration', `cnic`='$cnic', `affidavit`='$affidavit' WHERE id = $d_id");
			}
			else
			{
				mysqli_query($conn,"INSERT INTO `kiusc_std_documents`(`stud_id`, `marksheets`, `domicile`, `migration`, `cnic`, `affidavit`) VALUES ('$std_id','$marksheets','$domicile','$migration','$cnic','$affidavit')");
			}
			
			////////////////////////////////////
			
			/////// Qualifications ///////
			$qual_id = $_REQUEST['qual_id'];
			$degree_id = $_REQUEST['degree_id'];
			$institute = $_REQUEST['institute'];
			$year = $_REQUEST['year'];
			$division = $_REQUEST['division'];
			$total_marks = $_REQUEST['total_marks'];
			$obtained_marks = $_REQUEST['obtained_marks'];
			$total_gpa = $_REQUEST['total_gpa'];
			$gpa = $_REQUEST['gpa'];
			$major_subjects = $_REQUEST['major_subjects'];
			$board = $_REQUEST['board'];
			
			$i = 0;
			foreach($degree_id as $deg)
			{
				if($qual_id[$i])
				{
					mysqli_query($conn,"UPDATE `kiusc_st_qualification` SET `degree_id`='$degree_id[$i]', `institute`='$institute[$i]',`year`='$year[$i]',`division`='$division[$i]',`total_marks`='$total_marks[$i]', `obtained_marks`='$obtained_marks[$i]', `total_gpa`='$total_gpa[$i]',`gpa`='$gpa[$i]', `major_subjects`='$major_subjects[$i]', `board`='$board[$i]' WHERE id = '$qual_id[$i]'");
				}
				else
				{
					if($year[$i])
					{
						mysqli_query($conn,"INSERT INTO `kiusc_st_qualification`(`id`, `stud_id`, `degree_id`, `institute`, `year`, `division`, `total_marks`, `obtained_marks`, `total_gpa`, `gpa`, `major_subjects`, `board`) VALUES (NULL,'$std_id','$degree_id[$i]', '$institute[$i]','$year[$i]','$division[$i]','$total_marks[$i]','$obtained_marks[$i]', '$total_gpa[$i]', '$gpa[$i]', '$major_subjects[$i]', '$board[$i]')");
					}
					
					
				}
				$i++;
			}
			
		
	
	
	
}

$db = JFactory::getDBO();    
	$query = $db->getQuery(true);
    $query->select('s.*, s.id as std_id, s.cnic as s_cnic, d.*, d.id as d_id')
		  ->from("kiusc_students s")
		  ->join("LEFT","kiusc_std_documents d on s.id = d.stud_id")
		  ->where("reg_no='".$reg_no."'");
		  
	$db->setQuery($query);
	$db->execute();
    $std = $db->loadAssoc();

$db = JFactory::getDBO();    
	$query = $db->getQuery(true);
    $query->select('q.*, d.degree_title')
		  ->from("kiusc_st_qualification q")
		  ->join("INNER","kiusc_degrees d on q.degree_id = d.id")
		  ->where("stud_id='".$std['std_id']."'")
		  ->order('degree_id ASC');
		  
	$db->setQuery($query);
	$db->execute();
    $qualifications = $db->loadAssocList();
	
$db = JFactory::getDBO();    
	$query = $db->getQuery(true);
    $query->select('*')
		  ->from("kiusc_degrees")
		 ->order('id ASC');
		  
	$db->setQuery($query);
	$db->execute();
    $degrees = $db->loadAssocList();


$db = JFactory::getDBO();    
	$query = $db->getQuery(true);
    $query->select('*')
		  ->from("kiusc_districts");
		  
	$db->setQuery($query);
	$db->execute();
    $district = $db->loadAssocList();

$db = JFactory::getDBO();    
	$query = $db->getQuery(true);
    $query->select('*')
		  ->from("kiusc_tehsils")
		  ->where("district_id ='". $std['district_id']. "'");
		  
	$db->setQuery($query);
	$db->execute();
    $tehsil = $db->loadAssocList();
	
$db = JFactory::getDBO();    
	$query = $db->getQuery(true);
    $query->select('*')
		  ->from("kiusc_departments");
		  
	$db->setQuery($query);
	$db->execute();
    $departments = $db->loadAssocList();

$db = JFactory::getDBO();    
	$query = $db->getQuery(true);
    $query->select('*')
		  ->from("kiusc_programs")
		  ->where("dep_id ='". $std['department_id']. "'");
		  
	$db->setQuery($query);
	$db->execute();
    $programs = $db->loadAssocList();
	
?>

<script>
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                jQuery('#img')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<form action="" method="post">
<table>
<tr>
<td> Reg # :  </td>
<td> <input type="text" name="reg_number" value="<?php echo $reg_no; ?>" /> </td>
<td> <input type="submit" /> </td>
</tr>
</table>
</form>

<hr />

<form action="" method="post" enctype="multipart/form-data">

<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%">
<input type="hidden" name="std_id" value="<?php echo $std['std_id'] ?>" />
<tr>
	<td> Application No. : </td>
    <td> <input type="text" name="application_no" value="<?php echo $std['application_no'] ?>" readonly style="width:500px" /> </td>
</tr>

<tr>
	<td> Registration No. : </td>
    <td> <input type="text" name="reg_no" value="<?php echo $std['reg_no'] ?>" readonly style="width:500px" /> </td>
</tr>

<tr>
	<td> Image : </td>
    <td> 
    <img src="newfiles/std_pics/<?php echo $std['picture'] ?>" style="width: 150px; height: 200px;border: 5px solid;" id="img" />
    <input type="file" name="picture" onchange="readURL(this)"/>
     </td>
</tr>

<tr>    
	<td> Department: </td>
    <td> <select name="department_id" id="department_id" style="width:500px">
    <?php foreach($departments as $dep):
			$sel = "";
			if($dep['id'] == $std['department_id'])
				$sel = "selected";
				?>
    		<option value="<?php echo $dep['id'] ?>" <?php echo $sel ?> > <?php echo $dep['name'] ?> </option>
    <?php endforeach; ?>
    	</select></td>
</tr>

<tr>        
    <td> Program : </td>
    <td> <select name="program_id" id="program_id"style="width:500px">
    <?php foreach($programs as $prog):
				$sel = "";
			if($prog['id'] == $std['prog_id'])
				$sel = "selected"; ?>
    		<option value="<?php echo $prog['id'] ?>" <?php echo $sel ?> > <?php echo $prog['name']. '-' . $prog['session']?> </option>
    <?php endforeach; ?>
    	</select></td>
</tr>

<tr>
    <td>  Gender: </td>
    <td> <input type="text" name="gender" value="<?php echo $std['gender'] ?>" style="width:500px" /> </td>    
</tr>

<tr>
	<td> Student's Name : </td>
    <td> <input type="text" name="name" value="<?php echo $std['name'] ?>" style="width:500px" /> </td>
</tr>

<tr>
    <td> Father's Name : </td>
    <td> <input type="text" name="fname" value="<?php echo $std['fname'] ?>" style="width:500px" /> </td>
</tr>

<tr>   
    <td> Guardian's Name : </td>
    <td> <input type="text" name="guardian_name" value="<?php echo $std['guardian_name'] ?>" style="width:500px" /> </td>
</tr>

<tr>
	<td> DOB : </td>
    <td> <input type="text" name="dob" value="<?php echo $std['dob'] ?>" style="width:500px"/> </td>
</tr>

<tr>    
    <td> CNIC : </td>
    <td> <input type="text" name="cnic" value="<?php echo $std['s_cnic'] ?>" style="width:500px"/> </td>
</tr>

<tr>    
    <td> Postal Address : </td>
    <td> <input type="text" name="postal_address" value="<?php echo $std['postal_address'] ?>" style="width:500px" /> </td>
</tr>

<tr>
	<td> Permanent Address : </td>
    <td> <input type="text" name="permanent_address" value="<?php echo $std['permanent_address'] ?>" style="width:500px" /> </td>    
</tr>

<tr>    
    <td> District: </td>
    <td> <select name="district_id" id="district_id"  style="width:500px">
		<option value=""> Select District </option>
    <?php foreach($district as $dis):
			$sel = "";
			if($dis['id'] == $std['district_id'])
				$sel = "selected";
				?>
    		<option value="<?php echo $dis['id'] ?>" <?php echo $sel ?> > <?php echo $dis['name'] ?> </option>
    <?php endforeach; ?>
    	</select></td>
</tr>

<tr>        
    <td> Tehsil : </td>
    <td> <select name="tehsil_id" id="tehsil_id" style="width:500px">
		<option value="0"> Select Tehsil </option>
    <?php foreach($tehsil as $teh):
				$sel = "";
			if($teh['id'] == $std['tehsil_id'])
				$sel = "selected"; ?>
    		<option value="<?php echo $teh['id'] ?>" <?php echo $sel ?> > <?php echo $teh['name'] ?> </option>
    <?php endforeach; ?>
    	</select></td>    
</tr>

<tr>  
    <td>  Village: </td>
    <td> <input type="text" name="village" value="<?php echo $std['village'] ?>" style="width:500px"/> </td>
</tr>

<tr>    
    <td>  Father's Occupation: </td>
    <td> <input type="text" name="father_occupation" value="<?php echo $std['father_occupation'] ?>" style="width:500px"/> </td>
</tr>

<tr>
    <td>  Father's Phone #: </td>
    <td> <input type="text" name="father_phone" value="<?php echo $std['father_phone'] ?>" style="width:500px"/> </td>
</tr>

<tr>  
	<td> Guardian's Occupation : </td>
    <td> <input type="text" name="guardian_occupation" value="<?php echo $std['guardian_occupation'] ?>" style="width:500px"/> </td>
</tr>

<tr>   
    <td>  Guardian's Phone #: </td>
    <td> <input type="text" name="guardian_phone" value="<?php echo $std['guardian_phone'] ?>" style="width:500px"/> </td>
</tr>

<tr>
    <td> Applicant's Email : </td>
    <td> <input type="text" name="email" value="<?php echo $std['email'] ?>" style="width:500px"/> </td>
</tr>

<tr>  
	<td>  Cell #: </td>
    <td> <input type="text" name="cell" value="<?php echo $std['cell'] ?>" style="width:500px"/> </td>
</tr>

<tr>
    <td> Remarks : </td>
    <td colspan="3"> <input type="text" name="remarks" value="<?php echo $std['remarks'] ?>" style="width:500px" /> </td>
</tr>

<tr>
    <td> Documents : </td>
    <td> 
    	<input type="hidden" name="d_id" value="<?php echo isset($std['d_id']) ? $std['d_id'] : "" ?>"/>
        
        Marksheets: <input type="checkbox" name="marksheets" value="1" <?php echo ($std['marksheets'] == 1) ? "checked" : "" ?>/> |
        Domicile: <input type="checkbox" name="domicile" value="1" <?php echo ($std['domicile'] == 1) ? "checked" : "" ?>/> | 
        Migration: <input type="checkbox" name="migration" value="1" <?php echo ($std['migration'] == 1) ? "checked" : "" ?>/> | 
        CNIC: <input type="checkbox" name="cnic" value="1" <?php echo ($std['cnic'] == 1) ? "checked" : "" ?>/> | 
        Affidavit: <input type="checkbox" name="affidavit" value="1" <?php echo ($std['affidavit'] == 1) ? "checked" : "" ?>/>  
    </td>
</tr>


</table>

<br />

<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%" id="tbl">

<tr>
	<th>  Degree </th>
    <th>  Institution </th>
    <th> Year </th>
    <th> Division </th>
     <th> Type </th>
    <th> Obt Marks </th>
    <th> Total Marks </th>
    <th> GPA </th>
    <th> Total GPA </th>
    <th> Major Subjects </th>
    <th> Board </th>
</tr>



<?php
$i = 0;
foreach($qualifications as $qual):
$i++;
?>
<tr>
	 <td>
     	<input type="hidden" name="qual_id[]" value="<?php echo $qual['id'] ?>" />
        
      <select name="degree_id[]" style="width:250px">
    <?php
		
		foreach($degrees as $deg):
				
				$sel = "";
			if ($deg['id'] == $qual['degree_id'])
				$sel = "selected"; ?>
    		<option value="<?php echo $deg['id'] ?>" <?php echo $sel ?> > <?php echo $deg['degree_title'] ?> </option>
    <?php endforeach; ?>
    	</select></td>
        
    <td>  <input type="text" name="institute[]" value="<?php echo $qual['institute']; ?>" style="width:170px" /> </td>
    <td>  <input type="text" name="year[]" style="width:70px" value="<?php echo $qual['year']; ?>" /> </td>
    <td>  <input type="text" name="division[]" style="width:70px" value="<?php echo $qual['division']; ?>" /> </td>
    
    <td> Marks : <input type="radio" name="<?php echo $i; ?>" id="type_marks<?php echo $i; ?>" onclick="typeChange(this)" <?php echo (($qual['obtained_marks'] == 0) ? "" : "checked") ?>/>
    	GPA:<input type="radio" name="<?php echo $i; ?>"  id="type_gpa<?php echo $i; ?>" onclick="typeChange(this)" <?php echo (($qual['gpa']==0) ? "" : "checked") ?> /> </td>
        
    <td>  <input type="text" name="obtained_marks[]" style="width:80px" id="obtained_marks<?php echo $i; ?>" value="<?php echo $qual['obtained_marks']; ?>" <?php echo (($qual['obtained_marks'] == 0) ? "readonly" : "") ?> /> </td>
    <td>  <input type="text" name="total_marks[]" style="width:80px" id="total_marks<?php echo $i; ?>" value="<?php echo $qual['total_marks']; ?>" <?php echo (($qual['total_marks'] == 0 ) ? "readonly" : "") ?> />  </td>
    <td>  <input type="text" name="gpa[]" style="width:70px" id="gpa<?php echo $i; ?>" value="<?php echo $qual['gpa']; ?>" <?php echo (($qual['gpa']==0) ? "readonly" : "") ?> />  </td>
    <td>  <input type="text" name="total_gpa[]" style="width:70px" id="total_gpa<?php echo $i; ?>" value="<?php echo $qual['total_gpa']; ?>" <?php echo (($qual['total_gpa']==0) ? "readonly" : "") ?> /> </td>
    <td> <input type="text" name="major_subjects[]" style="width:170px" value="<?php echo $qual['major_subjects']; ?>" /> </td>
    <td> <input type="text" name="board[]" value="<?php echo $qual['board']; ?>" style="width:100px" />  </td>
</tr>

<?php endforeach; ?>


<tr>
	<td colspan="9"> </td>
    <td> <input type="button" onclick="rowAdd()" value="Add More Qualifications" style="background-color: burlywood; border-radius: 17px; color: black;" /> </td>
</tr>

<tr id="dup">
	 <td>
     	<input type="hidden" name="qual_id[]" value="" />
      <select name="degree_id[]" style="width:250px">
    <?php
			$i++;
		foreach($degrees as $deg): ?>
    		<option value="<?php echo $deg['id'] ?>" > <?php echo $deg['degree_title'] ?> </option>
    <?php endforeach; ?>
    	</select></td>
        
    <td>  <input type="text" name="institute[]" style="width:170px" /> </td>
    <td>  <input type="text" name="year[]" style="width:70px" /> </td>
    <td>  <input type="text" name="division[]" style="width:70px"/> </td>
    <td> Marks : <input type="radio" name="<?php echo $i; ?>" id="type_marks<?php echo $i; ?>" onclick="typeChange(this)" checked/>
    	 GPA:<input type="radio" name="<?php echo $i; ?>"  id="type_gpa<?php echo $i; ?>" onclick="typeChange(this)" /> </td>
    <td>  <input type="text" name="obtained_marks[]" style="width:80px" id="obtained_marks<?php echo $i; ?>" /> </td>
    <td>  <input type="text" name="total_marks[]" style="width:80px" id="total_marks<?php echo $i; ?>" />  </td>
    <td>  <input type="text" name="gpa[]" style="width:70px" id="gpa<?php echo $i; ?>" readonly />  </td>
    <td>  <input type="text" name="total_gpa[]" style="width:70px" id="total_gpa<?php echo $i; ?>" readonly /> </td>
    <td> <input type="text" name="major_subjects[]" style="width:170px"/> </td>
    <td> <input type="text" name="board[]" style="width:100px" />  </td>
</tr>

</table>

<input type="submit" name="std_form" value="Update" style="background-color: burlywood; border-radius: 17px; color: black;" />
</form>



<script>
function rowAdd() {
		var c = document.getElementById("tbl").rows.length;
        //document.getElementById("tbl").innerHTML = "";

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
		{
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				jQuery("#tbl").append(xmlhttp.responseText);
            }
        };
        xmlhttp.open("GET", "../../../newfiles/admin/student/ajax_addRow.php?rows="+c, true);
        xmlhttp.send();
}
</script>


<script language="javascript">
jQuery(document).ready(function() {
			jQuery("#district_id").change(function(){				 
						jQuery.ajax({
							   type: "POST",
								url: "../../../newfiles/admin/student/ajax_get_tehsil.php",
								dataType: 'json',
							   data: "district_id="+jQuery("#district_id").val(),
							   success: function(data)
										{
											jQuery("#tehsil_id").empty();
										for (var i = 0; i < data.rows.length; i++) 
											{
												//alert(data.rows[i].name);
												jQuery("#tehsil_id").append('<option value="'+data.rows[i].id+'"> '+data.rows[i].name+' </option>');
											}
											
											//jQuery("#tehsil_id").append('<option value=""> sssss </option>');
										  /* var $teh = jQuery("#tehsil_id");
                 						   $teh.empty(); // remove old options */
										}
								});
						
						 });
			
			
			
			jQuery("#department_id").change(function(){				 
						jQuery.ajax({
							   type: "POST",
								url: "../../../newfiles/admin/student/ajax_get_program.php",
								dataType: 'json',
							   data: "department_id="+jQuery("#department_id").val(),
							   success: function(data)
										{
											jQuery("#program_id").empty();
											for (var i = 0; i < data.rows.length; i++) 
											{
												//alert(data.rows[i].name);
												jQuery("#program_id").append('<option value="'+data.rows[i].id+'"> '+data.rows[i].name + '-' + data.rows[i].session +' </option>');
											}
											
											//jQuery("#tehsil_id").append('<option value=""> sssss </option>');
										  /* var $teh = jQuery("#tehsil_id");
                 						   $teh.empty(); // remove old options */
										}
								});
						
						 });
						
		   });
			
</script>




<script type="text/javascript">

function typeChange(s)
{
	if(document.getElementById("type_marks"+s.name).checked)
	{
		document.getElementById("gpa"+s.name).readOnly = true;
		document.getElementById("total_gpa"+s.name).readOnly = true;
		document.getElementById("obtained_marks"+s.name).readOnly = false;
		document.getElementById("total_marks"+s.name).readOnly = false;
		///// Clear Text
		document.getElementById("gpa"+s.name).value = "";
		document.getElementById("total_gpa"+s.name).value = "";
	}
	if(document.getElementById("type_gpa"+s.name).checked)
	{
		document.getElementById("gpa"+s.name).readOnly = false;
		document.getElementById("total_gpa"+s.name).readOnly = false;
		document.getElementById("obtained_marks"+s.name).readOnly = true;
		document.getElementById("total_marks"+s.name).readOnly = true;
		///////Clear Text
		document.getElementById("obtained_marks"+s.name).value = "";
		document.getElementById("total_marks"+s.name).value = "";
	}
}
</script>
