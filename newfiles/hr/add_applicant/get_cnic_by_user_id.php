<?php

include_once "../../conn.php";


if(isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    
    // Query to get CNIC from kiusc_employee table
    $employees = mysqli_query($conn, "SELECT cnic FROM `kiusc_employees` where user_id = '$user_id'");
    $employee = mysqli_fetch_assoc($employees);    
    if($employee) {
        echo json_encode(['success' => true, 'cnic' => $employee['cnic']]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'User ID not provided.']);
}
?>
