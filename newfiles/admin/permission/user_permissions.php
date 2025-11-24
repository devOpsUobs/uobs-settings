<?php
$doc->addStyleSheet(JURI::root( true )."/dropdown2/plugins.css");
$doc->addScript(JURI::root( true )."/dropdown2/jquery.js");
$doc->addScript(JURI::root( true )."/dropdown2/jquery-ui.min.js");
$doc->addScript(JURI::root( true )."/dropdown2/jquery.cooki.js");
$doc->addScript(JURI::root( true )."/dropdown2/plugins.js");
$doc->addScript(JURI::root( true )."/dropdown2/scripts.js");

include "newfiles/conn.php";
include "newfiles/common.php";

if (checkPermission(JFactory::getUser(), "ldap_create_account")==0)
{
	echo"You dont have right to access this page!";
	return;
}


$user_id = -1;
if(isset($_POST['user_id']))
	$user_id = $_POST['user_id'];

$group_id = -1;
if(isset($_POST['group_id']))
	$group_id = $_POST['group_id'];
	
	
if(isset($_POST['user_form']))
{
	
	$user_id = $_POST['user_id'];
	$group_ids = $_POST['group_ids'];
	
	mysqli_query($conn,"DELETE FROM `s04cf_user_usergroup_map` WHERE `user_id`= '$user_id'");
	foreach($group_ids as $g_id)
	{
		mysqli_query($conn,"INSERT INTO `s04cf_user_usergroup_map`(`user_id`, `group_id`) VALUES ('$user_id','$g_id')");
	}
}

if(isset($_POST['group_form']))
{
	
	$user_ids = $_POST['user_ids'];
	$group_id = $_POST['group_id'];
	
	mysqli_query($conn,"DELETE FROM `s04cf_user_usergroup_map` WHERE `group_id`= '$group_id'");
	foreach($user_ids as $u_id)
	{
		mysqli_query($conn,"INSERT INTO `s04cf_user_usergroup_map`(`user_id`, `group_id`) VALUES ('$u_id','$group_id')");
	}
}
	
$db = JFactory::getDBO();    
	$query = $db->getQuery(true);
    $query->select('*')
		  ->from("s04cf_users");
		  
	$db->setQuery($query);
	$db->execute();
    $users = $db->loadAssocList();


$db = JFactory::getDBO();    
	$query = $db->getQuery(true);
    $query->select('*')
		  ->from("s04cf_usergroups")
		  ->where("parent_id = 2");
		  
	$db->setQuery($query);
	$db->execute();
    $groups = $db->loadAssocList(); 
	
?>

<div style="float:left; width:49%">
<form action="" method="post">
<table>
<tr>
	<td> Select User:  </td>
	<td> <select name="user_id">
    		<option value=""> Select user </option> 
		<?php foreach($users as $us): 
				$sel = "";
				if($us['id'] == $user_id)
					$sel = "selected";
		?>
        	<option value="<?php echo $us['id'] ?>" <?php echo $sel ?>> <?php echo $us['name'] ?> </option>
		<?php endforeach; ?>
		</select>
	</td>
	<td> <input type="submit" /> </td>
</tr>
</table>
</form>
</div>

<div>
<form action="" method="post">
<table>
<tr>
	<td> Select Permission:  </td>
	<td> <select name="group_id">
    		<option value=""> Select user </option> 
		<?php foreach($groups as $gp): 
				$sel = "";
				if($gp['id'] == $group_id)
					$sel = "selected";
		?>
        	<option value="<?php echo $gp['id'] ?>" <?php echo $sel ?>> <?php echo $gp['title'] ?> </option>
		<?php endforeach; ?>
		</select>
	</td>
	<td> <input type="submit" /> </td>
</tr>
</table>
</form>
</div>

<hr />


<div>

<?php if($user_id > 0) : ?>
<form action="" method="post">

<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:30%">
<input type="hidden" name="user_id" value="<?php echo $user_id ?>" />


<?php
$user = JFactory::getUser($user_id);
$groupsname = getUserGroupsname($user);  /// in common.php

foreach($groups as $gp) : ?>

<tr>
	<td> <?php echo $gp['title'] ?> : </td>
    <td> 
    <?php
	//print_r ($groupsname);
	if (in_array($gp['title'], $groupsname))
		$sel = "checked";
	else
		$sel = "";
	?>

    <input type="checkbox" name="group_ids[]" value="<?php echo $gp['id'] ?>"  <?php echo $sel ?>  />
    
    </td>
</tr>

<?php endforeach; ?>

</table>

<input type="submit" name="user_form" value="Update" style="background-color: burlywood; border-radius: 17px; color: black;" />
</form>

<?php endif; ?>
</div>


<div style="margin-left:50%">

<?php if($group_id > 0) : ?>
<form action="" method="post">

<table style="border-collapse: inherit;border: 1px solid; border-spacing: 1px; width:100%">
<input type="hidden" name="group_id" value="<?php echo $group_id ?>" />

<?php
	$userByGroup = getUsersByGroup($group_id);
	foreach($userByGroup as $us): ?>
<tr>
	<td> <?php echo $us['name'] ?> : </td>
    <td> <input type="checkbox" name="user_ids[]" value="<?php echo $us['id'] ?>" checked="checked" /> </td>
</tr>

<?php endforeach; ?>

</table>

<input type="submit" name="group_form" value="Update" style="background-color: burlywood; border-radius: 17px; color: black;" />
</form>

<?php endif; ?>
</div>

<?php

function getUsersByGroup($group_id)
{
	$db = JFactory::getDBO();    

    $db->setQuery($db->getQuery(true)
        ->select('u.*')
		->from("#__users u")
        ->join("INNER","#__user_usergroup_map ug on u.id = ug.user_id")
		->where("ug.group_id =". $group_id)
    );
   
   $users = $db->loadAssocList();

    return $users;
}
?>