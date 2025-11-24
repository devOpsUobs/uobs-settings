<?php

include_once "../../conn.php";

$cnic = $_POST['cnic'];
// echo "SELECT user_id FROM `kiusc_employees` where cnic = '$cnic'";

$employees = mysqli_query($conn, "SELECT user_id FROM `kiusc_employees` where cnic = '$cnic'");
$user = mysqli_fetch_assoc($employees);
$user_id = $user['user_id'];


if ($user_id) {
    echo json_encode(['success' => true, 'user_id' => $user_id]);
} else {
    echo json_encode(['success' => false]);
}

?>