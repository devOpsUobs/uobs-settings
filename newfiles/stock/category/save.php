<?php

$category = $_REQUEST['category'];
$description = $_REQUEST['description'];
$active = 0;
if(isset($_REQUEST['active']))
	$active = $_REQUEST['active'];

include '../../conn.php';



$ex=no_of_rows("SELECT * FROM `uobs_stck_category` WHERE `category` = '$category'");
if($ex>0)
{
?>
	<script type="text/javascript">
		alert("Sory Allowance Already Exists");
	</script>
<?php	
}
else
{
$sql = "INSERT INTO `uobs_stck_category`(`category`, `description`, `active`) VALUES ('$category', '$description', '$active')";
ins_upd_del($sql);
echo json_encode(array(
	'id' => mysqli_insert_id($conn),
	'category' => $category,
	'description' => $description,
	'active' => $active
));
}

?>