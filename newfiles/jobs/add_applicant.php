<?php
include "newfiles/conn.php";
include 'newfiles/common.php';

if (checkPermission(JFactory::getUser(), "job_add_applicant")==0)
{
	echo"You dont have right to access this page!";
	return;
}

if(isset($_POST['applicant_form']))
{
	$applicant_no = $_REQUEST['applicant_no'];
	$name = $_REQUEST['name'];
	$fname = $_REQUEST['fname'];
	$dob = $_REQUEST['dob'];
	$cnic = $_REQUEST['cnic'];
	$cell_no = $_REQUEST['cell_no'];
	$email = $_REQUEST['email'];
	$postal_address = $_REQUEST['postal_address'];
	$district_id = $_REQUEST['district_id'];
	$tehsil_id = $_REQUEST['tehsil_id'];
	$village = $_REQUEST['village'];
	$remarks = $_REQUEST['remarks'];
	
	$img_path = $applicant_no . ".jpeg";

	if($_FILES['picture']['name'])
	{
		if($_FILES['picture']['type'] == "image/gif" || $_FILES['picture']['type'] == "image/jpeg" || $_FILES['picture']['type'] == "image/jpg" || $_FILES['picture']['type'] == "image/png" || $_FILES['picture']['type'] == "image/bmp")
		{
			
			if(move_uploaded_file($_FILES['picture']['tmp_name'], "newfiles/jobs/pictures/".$img_path))
			{ 
					$src_img = imagecreatefromjpeg("newfiles/jobs/pictures/".$img_path); 
					
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
					
					imagejpeg($dst_img, "newfiles/jobs/pictures/".$img_path, 80);
					
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
			mysqli_query($conn,"INSERT INTO `kiusc_job_applicants`(`applicant_no`, `name`, `fname`, `dob`, `cnic`, `cell_no`, `email`, `postal_address`, `district_id`, `tehsil_id`, `village`, `remarks`, `picture`) VALUES ('$applicant_no','$name','$fname','$dob','$cnic','$cell_no','$email','$postal_address','$district_id','$tehsil_id','$village','$remarks', '$img_path')");
			
			$appl_id = mysqli_insert_id($conn);
			
			/////// Job Applicant Map ////
			
			$job_id = $_REQUEST['job_id'];
			
			foreach($job_id as $job)
			{
				mysqli_query($conn,"INSERT INTO `kiusc_job_app_map`(`applicant_id`, `job_id`) VALUES ('$appl_id','$job')");
			}
			
			
			/////// Qualifications ///////
	
			$degree_id = $_REQUEST['degree_id'];
			$institute = $_REQUEST['institute'];
			$year = $_REQUEST['year'];
			$obtained_marks = $_REQUEST['obtained_marks'];
			$total_marks = $_REQUEST['total_marks'];
			$gpa = $_REQUEST['gpa'];
			$total_gpa = $_REQUEST['total_gpa'];
			$division = $_REQUEST['division'];
			$percentage = $_REQUEST['percentage'];
			
			$i = 0;
			foreach($degree_id as $deg)
			{
				if($degree_id[$i])
				{
					mysqli_query($conn,"INSERT INTO `kiusc_job_qualifications`(`degree_id`, `applicant_id`, `institute`, `year`, `obt_marks`, `total_marks`, `obt_gpa`, `total_gpa`, `percentage`, `division`) VALUES ('$degree_id[$i]','$appl_id','$institute[$i]','$year[$i]','$obtained_marks[$i]','$total_marks[$i]','$gpa[$i]','$total_gpa[$i]', '$percentage[$i]','$division[$i]')");
				}
				$i++;
			}
			
			
			/////// Experiences ///////	
	
			$job_title = $_REQUEST['job_title'];
			$organization = $_REQUEST['organization'];
			$exp_from = $_REQUEST['exp_from'];
			$exp_to = $_REQUEST['exp_to'];
			$months = $_REQUEST['months'];
			
			$i = 0;
			foreach($job_title as $job)
			{
				if($job)
				{
					mysqli_query($conn,"INSERT INTO `kiusc_job_experiences`(`job_title`, `organization`, `exp_from`, `exp_to`, `month`, `countable`, `applicant_id`) VALUES ('$job_title[$i]','$organization[$i]','$exp_from[$i]','$exp_to[$i]','$months[$i]','no','$appl_id')");
				}
				$i++;
			}
			
			
			/////// Relevant Skill ///////	
	
			$skill_title = $_REQUEST['skill_title'];
			$skill_desc = $_REQUEST['skill_desc'];
			
			$i = 0;
			foreach($skill_title as $skill)
			{
				if($skill)
				{
					mysqli_query($conn,"INSERT INTO `kiusc_job_skills`(`skill_title`, `description`, `applicant_id`) VALUES ('$skill_title[$i]','$skill_desc[$i]','$appl_id')");
				}
				$i++;
			}
			
			/////// Distinctions ///////	
			
			$dist_title = $_REQUEST['dist_title'];
			$dist_desc = $_REQUEST['dist_desc'];
			
			$i = 0;
			foreach($dist_title as $dist)
			{
				if($dist)
				{
					mysqli_query($conn,"INSERT INTO `kiusc_job_distinctions`(`title`, `description`, `applicant_id`) VALUES ('$dist_title[$i]','$dist_desc[$i]','$appl_id')");
				}
				$i++;
			}
			
			/////// Publications ///////	
	
			$publ_title = $_REQUEST['publ_title'];
			$journal = $_REQUEST['journal'];
			$impact_factor = $_REQUEST['impact_factor'];
			
			$i = 0;
			foreach($publ_title as $publ)
			{
				if($publ)
				{
					mysqli_query($conn,"INSERT INTO `kiusc_job_publications`(`title`, `journal`, `impact_factor`, `applicant_id`) VALUES ('$publ_title[$i]','$journal[$i]','$impact_factor[$i]','$appl_id')");
				}
				$i++;
			}
}
	
	
$db = JFactory::getDBO();    
	$query = $db->getQuery(true);
    $query->select('*')
		  ->from("kiusc_jobs")
		  ->where('active = 1');
		  
	$db->setQuery($query);
	$db->execute();
    $jobs = $db->loadAssocList();	

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
		  ->where("district_id ='". $district[0]['id']. "'");
		  
	$db->setQuery($query);
	$db->execute();
    $tehsil = $db->loadAssocList();
	
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

<h2> Job Applicantion Form </h2>

<hr />
<h3> Basic Data </h3>

<form action="" method="post" enctype="multipart/form-data">

<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%">

<?php
$date = date("Y");
$q = $date . "-";
$m_no = mysqli_query($conn,"SELECT max(applicant_no) as applicant_no FROM `kiusc_job_applicants` WHERE applicant_no like '$q%'");
$m_no = mysqli_fetch_assoc($m_no);


$sp_no = explode("-",$m_no['applicant_no']);

if($m_no['applicant_no'] != NULL)
{
	$sp_no[1] += 1;
	if($sp_no[1] < 10)
		$sp_no[1] = '000'. $sp_no[1];
	else if($sp_no[1] < 100)
		$sp_no[1] = '00'. $sp_no[1];
	else if($sp_no[1] < 1000)
		$sp_no[1] = '0'. $sp_no[1];
		
	$n_app_no = $date . "-". ($sp_no[1]); 
}
else
	$n_app_no = $date . "-0001";
?>

<tr>    
	<td> Applicant No: </td>
    <td> <input type="text" name="applicant_no" value="<?php echo $n_app_no ?>" style="width:500px" /></td>
</tr>
<tr>    
	<td> Select Job: </td>
    <td> <select name="job_id[]" style="width:500px" multiple="multiple">
    <?php foreach($jobs as $job):	?>
    		<option value="<?php echo $job['id'] ?>" > <?php echo $job['post'] ?> </option>
    <?php endforeach; ?>
    	</select></td>
</tr>

<tr>
	<td> Image : </td>
    <td> 
    <img src="newfiles/jobs/pictures/pic.jpg" style="width: 150px; height: 200px;border: 5px solid;" id="img" />
    <input type="file" name="picture" onchange="readURL(this)"/>
     </td>
</tr>

<tr>
	<td> Applicant's Name : </td>
    <td> <input type="text" name="name" style="width:500px" /> </td>
</tr>

<tr>
    <td> Father's Name : </td>
    <td> <input type="text" name="fname" style="width:500px" /> </td>
</tr>

<tr>
	<td> DOB : </td>
    <td> <input type="date" name="dob" style="width:500px"/> </td>
</tr>

<tr>    
    <td> CNIC : </td>
    <td> <input type="text" name="cnic" maxlength="15" style="width:500px; float:left"/> (00000-0000000-0) </td>
</tr>

<tr>    
    <td> Postal Address : </td>
    <td> <input type="text" name="postal_address" style="width:500px" /> </td>
</tr>

<tr>    
    <td> District: </td>
    <td> <select name="district_id" id="district_id"  style="width:500px">
    <?php foreach($district as $dis): ?>
    		<option value="<?php echo $dis['id'] ?>"> <?php echo $dis['name'] ?> </option>
    <?php endforeach; ?>
    	</select></td>
</tr>

<tr>        
    <td> Tehsil : </td>
    <td> <select name="tehsil_id" id="tehsil_id" style="width:500px">
    <?php foreach($tehsil as $teh): ?>
    		<option value="<?php echo $teh['id'] ?>" > <?php echo $teh['name'] ?> </option>
    <?php endforeach; ?>
    	</select></td>    
</tr>

<tr>  
    <td>  Village: </td>
    <td> <input type="text" name="village" style="width:500px"/> </td>
</tr>

<tr>
    <td> Applicant's Email : </td>
    <td> <input type="text" name="email" style="width:500px"/> </td>
</tr>

<tr>  
	<td>  Cell #: </td>
    <td> <input type="text" name="cell_no" style="width:500px"/> </td>
</tr>

<tr>
    <td> Remarks : </td>
    <td colspan="3"> <input type="text" name="remarks" style="width:500px" /> </td>
</tr>

</table>

<br />

<h3> Accademic Records </h3>

<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%" id="tbl_qual">

<tr>
	<th>  Degree </th>
    <th>  Institution </th>
    <th> Year </th>
     <th> Type </th>
    <th> Obt Marks </th>
    <th> Total Marks </th>
    <th> GPA </th>
    <th> Total GPA </th>
    <th> Division </th>
    <th> Percentage </th>
    <th>  </th>
</tr>
<?php $i = 0; ?>

<tr>
	<td colspan="8"> </td>
    <td colspan="2"> <input type="button" onclick="rowQual()" value="Add More Qualifications" style="background-color: burlywood; border-radius: 17px; color: black;" /> </td>
</tr>

<tr id="dup">
	 <td>
      <select name="degree_id[]" style="width:140px">
      <option value=""> Select Degree </option>
    <?php
			$i++;
		foreach($degrees as $deg): ?>
    		<option value="<?php echo $deg['id'] ?>" > <?php echo $deg['degree_title'] ?> </option>
    <?php endforeach; ?>
    	</select></td>
        
    <td>  <input type="text" name="institute[]" style="width:160px" /> </td>
    <td>  <input type="text" name="year[]" style="width:60px" /> </td>
    <td> Marks : <input type="radio" name="<?php echo $i; ?>" id="type_marks<?php echo $i; ?>" onclick="typeChange(this)" checked/>
    	 GPA:<input type="radio" name="<?php echo $i; ?>"  id="type_gpa<?php echo $i; ?>" onclick="typeChange(this)" /> </td>
    <td>  <input type="text" name="obtained_marks[]" style="width:80px" class="<?php echo $i ?>" id="obtained_marks<?php echo $i; ?>" onkeyup="perDivM(this)" /> </td>
    <td>  <input type="text" name="total_marks[]" style="width:80px" class="<?php echo $i ?>" id="total_marks<?php echo $i; ?>" onkeyup="perDivM(this)" />  </td>
    <td>  <input type="text" name="gpa[]" style="width:60px" class="<?php echo $i ?>" id="gpa<?php echo $i; ?>" readonly onkeyup="perDivGPA(this)" />  </td>
    <td>  <input type="text" name="total_gpa[]" style="width:70px" class="<?php echo $i ?>" id="total_gpa<?php echo $i; ?>" readonly onkeyup="perDivGPA(this)" /> </td>
    <td> <input type="text" name="division[]" id="division<?php echo $i ?>" style="width:75px" readonly/> </td>
    <td> <input type="text" name="percentage[]" id="percentage<?php echo $i ?>" style="width:80px"  readonly/>  </td>
    <td> <input type="button" onclick="deleteRow(this, 'tbl_qual')" value="Delete" /> </td>
</tr>

</table>


<h3> Experiences </h3>

<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%" id="tbl_exp">

<tr>
	<th> Job Title </th>
    <th> Organization </th>
    <th> from </th>
    <th> To </th>
    <th> Months </th>
    <th> </th>
</tr>

<tr>
	<td colspan="3"> </td>
    <td colspan="2"> <input type="button" onclick="rowExp()" value="Add More Experience" style="background-color: burlywood; border-radius: 17px; color: black;" /> </td>
</tr>

<tr>   
    <td>  <input type="text" name="job_title[]" style="width:250px" /> </td>
    <td>  <input type="text" name="organization[]" style="width:250px" /> </td>
    <td>  <input type="date" name="exp_from[]" style="width:180px" id="from1" class="1" onfocusout="calYears(this)"/> </td>
    <td>  <input type="date" name="exp_to[]" style="width:180px" id="to1" class="1" onfocusout="calYears(this)" />  </td>
    <td>  <input type="text" name="months[]" style="width:80px"  readonly id="months1" /> </td>
    <td> <input type="button" onclick="deleteRow(this, 'tbl_exp')" value="Delete" /> </td>
</tr>

</table>


<h3> Relevant Skills </h3>

<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%" id="tbl_skill">

<tr>
	<th> Title </th>
    <th> Description </th>
    <th> </th>
</tr>

<tr>
	<td> </td>
    <td style="padding-right: 134px; text-align: right;"> <input type="button" onclick="rowSkill()" value="Add More Skills" style="background-color: burlywood; border-radius: 17px; color: black;" /> </td>
</tr>

<tr>   
    <td>  <input type="text" name="skill_title[]" style="width:300px" /> </td>
    <td>  <input type="text" name="skill_desc[]" style="width:700px" /> </td>
    <td> <input type="button" onclick="deleteRow(this, 'tbl_skill')" value="Delete" /> </td>
</tr>

</table>

<h3> Distinctions </h3>

<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%" id="tbl_distinction">

<tr>
	<th> Title </th>
    <th> Description </th>
    <th> </th>
</tr>

<tr>
	<td> </td>
    <td style="padding-right: 134px; text-align: right;"> <input type="button" onclick="rowDistinction()" value="Add More Distiction" style="background-color: burlywood; border-radius: 17px; color: black;" /> </td>
</tr>

<tr>   
    <td>  <input type="text" name="dist_title[]" style="width:300px" /> </td>
    <td>  <input type="text" name="dist_desc[]" style="width:700px" /> </td>
    <td> <input type="button" onclick="deleteRow(this, 'tbl_distinction')" value="Delete" /> </td>
</tr>

</table>


<h3> Publication </h3>

<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%" id="tbl_publication">

<tr>
	<th> Title </th>
    <th> Journal </th>
    <th> Impact Factor </th>
    <th> </th>
</tr>

<tr>
	<td> </td>
    <td colspan="2" style="padding-right: 134px; text-align: right;"> <input type="button" onclick="rowPublication()" value="Add More Publication" style="background-color: burlywood; border-radius: 17px; color: black;" /> </td>
</tr>

<tr>   
    <td>  <input type="text" name="publ_title[]" style="width:300px" /> </td>
    <td>  <input type="text" name="journal[]" style="width:400px" /> </td>
    <td>  <input type="text" name="impact_factor[]" style="width:100px" /> </td>
    <td> <input type="button" onclick="deleteRow(this, 'tbl_publication')" value="Delete" /> </td>
</tr>

</table>


<input type="submit" name="applicant_form" value="Save" style="background-color: burlywood; border-radius: 17px; color: black;" />
</form>



<script>

function deleteRow(o, tbl)
{
	var i = o.closest('tr').rowIndex;
	//alert(o.rowIndex);
	document.getElementById(tbl).deleteRow(i);
}

function calYears(o)
{
	//alert('sdfasdfs');
	var from = document.getElementById("from"+o.className).value;
	var to = document.getElementById("to"+o.className).value;
	
	//alert(from);
	var from2 = new Date(from);
	 var to2 = new Date(to);

	var m =  Math.abs(from2-to2)
	m = m/(1000 * 60 * 60 * 24 * 30);
	
	document.getElementById("months"+o.className).value = m.toFixed(0);
}

function perDivM(o)
{
	////  Percentage ///////
	var obt = document.getElementById("obtained_marks"+o.className).value;
	var total = document.getElementById("total_marks"+o.className).value;
	
	if(isNaN(obt))
	{
		document.getElementById("obtained_marks"+o.className).value = 0;
		obt = 0;
	}
	if(isNaN(total))
	{
		document.getElementById("total_marks"+o.className).value = 0;
		total = 0;
	}
	
	var per = obt/total * 100;
	if(per == 'Infinity' || isNaN(per) || per > 100)
		per = 0;
	document.getElementById("percentage"+o.className).value = per.toFixed(2);
	
	
	//////// Division ///////
	
	var div = "3rd"
	if(per >= 60)
		div = "1st";
	else if (per >= 45)
		div = "2nd";
	
	document.getElementById("division"+o.className).value = div;
}

function perDivGPA(o)
{
	var gpa = document.getElementById("gpa"+o.className).value;
	var t_gpa = document.getElementById("total_gpa"+o.className).value;
	
	if(isNaN(gpa))
	{
		document.getElementById("gpa"+o.className).value = 0;
		gpa = 0;
	}
	if(isNaN(t_gpa))
	{
		document.getElementById("total_gpa"+o.className).value = 0;
		t_gpa = 0;
	}
	
	
	var per = gpa/t_gpa * 100;
	if(per == 'Infinity' || isNaN(per) || per > 100)
		per = 0;
	document.getElementById("percentage"+o.className).value = per.toFixed(2);
	
	
	//////// Division ///////
	
	var div = "3rd"
	if(per >= 60)
		div = "1st";
	else if (per >= 45)
		div = "2nd";
	
	document.getElementById("division"+o.className).value = div;
}


function rowQual() {
		var c = document.getElementById("tbl_qual").rows.length;
        //document.getElementById("tbl").innerHTML = "";

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
		{
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				jQuery("#tbl_qual").append(xmlhttp.responseText);
            }
        };
        xmlhttp.open("GET", "../../newfiles/jobs/ajax_addQual.php?rows="+c, true);
        xmlhttp.send();
}

function rowExp() {
		var c = document.getElementById("tbl_exp").rows.length;
        //document.getElementById("tbl").innerHTML = "";

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
		{
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				jQuery("#tbl_exp").append(xmlhttp.responseText);
            }
        };
        xmlhttp.open("GET", "../../newfiles/jobs/ajax_addExp.php?rows="+c, true);
        xmlhttp.send();
}

function rowSkill() {
		var c = document.getElementById("tbl_skill").rows.length;
        //document.getElementById("tbl").innerHTML = "";

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
		{
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				jQuery("#tbl_skill").append(xmlhttp.responseText);
            }
        };
        xmlhttp.open("GET", "../../newfiles/jobs/ajax_addSkill.php?rows="+c, true);
        xmlhttp.send();
}

function rowDistinction() {
		var c = document.getElementById("tbl_distinction").rows.length;
        //document.getElementById("tbl").innerHTML = "";

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
		{
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				jQuery("#tbl_distinction").append(xmlhttp.responseText);
            }
        };
        xmlhttp.open("GET", "../../newfiles/jobs/ajax_addDistinction.php?rows="+c, true);
        xmlhttp.send();
}

function rowPublication() {
		var c = document.getElementById("tbl_publication").rows.length;
        //document.getElementById("tbl").innerHTML = "";

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
		{
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				jQuery("#tbl_publication").append(xmlhttp.responseText);
            }
        };
        xmlhttp.open("GET", "../../newfiles/jobs/ajax_addPublication.php?rows="+c, true);
        xmlhttp.send();
}

</script>


<script language="javascript">
jQuery(document).ready(function() {
			jQuery("#district_id").change(function(){				 
						jQuery.ajax({
							   type: "POST",
								url: "../../newfiles/admin/student/ajax_get_tehsil.php",
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
		document.getElementById("division"+s.name).value = "";
		document.getElementById("percentage"+s.name).value = "";
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
		document.getElementById("division"+s.name).value = "";
		document.getElementById("percentage"+s.name).value = "";
	}
}
</script>
