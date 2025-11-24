<?php 


$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/demo.css");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.easyui1.min.js");

include "newfiles/common.php";
include "newfiles/conn.php";

if (checkPermission(JFactory::getUser(), "sis_settings")==0)
{
	echo"You dont have right to access this page!";
	return;
}

$months_array = array('Muharram','Safar','Rabi al-awwal','Rabi al-thani','Jumada al-awwal','Jumada al-thani','Rajab','Shaban','Ramadan','Shawwal','Dhu al-Qidah','Dhu al-Hijjah');
//*********************************insert Query**************************

     $year = 0;
	 
     if(isset($_POST['year']))
		$year = $_POST['year'];
     

    if(isset($_POST['create']))
    {
	 $hyear=mysqli_query($conn, "select * from lms_islamic_calander where hijri_year='$year'");
	 $count_re =  mysqli_num_rows($hyear);
	 if($count_re > 0)
	 {
		 echo "record already exist";
	 }
	 else
	 {
		foreach($months_array as $ma)
		{
			mysqli_query($conn, "INSERT INTO lms_islamic_calander (`hijri_year`, `hijri_month`) values( '$year','$ma')");
		} 
	 }	
    }
	
	if(isset($_POST['Update']))
	
	{
		$is_id=$_POST['eid'];
		$ndate=$_POST['hdate'];
		
		mysqli_query($conn, "UPDATE lms_islamic_calander SET date='$ndate' where id='$is_id'");
	}
	
?>

     <form method="POST" action ="" >

     <table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:90%">
     <tr>
        <td><h3>Enter Hijri year:</h3></td>
        <td><input type="number" name="year" value="<?php echo $higri ;?>" style="width:300px" min="1438"  max="1500" maxlength="4"  /></td>
		<input type="hidden" name="year_id" value="<?php echo  isset($row['id']) ? $row['id'] : ""; ?>" />
		
        <td colspan="2"></td>
        <td><input type="submit" name="create" value="create" style="background-colour: burlywood; border-radius: 17px" /></td>
     </tr>
     </table>

     </form>

     <table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:90%">
     <tr>
          <th><h3>Month Name</h3></th>
          <th><h3>date</h3></th>
<?php

    $is="select * from lms_islamic_calander where hijri_year = '$year'";
	$qury=mysqli_query($conn, $is);
	while($row=mysqli_fetch_array($qury))
	{
		$higri=$row['hijri_year'];
		$month=$row['hijri_month'];
		$date=$row['date'];
?>
		
		<tr>
		<td><?php echo $month; ?></td>
		<td><?php echo $date; ?></td>
		</tr>
		
		
    </tr>
<?php
	}
?>
    </table>
    <br>
    </br>


<?php

//*******************************************Select month function **********************************************
 $month=-1;
	 
     if(isset($_REQUEST['sel_id']))
    {
		
	$month=$_REQUEST['sel_id'];
	
    }


     $month = showSyllabusSel($conn, $month,$year);

     function showSyllabusSel($conn, $month,$year)
    {
		
     $user= JFactory::getUser();
	 
	 $sel_re =  mysqli_query($conn, "select * from lms_islamic_calander where hijri_year = '$year'");
	               
	 echo '
     <form name="sel_select" id="sel_select" action="" method="post">
	 <input type="hidden" name="year" value="'.$year.'" >
     <h3>Select Hijri month</h3>

     <select name="sel_id" style="width:450px" id="sel_id">';


     $sel_month=-1;
	 
     while($row = mysqli_fetch_assoc($sel_re))
    {
		$s="";
		if ($sel_month==-1)
		{	
			$sel_month=$row['id'];
			$s = " selected ";
		}
	   if ($month==$row['id']) 
	    {
			$sel_month=$row['id'];
			$s=" selected ";
	    }
	   
	echo '<option '.$s.' value="'.$row['id'].'">'.$row['hijri_month'].'</option>';
	
     }

     echo'</select>
	 <br>
	 </br>

     </form>';
 
?>

     <script type="text/javascript">
     $("#sel_id").change(function()
	{
		$("#sel_select").trigger("submit");
	}
     );

     </script>

<?php

     return $sel_month;
    }
	
	
	
	//***************************************date form**********************************
	?>
	
	<form method="POST" action ="" >

<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:90%">

<?php

    $is="select * from lms_islamic_calander where id = '$month'";
	$qury=mysqli_query($conn, $is);
	$row=mysqli_fetch_array($qury);	
	$hdate=$row['date'];
?>
<tr>
<td><h3>Date:</h3></td>
<td><input type="date" name="hdate" value="<?php echo $hdate;?>" style="width:300px" maxlength="4" //></td>
<input type="hidden" name="year" value="<?php echo $year ?>" />
<input type="hidden" name="sel_id" value="<?php echo $month ?>" />
<input type="hidden" name="eid" value="<?php print isset($row['id']) ? $row['id'] :"" ?>" />
<td colspan="2"></td>
<td><input type="submit" name="Update" value="Update" style="background-colour: burlywood; border-radius: 17px" /></td>
</tr>
</table>

</form>





