<?php

include "../../conn.php";

$type_id = $_REQUEST['type_id'];

$designation = mysqli_query($conn, "SELECT * FROM `kiusc_designations` where type = '$type_id'");
// $designation = mysqli_fetch_assoc($designation);

echo "<option value=''>Select Product</option>";
  if($designation->num_rows>0){
    while($row=$designation->fetch_assoc()){
      echo "<option value='{$row["id"]}'>{$row["designation"]}</option>";
    }
  }
?>
