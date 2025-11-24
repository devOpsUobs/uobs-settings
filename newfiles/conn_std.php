<?php
$conn_std = @mysqli_connect('127.0.0.1','root','bus@2017**', 'uobs-std');
if (!$conn_std) {
	die('Could not connect student panel database: ' . mysqli_error());
}

?>

