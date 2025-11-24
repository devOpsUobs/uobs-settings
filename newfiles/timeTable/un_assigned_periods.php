<?php
$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/demo.css");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.easyui1.min.js");

include "newfiles/conn.php";
include "common.php";
if(checkPermission(JFactory::getUser(),"timetable_setting")==0)
{
	echo "You cannot access this site";	
	return ;
}

$dept=-1;
if(isset($_REQUEST['department_id']))
{
	$dept=$_REQUEST['department_id'];
}

?>

<?php
echo '
<table>
	<tr>
		<td> 
			Select Department : 
		</td>
		<td>';
			$dept = showDepartmentSel($conn, $dept);
echo '	</td>
	</tr>';
?>
</table>

<br /><br />
<table border="1px" style="width:100%">
	<tr>
        <th>Serial #</th>
        <th>Program</th>
        <th>Faculty</th>
        <th>Course</th>
    </tr>
    <?php
	$i=0;
    $pe = mysqli_query($conn,"select p.name as pname, p.session,p.group, c.name as cname,u.name as uname from kiusc_timetable t join kiusc_course_offered o on t.c_offer_id=o.id 
			join kiusc_courses c on o.course_id=c.id join kiusc_programs p on p.id=o.prog_id join s04cf_users u on u.id=o.fac_id where day='' 
			and p.dep_id='$dept' and is_changed =0 and o.sem_id = 28");
			
	while($re=mysqli_fetch_assoc($pe))
	{
		$i++;
	?>
    <tr>
        <td><?php echo $i; ?></td>
		<td><?php echo $re['pname'] ."-". $re['session']."-". $re['group']; ?></td>
		<td><?php echo $re['uname']; ?></td>
		<td><?php echo $re['cname']; ?></td>
    </tr>
	<?php
	}
	?>
	</table>