<?php
include "newfiles/conn.php";
include 'newfiles/common.php';

if (checkPermission(JFactory::getUser(), "job_evaluate_applicant")==0)
{
	echo"You dont have right to access this page!";
	return;
}

	
	
$db = JFactory::getDBO();    
	$query = $db->getQuery(true);
    $query->select('*')
		  ->from("kiusc_jobs")
		  ->where('active = 1');
		  
	$db->setQuery($query);
	$db->execute();
    $jobs = $db->loadAssocList();	
	
if(isset($_REQUEST['merit_list']))
{
	$job_id = $_REQUEST['job_id'];
	header("location: ".JURI::root( true ). "/newfiles/jobs/merit/phpExcelExport.php?job_id=".$job_id);
}
?>


<h2> Merit List </h2>

<hr />
<form action="" method="post">

<table>

<tr>    
	<td> Select Job: </td>
    <td> <select name="job_id">
    <?php foreach($jobs as $job):	?>
    		<option value="<?php echo $job['id'] ?>" > <?php echo $job['post'] ?> </option>
    <?php endforeach; ?>
    	</select>
     </td>
	<td><input type="submit" name="merit_list" value="Generate" style="background-color: burlywood; border-radius: 17px; color: black;" /> </td>
    
</tr>    

</table>
</form>
