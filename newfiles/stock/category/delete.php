<?php

$id = intval($_REQUEST['id']);

include '../../conn.php';

$ex = no_of_rows("SELECT * FROM `uobs_stck_items` WHERE `category_id` = '$id'");
if($ex>0)
{
?>
	<script>  
		alert('Cannot delete entry having child value');
	</script>
<?php
	echo json_encode(array('success'=>false));
}
else
{
	ins_upd_del("DELETE FROM `uobs_stck_category` WHERE id = '$id'");
	echo json_encode(array('success'=>true));
}
