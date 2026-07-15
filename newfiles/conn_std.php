<?php
$conn_std = @mysqli_connect('127.0.0.1','uobs-sis','MH2U1PlWk9MpctHe2pTi', 'uobs-sis');

if (!$conn_std) {
	die('Could not connect student panel database: ' . mysqli_error());
}

?>

