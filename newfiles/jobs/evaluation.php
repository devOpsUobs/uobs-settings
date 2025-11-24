<?php
//$document = JFactory::getDocument();
//$document->addScript(JURI::root( true ).'/media/jui/js/jquery.ui.core.min.js');

include "newfiles/conn.php";
include 'newfiles/common.php';

$evl = 0;
if (checkPermission(JFactory::getUser(), "job_evaluate_applicant") != 0)
{
	$evl = 1;
}

if ((checkPermission(JFactory::getUser(), "job_edit_applicant")==0) and ($evl == 0))
{
	echo"You dont have right to access this page!";
	return;
}

$applicant_no = "";
$cnic = "";
if(isset($_REQUEST['applicant_no']))
		$applicant_no = $_REQUEST['applicant_no'];
if(isset($_REQUEST['cnic']))
		$cnic = $_REQUEST['cnic'];


if(isset($_POST['applicant_form']))
{
	$appl_id = $_REQUEST['appl_id'];
	
	if($evl == 1)
	{
		$is_eligible = $_REQUEST['is_eligible'];
		$reason = $_REQUEST['reason'];
	}
	
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
	$interview = $_REQUEST['interview'];
	$test_marks = $_REQUEST['test_marks'];
	
	
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
			
			if($evl == 1)
			{
				mysqli_query($conn,"UPDATE `kiusc_job_applicants` SET `name`='$name',`fname`='$fname', `dob`='$dob',`cnic`='$cnic', `cell_no`='$cell_no' ,`email`='$email', `postal_address`='$postal_address', `district_id`='$district_id', `tehsil_id`='$tehsil_id',`village`='$village',`remarks`='$remarks',`is_eligible`='$is_eligible',`reason`='$reason',`picture`='$img_path', `interview` = '$interview', `test_marks` = '$test_marks' WHERE id = '$appl_id'");
			}
			else
			{
				mysqli_query($conn,"UPDATE `kiusc_job_applicants` SET `name`='$name',`fname`='$fname', `dob`='$dob',`cnic`='$cnic', `cell_no`='$cell_no' ,`email`='$email', `postal_address`='$postal_address', `district_id`='$district_id', `tehsil_id`='$tehsil_id',`village`='$village',`remarks`='$remarks',`picture`='$img_path' WHERE id = '$appl_id'");
			}
			
			/////// Job Applicant Map ////
			
			if(isset($_REQUEST['job_id']))
			{
				$job_id = $_REQUEST['job_id'];		
				mysqli_query($conn,"DELETE FROM `kiusc_job_app_map` WHERE applicant_id = '$appl_id'");
				foreach($job_id as $job)
				{
					mysqli_query($conn,"INSERT INTO `kiusc_job_app_map`(`applicant_id`, `job_id`) VALUES ('$appl_id','$job')");
				}
			}
			
			/////// Qualifications ///////
		

			$qual_id = $_REQUEST['qual_id'];
			$degree_id = $_REQUEST['degree_id'];
			$institute = $_REQUEST['institute'];
			$year = $_REQUEST['year'];
			$obtained_marks = $_REQUEST['obtained_marks'];
			$total_marks = $_REQUEST['total_marks'];
			$gpa = $_REQUEST['gpa'];
			$total_gpa = $_REQUEST['total_gpa'];
			$division = $_REQUEST['division'];
			$percentage = $_REQUEST['percentage'];
				
		//	mysqli_query($conn,"DELETE FROM `kiusc_job_qualifications` WHERE applicant_id = '$appl_id'");
			
			$i = 0;
			foreach($degree_id as $deg)
			{
				if($degree_id[$i])
				{
					if(isset($qual_id[$i]))
					{
						mysqli_query($conn,"UPDATE `kiusc_job_qualifications` SET `degree_id`='$degree_id[$i]', `institute`='$institute[$i]', `year`='$year[$i]', `obt_marks`='$obtained_marks[$i]', `total_marks`='$total_marks[$i]', `obt_gpa`='$gpa[$i]', `total_gpa`='$total_gpa[$i]', `percentage`='$percentage[$i]', `division`='$division[$i]' WHERE id = '$qual_id[$i]'");
					}
					else
					{
						mysqli_query($conn,"INSERT INTO `kiusc_job_qualifications`( `degree_id`, `applicant_id`, `institute`, `year`, `obt_marks`, `total_marks`, `obt_gpa`, `total_gpa`, `percentage`, `division`) VALUES ('$degree_id[$i]','$appl_id', '$institute[$i]', '$year[$i]', '$obtained_marks[$i]', '$total_marks[$i]', '$gpa[$i]','$total_gpa[$i]','$percentage[$i]','$division[$i]')");
					}
				}
				$i++;
			}
		
			mysqli_query($conn,"DELETE FROM `kiusc_job_qual_equi` WHERE applicant_id = '$appl_id'");
			
			$ssc_id = $_REQUEST['ssc_id'];
			if($ssc_id)
				mysqli_query($conn,"INSERT INTO `kiusc_job_qual_equi`(`qualification_id`, `equivalent_to`, `applicant_id`) VALUES ('$ssc_id','ssc','$appl_id')");
			
			$hssc_id = $_REQUEST['hssc_id'];
			if($hssc_id)
				mysqli_query($conn,"INSERT INTO `kiusc_job_qual_equi`(`qualification_id`, `equivalent_to`, `applicant_id`) VALUES ('$hssc_id','hssc','$appl_id')");
			
			$bachelor_id = $_REQUEST['bachelor_id'];
			if($bachelor_id)
				mysqli_query($conn,"INSERT INTO `kiusc_job_qual_equi`(`qualification_id`, `equivalent_to`, `applicant_id`) VALUES ('$bachelor_id','bachelor','$appl_id')");
			
			$master_id = $_REQUEST['master_id'];
			if($master_id)
				mysqli_query($conn,"INSERT INTO `kiusc_job_qual_equi`(`qualification_id`, `equivalent_to`, `applicant_id`) VALUES ('$master_id','master','$appl_id')");
			
			$mphil_id = $_REQUEST['mphil_id'];
			if($mphil_id)
				mysqli_query($conn,"INSERT INTO `kiusc_job_qual_equi`(`qualification_id`, `equivalent_to`, `applicant_id`) VALUES ('$mphil_id','mphil','$appl_id')");
			
			$phd_id = $_REQUEST['phd_id'];
			if($phd_id)
				mysqli_query($conn,"INSERT INTO `kiusc_job_qual_equi`(`qualification_id`, `equivalent_to`, `applicant_id`) VALUES ('$phd_id','phd','$appl_id')");
			
			
			
			/////// Experiences ///////	
				
			mysqli_query($conn,"DELETE FROM `kiusc_job_experiences` WHERE applicant_id = '$appl_id'");
			if(isset($_REQUEST['job_title']))
			{
				$job_title = $_REQUEST['job_title'];
				$organization = $_REQUEST['organization'];
				$exp_from = $_REQUEST['exp_from'];
				$exp_to = $_REQUEST['exp_to'];
				$months = $_REQUEST['months'];
				
				if($evl == 1)
				{
					$exp_countable = $_REQUEST['exp_countable'];
					$exp_years = $_REQUEST['exp_years'];
				}
				
				$i = 0;
				foreach($job_title as $job)
				{
					if($job)
					{
						if($evl == 1)
						{
							$count = $exp_countable[$i];
							$exp_y = $exp_years[$i];
						}
						else
						{
							$count = "no";
							$exp_y = 0;
						}
						mysqli_query($conn,"INSERT INTO `kiusc_job_experiences`(`job_title`, `organization`, `exp_from`, `exp_to`, `month`, `countable`, `years`, `applicant_id`) VALUES ('$job_title[$i]','$organization[$i]','$exp_from[$i]','$exp_to[$i]','$months[$i]','$count','$exp_y','$appl_id')");
					}
					$i++;
				}
			  }
			
			
			/////// Relevant Skill ///////	
	
		mysqli_query($conn,"DELETE FROM `kiusc_job_skills` WHERE applicant_id = '$appl_id'");
		if(isset($_REQUEST['skill_title']))
		{
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
		 }
			
			/////// Distinctions ///////	
			
		mysqli_query($conn,"DELETE FROM `kiusc_job_distinctions` WHERE applicant_id = '$appl_id'");
		if(isset($_REQUEST['dist_title']))
		{
			$dist_title = $_REQUEST['dist_title'];
			$dist_desc = $_REQUEST['dist_desc'];
			
			if($evl == 1)
				$dist_countable = $_REQUEST['dist_countable'];
				
			$i = 0;
			foreach($dist_title as $dist)
			{
				if($dist)
				{
					if($evl == 1)
						$count = $dist_countable[$i];
					else
						$count = "no";
						
					mysqli_query($conn,"INSERT INTO `kiusc_job_distinctions`(`title`, `description`, `applicant_id`, `countable`) VALUES ('$dist_title[$i]','$dist_desc[$i]','$appl_id', '$count')");
				}
				$i++;
			}
		}
			/////// Publications ///////	
	
		mysqli_query($conn,"DELETE FROM `kiusc_job_publications` WHERE applicant_id = '$appl_id'");
		
		if(isset($_REQUEST['publ_title']))
		{
			$publ_title = $_REQUEST['publ_title'];
			$journal = $_REQUEST['journal'];
			$impact_factor = $_REQUEST['impact_factor'];
			
			if($evl == 1)
				$publ_countable = $_REQUEST['publ_countable'];
				
			$i = 0;
			foreach($publ_title as $publ)
			{
				if($publ)
				{
					if($evl == 1)
						$count = $publ_countable[$i];
					else
						$count = "no";
						
					mysqli_query($conn,"INSERT INTO `kiusc_job_publications`(`title`, `journal`, `impact_factor`, `applicant_id`, `countable`) VALUES ('$publ_title[$i]','$journal[$i]','$impact_factor[$i]','$appl_id', '$count')");
				}
				$i++;
			}
		}

}
	

$db = JFactory::getDBO();    
	$query = $db->getQuery(true);
    $query->select('*')
		  ->from("kiusc_job_applicants");
		  if($applicant_no)
		  	$query->where("applicant_no='".$applicant_no."'");
		  else
		  	$query->where("cnic='".$cnic."'");
		  
	$db->setQuery($query);
	$db->execute();
    $applicant = $db->loadAssoc();
	
$db = JFactory::getDBO();    
	$query = $db->getQuery(true);
    $query->select('*')
		  ->from("kiusc_job_app_map")
		  ->where("applicant_id='".$applicant['id']."'");
		  
	$db->setQuery($query);
	$db->execute();
    $app_jobs = $db->loadAssocList();
	
	$app_job_ids = array();
	foreach ($app_jobs as $j)
		$app_job_ids[] = $j['job_id'];
		
		
	
$db = JFactory::getDBO();    
	$query = $db->getQuery(true);
    $query->select('q.*, d.degree_title')
		  ->from("kiusc_job_qualifications q")
		  ->join("INNER","kiusc_degrees d on q.degree_id = d.id")
		  ->where("applicant_id='".$applicant['id']."'")
		  ->order('degree_id ASC');
		  
	$db->setQuery($query);
	$db->execute();
    $app_qual = $db->loadAssocList();
	

$db = JFactory::getDBO();    
	$query = $db->getQuery(true);
    $query->select('*')
		  ->from("kiusc_job_experiences")
		  ->where("applicant_id='".$applicant['id']."'");
		  
	$db->setQuery($query);
	$db->execute();
    $app_exp = $db->loadAssocList();
	
	
$db = JFactory::getDBO();    
	$query = $db->getQuery(true);
    $query->select('*')
		  ->from("kiusc_job_skills")
		  ->where("applicant_id='".$applicant['id']."'");
		  
	$db->setQuery($query);
	$db->execute();
    $app_skill = $db->loadAssocList();


$db = JFactory::getDBO();    
	$query = $db->getQuery(true);
    $query->select('*')
		  ->from("kiusc_job_distinctions")
		  ->where("applicant_id='".$applicant['id']."'");
		  
	$db->setQuery($query);
	$db->execute();
    $app_dist = $db->loadAssocList();


$db = JFactory::getDBO();    
	$query = $db->getQuery(true);
    $query->select('*')
		  ->from("kiusc_job_publications")
		  ->where("applicant_id='".$applicant['id']."'");
		  
	$db->setQuery($query);
	$db->execute();
    $app_publ = $db->loadAssocList();	
	
	



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
		  ->where("district_id ='". $applicant['district_id']. "'");
		  
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

<form action="" method="post">
<table>
<tr>
    <td> Applicant No. :  </td>
    <td> <input type="text" name="applicant_no" value="<?php echo $applicant_no; ?>" /> </td>
    <th style="width:180px;">  <center> OR </center>  </th>
    <td> CNIC :  </td>
    <td> <input type="text" name="cnic" value="<?php echo $cnic; ?>" placeholder="00000-0000000-0" />  </td>
</tr>
<tr>
	<td colspan="2"> </td>
	<td> <center><input type="submit" value="Search Applicantion" /> </center> </td>
    <td colspan="2"> </td>
</tr>
</table>
</form>





<hr />
<h3> Basic Data </h3>

<?php if(isset($applicant)) : ?>
<form action="" method="post" enctype="multipart/form-data">
<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%">

<input type="hidden" name="appl_id" value="<?php echo $applicant['id'] ?>" />

<?php if($evl == 1) { ?>
<tr>
	<td> Is Eligible ? </td>
    <td> 
    <div style="float:left">
    <select name="is_eligible">
    		<option value="yes" <?php echo ($applicant['is_eligible'] == 'yes') ? "selected" : "" ?>> yes </option>
            <option value="no" <?php echo ($applicant['is_eligible'] == 'no') ? "selected" : "" ?>> no </option>
    	</select>
     </div>
        <b style="float:left; margin-left:30px"> Reason: </b> <input type="text" name="reason" style="width:300px" value="<?php echo $applicant['reason'] ?>" />
     </td>
</tr>
<?php } ?>
<tr>    
	<td> Applicant No: </td>
    <td> <input type="text" name="applicant_no" value="<?php echo $applicant_no ?>" readonly style="width:500px" /></td>
</tr>
<tr>    
	<td> Select Job:  </td>
    <td>
    	<div style="float:left">
     <select name="job_id[]" style="width:500px" multiple="multiple" id="jobs1" disabled >
    <?php foreach($jobs as $job):
			$sel = "";
			if(in_array($job['id'], $app_job_ids))
				$sel = "selected";  ?>
    		<option value="<?php echo $job['id'] ?>" <?php echo $sel ?> > <?php echo $job['post'] ?> </option>
    <?php endforeach; ?>
    	</select>
        <input type="checkbox" onclick="enableJob()" id="jobs2" /> Change jobs applied for
          </div>
           <?php
		foreach($jobs as $job): 
			$sel = "";
			if (in_array($job['id'], $app_job_ids))
				echo $job['post']. "<br>";
		endforeach;
		?>
        </td>
</tr>


<script language="javascript">

function enableJob()
{
	document.getElementById("jobs1").disabled = !(document.getElementById("jobs2").checked);
}

</script>

<tr>
	<td> Image : </td>
    <td> 
    <img src="newfiles/jobs/pictures/<?php echo $applicant['picture'] ?>" style="width: 150px; height: 200px;border: 5px solid;" id="img" />
    <input type="file" name="picture" onchange="readURL(this)"/>
     </td>
</tr>

<tr>
	<td> Applicant's Name : </td>
    <td> <input type="text" name="name" style="width:500px" value="<?php echo $applicant['name'] ?>" /> </td>
</tr>

<tr>
    <td> Father's Name : </td>
    <td> <input type="text" name="fname" style="width:500px" value="<?php echo $applicant['fname'] ?>" /> </td>
</tr>

<tr>
	<td> DOB : </td>
    <td> <input type="date" name="dob" style="width:500px" value="<?php echo $applicant['dob'] ?>"/> </td>
</tr>

<tr>    
    <td> CNIC : </td>
    <td> <input type="text" name="cnic" maxlength="15" style="width:500px;" placeholder="00000-0000000-0" value="<?php echo $applicant['cnic'] ?>"/> </td>
</tr>

<tr>    
    <td> Postal Address : </td>
    <td> <input type="text" name="postal_address" style="width:500px" value="<?php echo $applicant['postal_address'] ?>" /> </td>
</tr>

<tr>    
    <td> District: </td>
    <td> <select name="district_id" id="district_id"  style="width:500px">
    <?php foreach($district as $dis):
				$sel = "";
			if($dis['id'] == $applicant['district_id'])
				$sel = "selected"; ?>
    		<option value="<?php echo $dis['id'] ?>" <?php echo $sel ?> > <?php echo $dis['name'] ?> </option>
    <?php endforeach; ?>
    	</select></td>
</tr>

<tr>        
    <td> Tehsil : </td>
    <td> <select name="tehsil_id" id="tehsil_id" style="width:500px">
    <?php foreach($tehsil as $teh): 
			$sel = "";
			if($teh['id'] == $applicant['tehsil_id'])
				$sel = "selected";?>
    		<option value="<?php echo $teh['id'] ?>" > <?php echo $teh['name'] ?> </option>
    <?php endforeach; ?>
    	</select></td>    
</tr>

<tr>  
    <td>  Village: </td>
    <td> <input type="text" name="village" style="width:500px" value="<?php echo $applicant['village'] ?>" /> </td>
</tr>

<tr>
    <td> Applicant's Email : </td>
    <td> <input type="text" name="email" style="width:500px" value="<?php echo $applicant['email'] ?>"/> </td>
</tr>

<tr>  
	<td>  Cell #: </td>
    <td> <input type="text" name="cell_no" style="width:500px" value="<?php echo $applicant['cell_no'] ?>"/> </td>
</tr>

<tr>
    <td> Remarks : </td>
    <td colspan="3"> <input type="text" name="remarks" style="width:500px" value="<?php echo $applicant['remarks'] ?>" /> </td>
</tr>

</table>

<br />

<h3> Merit List </h3>

<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%">

<tr>
	<td> Test Marks </td>
    <td> <input type="text" name="test_marks" style="width:500px" value="<?php echo $applicant['test_marks'] ?>" />  </td>
</tr>
<tr>
	<td> Interview Marks </td>
    <td> <input type="text" name="interview" style="width:500px" value="<?php echo $applicant['interview'] ?>" />  </td>
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

<tr>
	<td colspan="8">  </td>
    <td colspan="2"> <input type="button" onclick="rowQual()" value="Add More Qualifications" style="background-color: burlywood; border-radius: 17px; color: black;" /> </td>
</tr>

<?php 
$i = 0; 
foreach($app_qual as $qual) :
$i++;
?>

<input type="hidden" name="qual_id[]" value="<?php echo $qual['id'] ?>" />
<tr>
	 <td>
      <select name="degree_id[]" style="width:140px">
      <option value=""> Select Degree </option>
    <?php
		foreach($degrees as $deg): 
			$sel = "";
			if ($deg['id'] == $qual['degree_id'])
				$sel = "selected";
		?>
    		<option value="<?php echo $deg['id'] ?>" <?php echo $sel ?> > <?php echo $deg['degree_title'] ?> </option>
    <?php endforeach; ?>
    	</select>
        </td>
        
    <td>  <input type="text" name="institute[]" style="width:160px" value="<?php echo $qual['institute'] ?>" /> </td>
    <td>  <input type="text" name="year[]" style="width:60px" value="<?php echo $qual['year'] ?>" /> </td>
    <td> Marks : <input type="radio" name="<?php echo $i; ?>" id="type_marks<?php echo $i; ?>" onclick="typeChange(this)" <?php echo (($qual['obt_marks'] == 0) ? "" : "checked") ?>/>
    	 GPA:<input type="radio" name="<?php echo $i; ?>"  id="type_gpa<?php echo $i; ?>" onclick="typeChange(this)" <?php echo (($qual['obt_gpa']==0) ? "" : "checked") ?> /> </td>
    <td>  <input type="text" name="obtained_marks[]" style="width:80px" class="<?php echo $i ?>" id="obtained_marks<?php echo $i; ?>" onkeyup="perDivM(this)" value="<?php echo $qual['obt_marks'] ?>" <?php echo (($qual['obt_marks'] == 0) ? "readonly" : "") ?> /> </td>
    <td>  <input type="text" name="total_marks[]" style="width:80px" class="<?php echo $i ?>" id="total_marks<?php echo $i; ?>" onkeyup="perDivM(this)" value="<?php echo $qual['total_marks'] ?>" <?php echo (($qual['total_marks']== 0) ? "readonly" : "") ?>/>  </td>
    <td>  <input type="text" name="gpa[]" style="width:60px" class="<?php echo $i ?>" id="gpa<?php echo $i; ?>" onkeyup="perDivGPA(this)" value="<?php echo $qual['obt_gpa'] ?>" <?php echo (($qual['obt_gpa']== 0) ? "readonly" : "") ?> />  </td>
    <td>  <input type="text" name="total_gpa[]" style="width:70px" class="<?php echo $i ?>" id="total_gpa<?php echo $i; ?>" onkeyup="perDivGPA(this)" value="<?php echo $qual['total_gpa'] ?>" <?php echo (($qual['total_gpa']== 0) ? "readonly" : "") ?> /> </td>
    <td> <input type="text" name="division[]" id="division<?php echo $i ?>" style="width:75px" readonly value="<?php echo $qual['division'] ?>"/> </td>
    <td> <input type="text" name="percentage[]" id="percentage<?php echo $i ?>" style="width:80px"  readonly value="<?php echo $qual['percentage'] ?>"/>  </td>
        </td>
    <td> <input type="button" onclick="deleteRow(this, 'tbl_qual')" value="Delete" /> </td>
</tr>

<?php endforeach; ?>
</table>

<?php if($evl == 1) { ?>
<h4> Qualification Equalence </h4>

<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%" id="tbl_qual">

<tr>
	<th> Equivalance </th>
	<th>  Degree </th>
</tr>

<tr>
	<td>  SSC </td>
    <td>
      <select name="ssc_id" style="width:400px" onchange="displayDiv(ssc_d)">
           <option value=""> Select Degree </option>
      <?php
	  $equ = mysqli_query($conn,"SELECT * FROM `kiusc_job_qual_equi` WHERE equivalent_to = 'ssc' and applicant_id = '".$applicant['id']."'");
	  $equ = mysqli_fetch_assoc($equ);
	  foreach($app_qual as $qual) :  
	  	$sel = "";
		if($qual['id'] == $equ['qualification_id'])
			$sel = "selected";
	  ?>
    		<option value="<?php echo $qual['id'] ?>" <?php echo $sel ?> > <?php echo $qual['degree_title'] ?> </option>
    <?php endforeach; ?>
    	</select>
        </td>
</tr>

<tr>
	<td>  HSSC  </td>
    <td>
      <select name="hssc_id" style="width:400px">
           <option value=""> Select Degree </option>
      <?php 
	  $equ = mysqli_query($conn,"SELECT * FROM `kiusc_job_qual_equi` WHERE equivalent_to = 'hssc' and applicant_id = '".$applicant['id']."'");
	  $equ = mysqli_fetch_assoc($equ);
	  foreach($app_qual as $qual) :  
	  	$sel = "";
		if($qual['id'] == $equ['qualification_id'])
			$sel = "selected"; 
	  ?>
    		<option value="<?php echo $qual['id'] ?>" <?php echo $sel ?> > <?php echo $qual['degree_title'] ?> </option>
    <?php endforeach; ?>
    	</select>
        </td>
</tr>
<tr>
	<td>  Bachelor </td>
    <td>
      <select name="bachelor_id" style="width:400px">
           <option value=""> Select Degree </option>
      <?php  
	  $equ = mysqli_query($conn,"SELECT * FROM `kiusc_job_qual_equi` WHERE equivalent_to = 'bachelor' and applicant_id = '".$applicant['id']."'");
	  $equ = mysqli_fetch_assoc($equ);
	  foreach($app_qual as $qual) :  
	  	$sel = "";
		if($qual['id'] == $equ['qualification_id'])
			$sel = "selected"; ?>
    		<option value="<?php echo $qual['id'] ?>" <?php echo $sel ?> > <?php echo $qual['degree_title'] ?> </option>
    <?php endforeach; ?>
    	</select>
        </td>
</tr>
<tr>
	<td>  Master  </td>
    <td>
      <select name="master_id" style="width:400px">
           <option value=""> Select Degree </option>
      <?php  
	  $equ = mysqli_query($conn,"SELECT * FROM `kiusc_job_qual_equi` WHERE equivalent_to = 'master' and applicant_id = '".$applicant['id']."'");
	  $equ = mysqli_fetch_assoc($equ);
	  foreach($app_qual as $qual) :  
	  	$sel = "";
		if($qual['id'] == $equ['qualification_id'])
			$sel = "selected"; ?>
    		<option value="<?php echo $qual['id'] ?>" <?php echo $sel ?> > <?php echo $qual['degree_title'] ?> </option>
    <?php endforeach; ?>
    	</select>
        </td>
</tr>
<tr>
	<td>  MPhil  </td>
    <td>
      <select name="mphil_id" style="width:400px">
           <option value=""> Select Degree </option>
      <?php  
	  $equ = mysqli_query($conn,"SELECT * FROM `kiusc_job_qual_equi` WHERE equivalent_to = 'mphil' and applicant_id = '".$applicant['id']."'");
	  $equ = mysqli_fetch_assoc($equ);
	  foreach($app_qual as $qual) :  
	  	$sel = "";
		if($qual['id'] == $equ['qualification_id'])
			$sel = "selected"; ?>
    		<option value="<?php echo $qual['id'] ?>" <?php echo $sel ?> > <?php echo $qual['degree_title'] ?> </option>
    <?php endforeach; ?>
    	</select>
        </td>
</tr>
<tr>
	<td>  PhD  </td>
    <td>
      <select name="phd_id" style="width:400px">
           <option value=""> Select Degree </option>
      <?php  
	  $equ = mysqli_query($conn,"SELECT * FROM `kiusc_job_qual_equi` WHERE equivalent_to = 'phd' and applicant_id = '".$applicant['id']."'");
	  $equ = mysqli_fetch_assoc($equ);
	  foreach($app_qual as $qual) :  
	  	$sel = "";
		if($qual['id'] == $equ['qualification_id'])
			$sel = "selected"; ?>
    		<option value="<?php echo $qual['id'] ?>" <?php echo $sel ?> > <?php echo $qual['degree_title'] ?> </option>
    <?php endforeach; ?>
    	</select>
        </td>
</tr>
</table>

<?php } ?>

<h3> Experiences </h3>

<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%" id="tbl_exp">

<tr>
	<th> Job Title </th>
    <th> Organization </th>
    <th> from </th>
    <th> To </th>
    <th> Months </th>
    <?php if($evl == 1) { ?>
    <th> Countable? </th>
    <th> Years </th>
    <?php } ?>
    <th> </th>
</tr>

<tr>
	<td colspan="3"> </td>
    <td colspan="2"> <input type="button" onclick="rowExp()" value="Add More Experience" style="background-color: burlywood; border-radius: 17px; color: black;" /> </td>
</tr>

<?php 
$i = 0; 
foreach($app_exp as $exp) :
$i++;
?>
<tr>   
    <td>  <input type="text" name="job_title[]" style="width:250px" value="<?php echo $exp['job_title'] ?>" /> </td>
    <td>  <input type="text" name="organization[]" style="width:250px" value="<?php echo $exp['organization'] ?>" /> </td>
    <td>  <input type="date" name="exp_from[]" style="width:160px" id="from<?php echo $i; ?>" class="<?php echo $i; ?>" onfocusout="calYears(this)" value="<?php echo $exp['exp_from'] ?>"/> </td>
    <td>  <input type="date" name="exp_to[]" style="width:160px" id="to<?php echo $i; ?>" class="<?php echo $i; ?>" onfocusout="calYears(this)" value="<?php echo $exp['exp_to'] ?>" />  </td>
    <td>  <input type="text" name="months[]" style="width:80px"  readonly id="months<?php echo $i; ?>" value="<?php echo $exp['month'] ?>" /> </td>
    
    <?php if($evl == 1) { 	?>
    	<td>  
    		<select name="exp_countable[]" style="width:80px">
            	<option value="yes" <?php echo ($exp['countable'] == 'yes') ? "selected" : "" ?>> Yes </option>
                <option value="no" <?php echo ($exp['countable'] == 'no') ? "selected" : "" ?>> No </option>
            </select>
     	</td>
    	<td>  <input type="text" name="exp_years[]" style="width:80px" value="<?php echo $exp['years'] ?>" /> </td>
    
    <?php } ?>
    
    
    <td> <input type="button" onclick="deleteRow(this, 'tbl_exp')" value="Delete" /> </td>
</tr>
<?php endforeach; ?>
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

<?php  
foreach($app_skill as $skill) :
?>

<tr>  
    <td>  <input type="text" name="skill_title[]" style="width:300px" value="<?php echo $skill['skill_title'] ?>" /> </td>
    <td>  <input type="text" name="skill_desc[]" style="width:700px" value="<?php echo $skill['description'] ?>" /> </td>
    <td> <input type="button" onclick="deleteRow(this, 'tbl_skill')" value="Delete" /> </td>
</tr>
<?php endforeach; ?>
</table>

<h3> Distinctions </h3>

<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%" id="tbl_distinction">

<tr>
	<th> Title </th>
    <th> Description </th>
    <?php if($evl == 1) { ?>
    	<th> Countable </th>
    <?php } ?>
    <th> </th>
</tr>

<tr>
	<td> </td>
    <td style="padding-right: 134px; text-align: right;"> <input type="button" onclick="rowDistinction()" value="Add More Distiction" style="background-color: burlywood; border-radius: 17px; color: black;" /> </td>
</tr>

<?php  
foreach($app_dist as $dist) :
?>

<tr>   
    <td>  <input type="text" name="dist_title[]" style="width:300px" value="<?php echo $dist['title'] ?>" /> </td>
    <td>  <input type="text" name="dist_desc[]" style="width:700px" value="<?php echo $dist['description'] ?>" /> </td>
    
	<?php if($evl == 1) { ?>
    	<td>  
    		<select name="dist_countable[]" style="width:80px">
            	<option value="yes"> Yes </option>
                <option value="no"> No </option>
            </select>
     	</td>
    
    <?php } ?>
    
    <td> <input type="button" onclick="deleteRow(this, 'tbl_distinction')" value="Delete" /> </td>
</tr>
<?php endforeach; ?>
</table>


<h3> Publication </h3>

<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%" id="tbl_publication">

<tr>
	<th> Title </th>
    <th> Journal </th>
    <th> Impact Factor </th>
    <?php if($evl == 1) { ?>
    	<th> Countable </th>
    <?php } ?>
    <th> </th>
</tr>

<tr>
	<td> </td>
    <td colspan="2" style="padding-right: 134px; text-align: right;"> <input type="button" onclick="rowPublication()" value="Add More Publication" style="background-color: burlywood; border-radius: 17px; color: black;" /> </td>
</tr>

<?php  
foreach($app_publ as $publ) :
?>
<tr>  
    <td>  <input type="text" name="publ_title[]" style="width:300px" value="<?php echo $publ['title'] ?>" /> </td>
    <td>  <input type="text" name="journal[]" style="width:400px" value="<?php echo $publ['journal'] ?>" /> </td>
    <td>  <input type="text" name="impact_factor[]" style="width:100px" value="<?php echo $publ['impact_factor'] ?>" /> </td>
    <?php if($evl == 1) { ?>
    	<td>  
    		<select name="publ_countable[]" style="width:80px">
            	<option value="yes" <?php echo ($publ['countable'] == 'yes') ? "selected" : "" ?>> Yes </option>
                <option value="no" <?php echo ($publ['countable'] == 'no') ? "selected" : "" ?>> No </option>
            </select>
     	</td>
    <?php } ?>
    
    <td> <input type="button" onclick="deleteRow(this, 'tbl_publication')" value="Delete" /> </td>
</tr>
<?php endforeach; ?>
</table>


<input type="submit" name="applicant_form" value="Update" style="background-color: burlywood; border-radius: 17px; color: black;" />
</form>

<?php endif; ?>

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
