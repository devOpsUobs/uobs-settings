<?php

include "../../conn.php";

$desg_id = $_GET['desg_id'];

$designation = mysqli_query($conn, "SELECT * FROM `kiusc_designations` where id = '$desg_id'");
$designation = mysqli_fetch_assoc($designation);

echo $designation['type'];
?>