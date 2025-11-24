<?php
include "../../newfiles/conn.php";

if(isset($_POST['eval_type_id'])) {
    $eval_type_id = $_POST['eval_type_id'];

    $categories = mysqli_query($conn, "SELECT * FROM `kiusc_eval_ques_category` WHERE eval_type_id = '$eval_type_id' and active=1");

    while($cat = mysqli_fetch_assoc($categories)) {
        echo "<option value='".$cat['id']."'>".$cat['name']."</option>";
    }
}
?>