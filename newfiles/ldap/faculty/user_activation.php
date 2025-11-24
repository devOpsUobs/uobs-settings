<?php
$doc = JFactory::getDocument();
$doc->addStyleSheet(JURI::root( true )."/dropdown2/plugins.css");
$doc->addScript(JURI::root( true )."/dropdown2/jquery.js");
$doc->addScript(JURI::root( true )."/dropdown2/jquery-ui.min.js");
$doc->addScript(JURI::root( true )."/dropdown2/jquery.cooki.js");
$doc->addScript(JURI::root( true )."/dropdown2/plugins.js");
$doc->addScript(JURI::root( true )."/dropdown2/scripts.js");

include "newfiles/conn.php";
include 'newfiles/common.php';

if (checkPermission(JFactory::getUser(), "ldap_create_account")==0)
{
	echo"You dont have right to access this page!";
	return;
}	


$user_id = -1;
if(isset($_POST['user_id']))
	$user_id = $_POST['user_id'];

if(isset($_POST['active']))
{
	$block = 1;
	if(isset($_POST['block']))
		$block = $_POST['block'];
	
	mysqli_query($conn, "UPDATE `s04cf_users` SET `block`= '$block' WHERE id = '$user_id'");
	
}

$db = JFactory::getDBO();    
	$query = $db->getQuery(true);
    $query->select('*')
		  ->from("s04cf_users");
		  
	$db->setQuery($query);
	$db->execute();
    $users = $db->loadAssocList();

?>

<h3> User Activation </h3>

<hr />

<form id="user_form" action="" method="post">
	<select name="user_id" id="user_sel_id">
    		<option value=""> Select user </option> 
		<?php foreach($users as $us): 
				$sel = "";
				if($us['id'] == $user_id)
					$sel = "selected";
				if($us['id'] == 245) //// 245 = super user
					continue; 
		?>
        	<option value="<?php echo $us['id'] ?>" <?php echo $sel ?>> <?php echo $us['name'] ?> </option>
		<?php endforeach; ?>
		</select>
</form>

<script type="text/javascript">
	$("#user_sel_id").change(function(){
    $("#user_form").trigger("submit");
});

</script>


<hr />


<?php 
if($user_id > 0)
{
	$sel_user = JFactory::getUser($user_id);
?>

<form action="" method="post">
<table style="width:60%">

<tr>
	<th> Full Name:  </th>
	<td> <?php echo $sel_user->name; ?> </td>
    <th> Email:  </th>
	<td> <?php echo $sel_user->email; ?> </td>
</tr>
<tr>
    <th> Username:  </th>
	<td> <?php echo $sel_user->username; ?> </td>
    <th> Enabled </th>
	<td> <input type="checkbox" name="block" value="0" <?php echo ($sel_user->block == 0) ? "checked" : "" ; ?> /> </td>
    <input type="hidden" name="user_id" value="<?php echo $user_id ?>" />
</tr>

</table>

<input type="submit" name="active" value="Save" style="background-color: burlywood; border-radius: 17px; color: black;" />

</form>

<?php 
} 
?>