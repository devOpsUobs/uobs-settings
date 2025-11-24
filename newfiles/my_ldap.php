<?php
function create_ldap_connection() 
{
	$ip = "192.168.1.4";
	$ldaps_url = "ldaps://$ip";
	$port = 389;
	//636
	$ldap_conn = ldap_connect( $ldaps_url, $port ) or die("Sorry! Could not connect to LDAP server ($ip)");

	ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);

	$username = "Administrator";
	$password = "Win2016";
	//$binddn = "CN=Administrator,CN=users,DC=kiuskd,DC=com";
	//$binddn = "CN=Administrator,CN=Users,DC=uobskardu,DC=net";
	$binddn = "CN=Administrator,CN=Users,DC=uobscms,DC=net";

	$result = ldap_bind( $ldap_conn, $binddn, $password ) or die("
	Error: Couldn't bind to server using provided credentials!");


	if($result) {
	return $ldap_conn;
	} else {
	die("
	Error: Couldn't bind to server with supplied credentials!");
	}
}

function get_user_dn( $ldap_conn, $user_name, $ou ) 
{
/* Write the below details as per your AD setting */
//$basedn = "OU=".$ou.",DC=Uobskardu,DC=net";
$basedn = "OU=".$ou.",DC=uobscms,DC=net";
/* Search the user details in AD server */
$searchResults = ldap_search( $ldap_conn, $basedn, $user_name );
if ( !is_resource( $searchResults ) )
die('Error in search results.');

/* Get the first entry from the searched result */
$entry = ldap_first_entry( $ldap_conn, $searchResults );
return ldap_get_dn( $ldap_conn, $entry );
}

function pwd_encryption( $newPassword )
 {
$newPassword = "\"" . $newPassword . "\"";
$len = strlen( $newPassword );
$newPassw = "";
for ( $i = 0; $i < $len; $i++ )
{ 
$newPassw .= "{$newPassword{$i}}\000"; 
} 
$userdata["unicodePwd"] = $newPassw; 
return $userdata; 
} 

function changePassword($un, $pwd, $ou)
{
	$user_name = "(sAMAccountName=".$un.")";
	//Dont remove parentheses brackets 
	$user_password = $pwd; 
	$ldap_conn = create_ldap_connection(); 
	$userDn = get_user_dn($ldap_conn, $user_name, $ou); 
	$userdata = pwd_encryption($user_password); 
	$result = ldap_mod_replace($ldap_conn, $userDn , $userdata); 
	/* Check whether the password updated successfully or not. */ 
	if ( $result )
	{		
		//die("Password changed successfully!"); 
	}
	else 
		die("Error: Please try again later!");
}
function addUserToGroup($con, $uname, $group, $ou)
{
	$entry[]="CN=".$uname.",OU=".$ou.",DC=uobscms,DC=net";
	//$entry[]="CN=".$uname.",OU=".$ou.",DC=Uobskardu,DC=net";
	$adduserAD['member']=$entry;
	//$ds = create_ldap_connection();
	ldap_mod_add($con, 'CN='.$group.',OU='.$ou.',DC=uobscms,DC=net', $adduserAD);
	//ldap_mod_add($con, 'CN='.$group.',OU='.$ou.',DC=Uobskardu,DC=net', $adduserAD);
}

function createUser($name, $uname, $password, $group,$ou)
{
    $ds = create_ldap_connection();
	
	//$uname = 'testuser4';
    $binddn = "CN=$uname,OU=$ou,DC=uobscms,DC=net";
	//$binddn = "CN=$uname,OU=$ou,DC=uobskardu,DC=net";
	
    
	
	//$adduserAD['member']=$members;
	$adduserAD["cn"] = $uname;
	$adduserAD["givenname"] = $name; // First name
	$adduserAD["sn"] = '-';  /// Last name)
	$adduserAD["sAMAccountName"] = $uname;
	//$adduserAD['userPrincipalName'] = "testuser@nagara.ca";
	$adduserAD["objectClass"] = "user";
	$adduserAD["displayname"] = $name;
	$pass = pwd_encryption($password);
	$adduserAD["userPassword"] = $pass["unicodePwd"];
	$adduserAD["userAccountControl"] = "544";

	
	if(ldap_add($ds, $binddn, $adduserAD) == true)
	{
		//$group = 'KiuStudent';
		addUserToGroup($ds, $uname, $group, $ou);
		//echo "User added!<br>";
	}else{

	// This error message will be displayed if the user
	// was not able to be added to the AD structure.
	echo "Sorry, the user was not added.<br>Error Number: ";
	echo ldap_errno($ds) . "<br />Error Description: ";
	echo ldap_error($ds) . "<br />";
	}
	
	ldap_close($ds); 
}

function myldap_delete($uname, $ou)
{
	$dn = "CN=$uname,OU=$ou,DC=uobscms,DC=net";
	//$dn = "CN=$uname,OU=$ou,DC=Uobskardu,DC=net";
	$ds = create_ldap_connection();

    if(!ldap_delete($ds,$dn))
		print "Could not delete!";
}

?>