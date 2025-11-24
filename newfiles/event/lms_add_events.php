<?php
include 'newfiles/common.php';
include "newfiles/conn.php";


$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/demo.css");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.easyui1.min.js");




if (checkPermission(JFactory::getUser(), "sis_settings")==0)
{
	echo"You dont have right to access this page!";
	return;
}	


$hijri_array = array("1"=>'Muharram',"2"=>'Safar',"3"=>'Rabi al-awwal',"4"=>'Rabi al-thani',"5"=>'Jumada al-awwal',"6"=>'Jumada al-thani',"7"=>'Rajab',"8"=>'Shaban',"9"=>'Ramadan',"10"=>'Shawwal',
"11"=>'Dhu al-Qidah',"12"=>'Dhu al-Hijjah');
$national_array = array("1"=>'January',"2"=>'February',"3"=>'March',"4"=>'April',"5"=>'May',"6"=>'June',"7"=>'July',"8"=>'August',"9"=>'September',"10"=>'October',
"11"=>'November',"12"=>'December');
//********************************************** ISLAMIC Event *************************************************

$hijri_month=-1;
if(isset($_REQUEST['hijri_id']))
{
	$hijri_month=$_REQUEST['hijri_id'];
}


$hijri_month = showHijriMonthSel($conn, $hijri_array,$hijri_month);


function showHijriMonthSel($conn, $hijri_array,$hijri_month)
{

	               
	 
echo '
<form name="hijri_select" id="hijri_select" action="" method="post">
<h3>Select Hijri month</h3>

<select name="hijri_id" style="width:500px" id="hijri_id">';



 $hijri=-1;
foreach($hijri_array as $hijriar=>$hijri_value)
		{
			$sel = "";
			if($hijri==-1)
		
		     {	
			$hijri=$hijriar;
			$sel = " selected ";
		     }
			if($hijri_month == $hijriar)
			{
				$hijri = $hijriar;
				$sel = " selected ";
				
			}
		 
			echo '<option value="'.$hijriar.'" '. $sel . '>'.$hijri_value.'</option>';

		}

echo'</select>
<br></br>
 </form>';
 
?>

<script type="text/javascript">
$("#hijri_id").change(function()
	{
		$("#hijri_select").trigger("submit");
	}
);

</script>

<?php
return $hijri;
}

 
				   



 if(isset($_POST['islamic']))
	{
	  $h_id=$_POST['h_id'];
	 $h_day = $_POST['day'];
     $h_name = $_POST['h_name'];
	 $h_remarks = $_POST['h_remarks'];
	 if($h_id=='')
	 {
		 
	
	 
	mysqli_query($conn, "INSERT INTO `lms_islamic_events`(`id`, `day`, `month`, `event_name`, `remarks`) 
	VALUES ('','$h_day','$hijri_month','$h_name','$h_remarks')");
	 }
	 else
	 {
		 mysqli_query($conn, "UPDATE lms_islamic_events SET day='$h_day', event_name='$h_name', remarks='$h_remarks' where id='$h_id'");
		 
	 } 
	
	}
	
	
	 if(isset($_GET['del']))
        {
	       mysqli_query($conn, "DELETE FROM `lms_islamic_events` WHERE id=".$_GET['del']);
        }

        if(isset($_GET['edit']))
		{
			
	       $update=mysqli_query($conn, "select * from lms_islamic_events where id=".$_GET['edit']);
		   $co=mysqli_fetch_assoc($update);
		}	

?>


<?php
			print "<h2>Show Islamic Events </h2>";
	?>
                  		                                      
    <div align="center" style="font-color:#CCC;"></div>
	
    <table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%">
	
	                         
							 <th><h3>Hijri Month</h3></th>
							 <th><h3>Hijri Date</h3></th>
                             <th><h3>Hijri Event</h3></th>
                             <td><h3>Remarks</h3></td>
                             <th><h3>Action<h3></th>
                            
                                 <?php
								 $rowindex = 0;
								 $cssstyle = "even";
								 $event = "SELECT * from lms_islamic_events  where month='$hijri_month' "; 
								 $sql=mysqli_query($conn, $event);
								 
                                  while($row = mysqli_fetch_array($sql))
                                    {
								 if($rowindex % 2 == 0 ) $cssstyle = "even"; else $cssstyle = "odd";
								          
										   $hmonth = $row['month'];
										  $hday = $row['day'];
						                  $hname = $row['event_name'];
                                          $hremarks = $row['remarks'];
                                          
										 
								  ?>
                                <tr class="<?php echo $cssstyle;?>">
								<td> <?php echo  $hmonth;?></td>
                                 <td> <?php echo  $hday;?></td>
									<td> <?php echo $hname;?></td>
                                    <td><?php echo $hremarks;?></td>
                                    
                                    <td><a href="index.php/cms-setting/calendar-setting/add-events?edit=<?php echo $row['id']?>" >Edit</a><br>
									<a href="index.php/cms-setting/calendar-setting/add-events?del=<?php echo $row['id'] ?>"onclick="return confirm('Are you sure?')">Delete</a>
									</td>
                                </tr>
                                         
                                <?php
                                   $rowindex ++;
								   }
                                ?>
                                
                                
                                
                            </table>
                            
                           <br>
						   </br>
						   <br>
						   </br>
  
      



               <form action="" method="POST" >
	         
			<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%">
			<?php
			   print "<h2>Add Hijri Event Form</h2>";
	          ?>

 
	
          
            
			 
			  <tr>
	         <td><h4>Hijri Day :</h4> </td>
			 <td>
			 <input type="number" name="day" style="width: 500px" value="<?php echo isset($co['day']) ? $co['day']: ""; ?>" required />

			<br>
			</br>
			</td>
             </tr>
			</tr>
	        <tr>
	        <td><h4>Event Name :</h4> </td>
            <td><input type="text" name="h_name" style="width:500px" value="<?php echo isset($co['event_name']) ? $co['event_name']: ""; ?>" required /></td>
             </tr>
              <tr>
	         <td><h4>Remarks :</h4> </td>
            <td><input type="text" name="h_remarks" style="width:500px" value="<?php echo isset($co['remarks']) ? $co['remarks']: ""; ?>"  /><br></br></td>
             </tr>
			  <tr>
	           
             <tr>
			<input type="hidden" name="h_id" value="<?php echo  isset($co['id']) ? $co['id'] : ""; ?>" />
			  <input type="hidden" name="hijri_id" value="<?php echo $hijri_month ?>" />
		
			   <td colspan="2"> </td>
			<td><input type="submit" name="islamic" value="<?php echo  isset($co['id']) ? "UPDATE" : "INSERT" ; ?>" style="background-color: burlywood; border-radius: 20px; color: black;" /></td></tr>
            </table>
            
</form>

<?php
//********************************************** General Event *************************************************


$sel_month=-1;
if(isset($_REQUEST['sel_id']))
{
	$sel_month=$_REQUEST['sel_id'];
}


$sel_month = showMonthSel($conn, $national_array,$sel_month);


function showMonthSel($conn, $national_array,$sel_month)
{
	
	 
echo '
<form name="sel_select" id="sel_select" action="" method="post">
<h3>Select month</h3>

<select name="sel_id" style="width:500px" id="sel_id">';



 $nal_month=-1;
foreach($national_array as $nalar=>$nal_value)
		{
			$sel_sel = "";
			if( $nal_month==-1)
		
		     {	
			$nal_month=$nalar;
			$sel_sel = " selected ";
		     }
			if($sel_month == $nalar)
			{
				$nal_month = $nalar;
				$sel_sel = " selected ";
				
			}
		 
			echo '<option value="'.$nalar.'" '. $sel_sel . '>'.$nal_value.'</option>';

		}
echo'</select>
<br></br>
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
return $nal_month;
}

 
				   



 if(isset($_POST['general']))
{
	 $gid=$_POST['g_id'];
	 $gday = $_POST['d_id'];
	 $gname = $_POST['gname'];
	 $gremarks = $_POST['gremarks'];
	 if($gid=='')
	 {
		mysqli_query($conn, "INSERT INTO `lms_national_events`(`id`, `day`, `n_month`, `event_name`, `remarks`) 
		VALUES ('','$gday','$sel_month','$gname','$gremarks')");
	 }
	 else
	 {

		 mysqli_query($conn, "UPDATE lms_national_events SET day='$gday', event_name='$gname', remarks='$gremarks' where id='$gid'");
		 
	 } 
	
}
	
	
	 if(isset($_GET['del']))
        {
	       mysqli_query($conn, "DELETE FROM `lms_national_events` WHERE id=".$_GET['del']);
        }

        if(isset($_GET['edit']))
		{
			
	       $update=mysqli_query($conn, "select * from lms_national_events where id=".$_GET['edit']);
		   $co=mysqli_fetch_assoc($update);
		}	

?>


<?php
			print "<h2>Show National Events </h2>";
	?>
                  		                                      
    <div align="center" style="font-color:#CCC;"></div>
	
    <table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%">
	
	                         
							 <th><h3>Month</h3></th>
							 <th><h3>Date</h3></th>
                             <th><h3>Event Name</h3></th>
                             <td><h3>Remarks</h3></td>
                             <th><h3>Action<h3></th>
                            
                                 <?php
								 $rowindex = 0;
								 $cssstyle = "even";
								 $event = "SELECT *  from lms_national_events  where n_month='$sel_month' "; 
								 $sql=mysqli_query($conn, $event);
								 
                                  while($row = mysqli_fetch_array($sql))
                                    {
								 if($rowindex % 2 == 0 ) $cssstyle = "even"; else $cssstyle = "odd";
								          
										   $month = $row['n_month'];
										  $day = $row['day'];
						                  $name = $row['event_name'];
                                          $remarks = $row['remarks'];
                                          
										 
								  ?>
                                <tr class="<?php echo $cssstyle;?>">
								<td> <?php echo  $month;?></td>
                                 	<td> <?php echo  $day;?></td>
									
                                	<td> <?php echo $name;?></td>
                                    <td><?php echo $remarks;?></td>
                                    
                                    <td><a href="index.php/cms-setting/calendar-setting/add-events?edit=<?php echo $row['id']?> &sel_id=<?php echo $sel_month?>" >Edit</a><br>
									<a href="index.php/cms-setting/calendar-setting/add-events?del=<?php echo $row['id'] ?>"onclick="return confirm('Are you sure?')">Delete</a>
									</td>
                                </tr>
                                         
                                <?php
                                   $rowindex ++;
								   }
                                ?>
                                
                                
                                
                            </table>
						
                            
                           <br>
						   </br>
						   <br>
						   </br>
						   <br>
						   <br>
						   <br>
  
      


                   
               <form action="" method="POST" >
	         
			<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:80%">
			<?php
			   print "<h3>Add National Event</h3>";
	          ?>

            <tr>
	         <td><h4> Day :</h4> </td>
			 <td>
			 <input type="number" name="d_id" style="width: 500px" value="<?php echo isset($co['day'])? $co['day']: "";?>" required />
			</td>
			<br>
			</br>
			</td>
             </tr>
			</tr>
	        <tr>
	        <td><h4>Event Name :</h4> </td>
            <td><input type="text" name="gname" style="width:500px" value="<?php echo isset($co['event_name']) ? $co['event_name']: ""; ?>" required /></td>
             </tr>
              <tr>
	         <td><h4>Remarks :</h4> </td>
            <td><input type="text" name="gremarks" style="width:500px" value="<?php echo isset($co['remarks']) ? $co['remarks']: ""; ?>"  /><br></br></td>
             </tr>
			  <tr>
	           
             <tr>
			<input type="hidden" name="g_id" value="<?php echo  isset($co['id']) ? $co['id'] : ""; ?>" />
			  <input type="hidden" name="sel_id" value="<?php echo $sel_month ?>" />
		
			   <td colspan="2"> </td>
			<td><input type="submit" name="general" value="<?php echo  isset($co['id']) ? "UPDATE" : "INSERT" ; ?>" style="background-color: burlywood; border-radius: 20px; color: black;" /></td></tr>
            </table>
            
</form>


<?php

//********************************************** UoBS Event *************************************************

if(isset($_POST['kiu_save']))
{
	$kid=$_POST['k_id'];
	 $fdate = $_POST['fdate'];
	 $tdate = $_POST['tdate'];
     $kname = $_POST['name'];
	 $kholidays = $_POST['kday'];
	 if($kid=='')
	 {
		 
	
	 
	mysqli_query($conn, "INSERT INTO `lms_kiu_events`(`id`, `date_from`,  `date_to`, `eve_id`, `remarks`) 
	VALUES ('','$fdate', ' $tdate', '$kname','$kholidays')");
	 }
	 else
	 {
		 mysqli_query($conn, "UPDATE lms_kiu_events SET `date_from`='$fdate', `date_to`='$tdate', eve_id='$kname', remarks='$kholidays' where id='$kid'");
		 
	 }
}
	
	
	 if(isset($_GET['del']))
        {
	       mysqli_query($conn, "DELETE FROM `lms_kiu_events` WHERE id=".$_GET['del']);
        }

        if(isset($_GET['edit']))
		{
			
	       $update=mysqli_query($conn, "select * from lms_kiu_events where id=".$_GET['edit']);
		   $co=mysqli_fetch_assoc($update);
		}	

?>


<?php
			print "<h2>Show UoBS Events Form</h2>";
	?>
                  		                                      
    <div align="center" style="font-color:#CCC;"></div>
	
    <table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%">
	
	                         <th><h3>Date From</h3></th>
							 <th><h3>Date To</h3></th>
                             <th><h3>Event Name</h3></th>
                             <td><h3>Remarks</h3></td>
                             <th><h3>Action<h3></th>
                            
                                 <?php
								 $rowindex = 0;
								 $cssstyle = "even";
								 $kevent="SELECT ke.*, enm.event_name from lms_kiu_events ke join lms_kiu_event_name enm on enm.id=ke.eve_id"; 
								 $sql=mysqli_query($conn, $kevent);
								 
                                  while($row = mysqli_fetch_array($sql))
                                    {
								 if($rowindex % 2 == 0 ) $cssstyle = "even"; else $cssstyle = "odd";
								          $kiu_date = $row['date_from'];
										    $date_to = $row['date_to'];
						                  $kiu_name = $row['event_name'];
                                          $kiu_holy = $row['remarks'];
                                          
										 
								  ?>
                                <tr class="<?php echo $cssstyle;?>">
                                 	<td> <?php echo  $kiu_date;?></td>
									<td> <?php echo  $date_to;?></td>
                                	<td> <?php echo $kiu_name;?></td>
                                    <td><?php echo $kiu_holy;?></td>
                                    
                                    <td><a href="index.php/cms-setting/calendar-setting/add-events?edit=<?php echo $row['id']?>" >Edit</a><br>
									<a href="index.php/cms-setting/calendar-setting/add-events?del=<?php echo $row['id'] ?>"onclick="return confirm('Are you sure?')">Delete</a>
									</td>
                                </tr>
                                         
                                <?php
                                   $rowindex ++;
								   }
                                ?>
                                
                                
                                
                            </table>
							
                            
                           <br>
						   </br>
						   <br>
						   </br>
  
      



               <form action="" method="POST" >
	         
			<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%">
			<?php
			   print "<h2>Add UoBS Event Form</h2>";
	          ?>

            <tr>
			<td><h4>Event Name :</h4></td><td>
			<select name="name" style="width:500px" required >
			<option value="">--Select Event Name--</option>
			<?php
			
			$select_query="SELECT * from lms_kiu_event_name";
			$result=mysqli_query($conn, $select_query);
			
			while($row=mysqli_fetch_assoc($result))
			{
				 $id= $row['id'];
	             $lname= $row['event_name'];
	             echo '<option value="'.$id.'">'.$lname.'</option>';
	             
				
			}
			?>
			
			</select>
			</td>
			</tr>
	        <tr>
	         <td><h4> Date From :</h4> </td>
            <td><input type="date" name="fdate" style="width:500px" value="<?php echo isset($co['date_from']) ? $co['date_from']: ""; ?>" required  /> <br></br></td>
			<br>
			</br>
             </tr>
			</tr>
			<tr>
	         <td><h4> Date To :</h4> </td>
            <td><input type="date" name="tdate" style="width:500px" value="<?php echo isset($co['date_to']) ? $co['date_to']: ""; ?>" required  /> <br></br></td>
			<br>
			</br>
             </tr>
			</tr>
	       
              <tr>
	         <td><h4>Remarks :</h4> </td>
            <td><input type="text" name="kday" style="width:500px" value="<?php echo isset($co['remarks']) ? $co['remarks']: ""; ?>"  /><br></br></td>
             </tr>
			  <tr>
	           
             <tr>
			 <input type="hidden" name="k_id" value="<?php echo isset($co['id'])? $co['id']: ""; ?>" />
		
		
			   <td colspan="2"> </td>
			<td><input type="submit" name="kiu_save" value="<?php echo  isset($co['id']) ? "UPDATE" : "INSERT" ; ?>" style="background-color: burlywood; border-radius: 20px; color: black;" /></td></tr>
            </table>
            
</form>



