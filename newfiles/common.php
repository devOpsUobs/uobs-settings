<style>
	.align-center{
		text-align:center;
	}
	.btn {
  border: 2px solid black;
  background-color: white;
  color: black;
  padding: 4px 8px;
  font-size: 12px;
  cursor: pointer;
  border-radius: 10px;
}
	.btn2 {
  border: 2px solid black;
  background-color: white;
  color: black;
  padding: 7px 14px;
  font-size: 14px;
  cursor: pointer;
  border-radius: 18px;
}

/* Green */
.success {
  border-color: #04AA6D;
  color: green;
}

.success:hover {
  background-color: #04AA6D;
  color: white;
}

/* Blue */
.info {
  border-color: #2196F3;
  color: dodgerblue;
}

.info:hover {
  background: #2196F3;
  color: white;
}

/* Orange */
.warning {
  border-color: #ff9800;
  color: orange;
}

.warning:hover {
  background: #ff9800;
  color: white;
}

/* Red */
.danger {
  border-color: #f44336;
  color: red;
}

.danger:hover {
  background: #f44336;
  color: white;
}

/* Gray */
.default {
  border-color: #e7e7e7;
  color: black;
}

.default:hover {
  background: #e7e7e7;
}
.chzn-drop > ul{
	background-color: white !important;
}
span{
	color: black;
}
</style>
<?php
//error reporting off


function getUserGroupsname ($user)
{
$db = JFactory::getDBO();    

    $db->setQuery($db->getQuery(true)
        ->select('*')
        ->from("#__usergroups")
    );
    $groups=$db->loadRowList();

            $userGroups = $user->groups;
            $return=array();

          foreach ($groups as $key=>$g){
            if (array_key_exists($g[0],$userGroups)) array_push($return,$g[4]);
          }

          return $return;
}
function checkPermission($user,$perm_request)
{

  $groupsname=getUserGroupsname($user);
	if (in_array($perm_request, $groupsname))
	{
		return 1;
    }
	else
		return 0;
}
function showDepartmentSel($dep)
{
	 $db = JFactory::getDBO();    
     $db->setQuery($db->getQuery(true)
        ->select('*')
        ->from("kiusc_departments")
    );
	$db->execute();
	$num_rows = $db->getNumRows();
    $row = $db->loadAssocList();
	
echo '
<form name="dep_select" id="dep_select" action="" method="post">
 <select id="sel_dep_id" name="sel_dep_id" style="width: 250px;">';
 //if ($num_rows>0)
	//$sel_dep=$row[0]['id'];
//else
 $sel_dep=-1;
for ($i=0;$i<$num_rows;$i++)
{
    if (checkPermission(JFactory::getUser(),$row[$i]['group'])==1)
	{
		if ($sel_dep==-1)
			$sel_dep=$row[$i]['id'];
		$s="";
	   if ($dep==$row[$i]['id']) 
	   {
			$sel_dep=$row[$i]['id'];
			$s=" selected ";
	   }
	   
		echo '<option '.$s.' value="'.$row[$i]['id'].'">'.$row[$i]['name'].'</option>';
	}
}

echo'</select>
 </form>
	<script type="text/javascript">
	$("#sel_dep_id").change(function(){
    $("#dep_select").trigger("submit");
});

</script>';

return $sel_dep;
}
function showAllDepartmentSel($dep)
{
  
	$db = JFactory::getDBO();    
    $db->setQuery($db->getQuery(true)
        ->select('*')
        ->from("kiusc_departments")
    );
	$db->execute();
	$num_rows = $db->getNumRows();
    $row = $db->loadAssocList();
	
$sel_dep=0;
if ($num_rows>0)
	$sel_dep=$row[0]['id'];
else
 $sel_dep=-1;

echo '<form name="dep_select" id="dep_select" action="" method="post">
 <select id="sel_dep_id" name="sel_dep_id">'; 
 for ($i=0;$i<$num_rows;$i++)
 {
    //if (checkPermission(JFactory::getUser(),$row[$i]['group'])==1)
	{
	
		$s="";
	   if ($dep==$row[$i]['id']) 
	   {
			$sel_dep=$row[$i]['id'];
			$s=" selected ";
	   }
		echo '<option '.$s.' value="'.$row[$i]['id'].'">'.$row[$i]['name'].'</option>';
	}
}

 echo'</select>';
 
 echo'</form>
	<script type="text/javascript">
	$("#sel_dep_id").change(function(){
    $("#dep_select").trigger("submit");
});

</script>
';
return $sel_dep;
}
function showProramSel($dp_ID, $pr_name)
{
	$db = JFactory::getDBO();    
    $db->setQuery($db->getQuery(true)
        ->select('*')
        ->from("kiusc_programs")
		->where("dep_id='".$dp_ID."'")
    );
	$db->execute();
	$num_rows = $db->getNumRows();
    $row = $db->loadAssocList();
	$sel_pr=-1;
	if ($num_rows>0)
		$sel_pr=$row[0]['name'];
	else
		$sel_pr=-1;
echo '
<form name="prog_select" id="prog_select" action="" method="post">
 <input type="hidden" id="sel_dep_id" name="sel_dep_id" value="'.$dp_ID.'"/>
 <select id="sel_prog_name" name="sel_prog_name">';
 for ($i=0;$i<$num_rows;$i++) 
 {
	$s="";
   if ($pr_name==$row[$i]['name']) 
   {
		$sel_pr=$row[$i]['name'];
     $s=" selected ";
	 }
	 if ($row[$i]['group']=="")
		echo '<option '.$s.'value="'.$row[$i]["name"].'">'.$row[$i]["name"].'</option>';
	else
		echo '<option '.$s.'value="'.$row[$i]["name"].'">'.$row[$i]["name"]."-".$row[$i]["group"].'</option>';
 }
 echo'</select>
 </form>
	<script type="text/javascript">
	$("#sel_prog_name").change(function(){
    $("#prog_select").trigger("submit");
});
</script>
';
return $sel_pr;
}
function showProramSelID($dp_ID, $pr_id)
{
	
	$db = JFactory::getDBO();    
    $db->setQuery($db->getQuery(true)
        ->select('*')
        ->from("kiusc_programs")
		->where("dep_id='".$dp_ID."' order by id desc")
    );
	$db->execute();
	$num_rows = $db->getNumRows();
    $row = $db->loadAssocList();
	$sel_pr=-1;
	$prog_name="";
	$session = "";
	if ($num_rows>0)
	    {
			$sel_pr=$row[0]['id'];
			$prog_name=$row[0]['name'];
			$session=$row[0]['session'];
		}
	else
		$sel_pr=-1;
echo '
<form name="prog_select" id="prog_select" action="" method="post">
 <input type="hidden" id="sel_dep_id" name="sel_dep_id" value="'.$dp_ID.'"/>
 <input type="hidden" id="prog_name" name="prog_name" value="'.$prog_name.'"/>
 <select id="sel_prog_id" name="sel_prog_id" style="width: 250px;">';
 for ($i=0;$i<$num_rows;$i++) 
 {
	$s="";
   if ($pr_id==$row[$i]['id']) 
   {
		$sel_pr=$row[$i]['id'];
		$prog_name=$row[$i]['name'];
		$session = $row[$i]['session'];
		$s=" selected ";
	 }
	 if ($row[$i]['group']=="")
		echo '<option '.$s.'value="'.$row[$i]["id"].'">'.$row[$i]["name"].'-'.$row[$i]["session"].'</option>';
	else
		echo '<option '.$s.'value="'.$row[$i]["id"].'">'.$row[$i]["name"].'-'.$row[$i]["session"]."-".$row[$i]["group"].'</option>';
 }
 echo'</select>
 </form>
	<script type="text/javascript">
	$("#sel_prog_id").change(function(){
    $("#prog_select").trigger("submit");
});
</script>
';
return array("id"=>$sel_pr, "name"=>$prog_name, "session"=>$session);
}
/*function getProgSemData($pr_ID, $sm_id)
{
	$db = JFactory::getDBO();    
    $db->setQuery($db->getQuery(true)
        ->select('*')
        ->from("kiusc_prog_sem")
		->where("prog_id='".$pr_ID."' AND sem_id='".$sm_id."'")
    );
	$db->execute();
	$num_rows = $db->getNumRows();
    $row = $db->loadAssocList();
	$a=Array("id"=>$row[0]["id"], "sem_no"=>$row[0]["sem_no"]);
	
    return $a;
}*/
function showSemSel($semID, $department, $program, $cond)
{
	$db = JFactory::getDBO();    
	$query = $db->getQuery(true);
    $query->select('*');
    $query->from("kiusc_semesters");
	$query->order("id desc");
	if ($cond==1)
		$query->where("active='1'");
	 $db->setQuery($query);
	$db->execute();
	$num_rows = $db->getNumRows();
    $row = $db->loadAssocList();
	$sel=-1;
	
	   
echo '
<form name="sem_select" id="sem_select" action="" method="post">';
echo" <input type='hidden' id='sel_dep_id' name='sel_dep_id' value='".$department."'/>";
echo"<input type='hidden' id='sel_prog_id' name='sel_prog_id' value='".$program."'/>";
 echo'<select id="sel_sem_id" name="sel_sem_id" style="width: 250px;">';

 for ($i=0;$i<$num_rows;$i++)
 {
	if ($i==0)
	   $sel=$row[$i]['id'];
	$s="";
   if ($semID==$row[$i]['id']) 
   {
		$sel=$row[$i]['id'];
     $s=" selected ";
	}
	echo '<option '.$s.' value="'.$row[$i]['id'].'">'.$row[$i]['sem_name'].'</option>';
}
 echo'</select>
 </form>
	<script type="text/javascript">
	$("#sel_sem_id").change(function(){
    $("#sem_select").trigger("submit");
});
</script>
';
return $sel;
}
function showCourseSel($CourseID, $department, $fldArr)
{
	$db = JFactory::getDBO();    
    $db->setQuery($db->getQuery(true)
        ->select('*')
        ->from("kiusc_courses")
		->where("prog_name='".$department."'")
		->order("name" . " ASC")
    );
	$db->execute();
	$num_rows = $db->getNumRows();
    $row = $db->loadAssocList();
	
	
echo '
<form name="course_select" id="course_select" action="" method="post">
<input type="hidden" id="sel_dep_id" name="sel_dep_id" value="'.$fldArr['sel_dep_id'].'"/>
<input type="hidden" id="sel_prog_id" name="sel_prog_id" value="'.$fldArr['sel_prog_id'].'"/>
<input type="hidden" id="sel_sem_id" name="sel_sem_id" value="'.$fldArr['sel_sem_id'].'"/>
<input type="hidden" id="sel_faculty_id" name="sel_faculty_id" value="'.$fldArr['sel_faculty_id'].'"/>
 <select id="sel_course_id" name="sel_course_id">';
 $sel=-1;
 
 for ($i=0;$i<$num_rows;$i++)
 {
	if ($i==0)
	   $sel=$row[$i]['id'];
	$s="";
   if ($CourseID==$row[$i]['id']) 
   {
     $sel=$row[$i]['id'];
     $s=" selected ";
	 }
	echo '<option '.$s.' value="'.$row[$i]['id'].'">'.$row[$i]['name'].'('.$row[$i]['cr_hours'].' CHrs)</option>';
}
 echo'</select>
 </form>
	<script type="text/javascript">
	$("#sel_course_id").change(function(){
    $("#course_select").trigger("submit");
});
</script>
';
return $sel;
}
function showFacultySel($facultyID, $ProgID, $fldArr)
{
$facultyUsers = JAccess::getUsersByGroup(11);
 $sel=-1;
 //if ($num_rows>0) >>>>>>>>>>
	//$sel=0;	
	
echo '
<form name="faculty_select" id="faculty_select" action="" method="post">
<input type="hidden" id="sel_dep_id" name="sel_dep_id" value="'.$fldArr['sel_dep_id'].'"/>
<input type="hidden" id="sel_prog_id" name="sel_prog_id" value="'.$fldArr['sel_prog_id'].'"/>
<input type="hidden" id="sel_sem_id" name="sel_sem_id" value="'.$fldArr['sel_sem_id'].'"/>
 <select id="sel_faculty_id" name="sel_faculty_id">';

 $f=0;
 foreach($facultyUsers as $user_id) 
 {
 
    $user = JFactory::getUser($user_id);
    //echo $user->name;
	if ($user->block==1)
		continue;
	$s="";
	if ($f==0)
		$sel=$user->id;
   if ($facultyID==$user->id) 
   {
		$sel=$user->id;
     $s=" selected ";
	 }
	echo '<option '.$s.' value="'.$user->id.'">'.$user->name.'</option>';
	$f=$f+1;
}

echo'</select>
 </form>
	<script type="text/javascript">
	$("#sel_faculty_id").change(function(){
    $("#faculty_select").trigger("submit");
});
</script>
';	
 
return $sel;
}

function insertProgCombo($dep_id, $prog_name)
{
$db = JFactory::getDBO();    
    $db->setQuery($db->getQuery(true)
        ->select('distinct name')
        ->from("kiusc_programs")
		->where("dep_id='".$dep_id."'")
    );
	$db->execute();
	$num_rows = $db->getNumRows();
    $row = $db->loadAssocList();
	
	
echo '
 <select id="prog_name" name="prog_name">';
 $sel=-1;
 
 for ($i=0;$i<$num_rows;$i++)
 {
	if ($i==0)
	  $sel=$row[$i]['name'];
	$s="";
   if ($prog_name==$row[$i]['name']) 
   {
     $sel=$row[$i]['name'];
     $s=" selected ";
	 }
	echo '<option  '.$s.' value="'.$row[$i]['name'].'">'.$row[$i]['name'].'</option>';
  }  
  echo '</select>';
}

function courseDrowpDown($prog)
{
$db = JFactory::getDBO();    
    $db->setQuery($db->getQuery(true)
        ->select('name, prog_name, id')
        ->from("kiusc_courses")
		->where("prog_name='".$prog."'")
    );
	$db->execute();
	$num_rows = $db->getNumRows();
    $row = $db->loadAssocList();
	$data[0] = $num_rows;
	$data[1] = $row;
return $data;	
}

function showStudentSel($fldArr)
{
	$db = JFactory::getDBO();    
    $db->setQuery($db->getQuery(true)
        ->select('id, reg_no, name, fname')
        ->from("kiusc_students")
		->where("prog_id='".$fldArr['sel_prog_id']."'")
    );
	$db->execute();
	$num_rows = $db->getNumRows();
    $row = $db->loadAssocList();
	
	
echo '
<form name="student_select" id="student_select" action="" method="post">
<input type="hidden" id="sel_dep_id" name="sel_dep_id" value="'.$fldArr['sel_dep_id'].'"/>
<input type="hidden" id="sel_prog_id" name="sel_prog_id" value="'.$fldArr['sel_prog_id'].'"/>
<select id="sel_student_id" name="sel_student_id">';
 $sel=-1;
 
 for ($i=0;$i<$num_rows;$i++)
 {
	if ($i==0)
	   $sel=$row[$i]['id'];
	$s="";
   if ($fldArr['sel_student_id']==$row[$i]['id']) 
   {
     $sel=$row[$i]['id'];
     $s=" selected ";
	 }
	echo '<option '.$s.' value="'.$row[$i]['id'].'">'.$row[$i]['name'].'   ('.$row[$i]['reg_no'].')</option>';
}
 echo'</select>
 </form>
	<script type="text/javascript">
	$("#sel_student_id").change(function(){
    $("#student_select").trigger("submit");
});
</script>
';
return $sel;
}
function checkCOfferAllowed($semID)
{
	$db = JFactory::getDBO();    
    $db->setQuery($db->getQuery(true)
        ->select('course_offer')
        ->from("kiusc_semesters")
		->where("id='".$semID."'")
    );
	$db->execute();
	//$num_rows = $db->getNumRows();
    $row = $db->loadAssocList();
	//echo $num_rows;
	return $row[0]['course_offer'];
}	
function getMyDB()
{
return JFactory::getDBO();
}
function calculateQP_1($conn, $cr_hors, $tot)
{
	$marks=0;
	$GP=-1;
	$x = 0;
	switch ($cr_hors) {
		case 1:
			$marks=(($tot/100)*20);
			//echo "m_".$marks." ";
			if ($marks<10)
				$GP=0.0;
			if ($marks>16)
				$GP=4.0;
			break;
		case 2:
			$marks=(($tot/100)*40);
			if ($marks<20)
				$GP=0.0;
			if ($marks>32)
				$GP=8.0;
			break;
		case 3:
			$marks=(($tot/100)*60);
			if ($marks<30)
				$GP=0.0;
			if ($marks>48)
				$GP=12.0;
			break;
		case 4:
			$marks=(($tot/100)*80);
			if ($marks<40)
				$GP=0.0;
			if ($marks>64)
				$GP=16.0;
			break;
		case 5:
			$marks=($tot);
			if ($marks<50)
				$GP=0.0;
			if ($marks>80)
				$GP=20.0;
			break;
		case 6:
			$marks=(($tot/100)*60);
			if ($marks<30)
				$GP=0.0;
			if ($marks>48)
				$GP=12.0;
		    	$cr_hors = 3;
				$x = 1;
			break;
	}
	
	if ($GP==-1)
	{
		
		$sql = 'SELECT gp FROM kiusc_gpa_qp WHERE cr_hrs="'.$cr_hors.'" AND marks="'.$marks.'"';
		
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($result);
		$GP=$row['gp'];
		
	}
	if($x == 1)
		    $GP = $GP * 2;
	return $GP;
}

function calculateQP_2($conn, $cr_hors, $tot)
{
	if($tot < 50)
	   $GP = 0;
	else if($tot > 80)
		$GP = 4 * $cr_hors;
	else
	{
		$sql = 'SELECT gp FROM kiusc_grade_points WHERE obt_marks = '.$tot;
		//echo $sql;
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($result);
		$GP=$row['gp'] * $cr_hors;
	}
	return $GP;
}


function getKey()
{
	return 'kiu123skdcampus*';
}



function encrypt($data){
	$key = getKey();
    return base64_encode(
    mcrypt_encrypt(
        MCRYPT_RIJNDAEL_128,
        $key,
        $data,
        MCRYPT_MODE_CBC,
        "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0"
    )
);
}


function decrypt($data){
	$key = getKey();
	//$iv = substr ( $key, 0, 16 );
    $decode = base64_decode($data);
    return mcrypt_decrypt(
                    MCRYPT_RIJNDAEL_128,
                    $key,
                    $decode,
                    MCRYPT_MODE_CBC,
                    "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0"
            );
		//return	openssl_encrypt ( $data, 'AES-256-CBC', $key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $iv );
    
}

function getDegreeTitleByStdID($conn, $stud_id)
{
	$re = mysqli_query($conn,"SELECT dt.* FROM `kiusc_degree_titles` dt join kiusc_programs p on dt.id = p.degree_title_id 
	join kiusc_students s on p.id = s.prog_id WHERE s.id = '$stud_id'");
	
	$degree_title = mysqli_fetch_assoc($re);
	return $degree_title;
}

function check_std_status($conn, $stud_id, $sem_id, $cgpa, $gpa, $sem_no)
{
	$first = "1st Probation";
	$second = "2nd Probation";
	$drop = "Dropped";
	$promoted = "Promoted";
	
	$st = mysqli_query($conn,"SELECT * FROM `kiusc_std_status` WHERE `stud_id` = '$stud_id' and `sem_id` = '$sem_id'");
	$num_r = mysqli_num_rows($st);
	$st_status = mysqli_fetch_assoc($st);
	if($num_r > 0)
	{
		$id = $st_status['id'];
		mysqli_query($conn,"Delete from kiusc_std_status where id = $id");
		//return $st_status['status'];
	}
	
	
	$degree_title = getDegreeTitleByStdID($conn, $stud_id);
	$req = mysqli_query($conn,"SELECT * FROM `kiusc_gpa_requirement` WHERE `degree_title_id` = '".$degree_title['id']."'");
	$req = mysqli_fetch_assoc($req);
	
	if($sem_no > $req['upto_semester_no'])
	{
		mysqli_query($conn,"INSERT INTO `kiusc_std_status`(`stud_id`, `sem_id`, `status`) VALUES ('$stud_id','$sem_id','$promoted')");
		return $promoted;
	}
	
	if($gpa < $req['semesterGPA'])
	{
		mysqli_query($conn,"INSERT INTO `kiusc_std_status`(`stud_id`, `sem_id`, `status`) VALUES ('$stud_id','$sem_id','$drop')");
		return $drop;
	}
	
	if($sem_no == 1)
		$semester = "semester1";
	if($sem_no == 2)
		$semester = "semester2";
	if($sem_no == 3)
		$semester = "semester3";
	if($sem_no == 4)
		$semester = "semester4";
	if($sem_no == 5)
		$semester = "semester5";
	if($sem_no == 6)
		$semester = "semester6";
	if($sem_no == 7)
		$semester = "semester7";
	if($sem_no == 8)
		$semester = "semester8";
	
	if($cgpa >= $req[$semester])
	{
		mysqli_query($conn,"INSERT INTO `kiusc_std_status`(`stud_id`, `sem_id`, `status`) VALUES ('$stud_id','$sem_id','$promoted')");
		return $promoted;
	}
	else
	{
		$st = mysqli_query($conn,"SELECT * FROM `kiusc_std_status` WHERE `stud_id` = '$stud_id' and `sem_id` < '$sem_id' order by sem_id desc");
		$num_r = mysqli_num_rows($st);
		$st_status = mysqli_fetch_assoc($st);
		if($num_r < 1)
		{
			mysqli_query($conn,"INSERT INTO `kiusc_std_status`(`stud_id`, `sem_id`, `status`) VALUES ('$stud_id','$sem_id','$first')");
			return $first;
		}
		else
		{
			if($st_status['status'] == $promoted)
			{
				mysqli_query($conn,"INSERT INTO `kiusc_std_status`(`stud_id`, `sem_id`, `status`) VALUES ('$stud_id','$sem_id','$first')");
				return $first;
			}
			else if($st_status['status'] == $first)
			{
				mysqli_query($conn,"INSERT INTO `kiusc_std_status`(`stud_id`, `sem_id`, `status`) VALUES ('$stud_id','$sem_id','$second')");
				return $second;
			}
			else if($st_status['status'] == $second)
			{
				mysqli_query($conn,"INSERT INTO `kiusc_std_status`(`stud_id`, `sem_id`, `status`) VALUES ('$stud_id','$sem_id','$drop')");
				return $drop;
			}
			/*
			else if($st_status['status'] == $drop)
			{
				mysqli_query($conn,"INSERT INTO `kiusc_std_status`(`stud_id`, `sem_id`, `status`) VALUES ('$stud_id','$sem_id','$drop')");
				return $drop;
			}*/
		}
	}	
}

function sendMail($recipient=array(), $subject, $body) // $recipent is array()
{
	$mailer = JFactory::getMailer();

	//$recipient = array( 'person1@domain.com', 'person2@domain.com', 'person3@domain.com' );
	$mailer->addRecipient($recipient);

	$mailer->setSubject($subject);
	$mailer->isHTML(true);
	$mailer->Encoding = 'base64';
	$mailer->setBody($body);
	// Optional file attached
	//$mailer->addAttachment(JPATH_COMPONENT.'/assets/document.pdf');
	// Optionally add embedded image
	//$mailer->AddEmbeddedImage( JPATH_COMPONENT.'/assets/logo128.jpg', 'logo_id', 'logo.jpg', 'base64', 'image/jpeg' );

	$send = $mailer->Send();
	if ( $send !== true ) {
		echo 'Error sending email: ' . $send->__toString();
	}
	//else {
		//echo 'Mail sent';
	//}
}
function randPassword($length = 5, $add_dashes = false, $available_sets = 'luds') // luds : l=lowercase, u=upercase, d=decimal, s=special characters
{
	$sets = array();
	if(strpos($available_sets, 'l') !== false)
		$sets[] = 'abcdefghjkmnpqrstuvwxyz';
	if(strpos($available_sets, 'u') !== false)
		$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
	if(strpos($available_sets, 'd') !== false)
		$sets[] = '23456789';
	if(strpos($available_sets, 's') !== false)
		$sets[] = '!@#$%&*?';
	$all = '';
	$password = '';
	foreach($sets as $set)
	{
		$password .= $set[array_rand(str_split($set))];
		$all .= $set;
	}
	$all = str_split($all);
	for($i = 0; $i < $length - count($sets); $i++)
		$password .= $all[array_rand($all)];
	$password = str_shuffle($password);
	if(!$add_dashes)
		return $password;
	$dash_len = floor(sqrt($length));
	$dash_str = '';
	while(strlen($password) > $dash_len)
	{
		$dash_str .= substr($password, 0, $dash_len) . '-';
		$password = substr($password, $dash_len);
	}
	$dash_str .= $password;
	return $dash_str;
}
?>
