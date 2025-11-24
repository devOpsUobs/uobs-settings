<?php
include "newfiles/conn.php";
include "newfiles/common.php";

$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root(true) . "/jquery-easyui-new/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root(true) . "/jquery-easyui-new/themes/icon.css");
$doc->addStyleSheet(JURI::root(true) . "/jquery-easyui-new/demo/demo.css");

$doc->addScript(JURI::root(true) . "/jquery-easyui-new/jquery-1.6.min.js");
$doc->addScript(JURI::root(true) . "/jquery-easyui-new/jquery.easyui.min.js");
$doc->addScript(JURI::root(true) . "/jquery-easyui-new/datagrid-detailview.js");


echo "<h3> Evaluation Questions </h3>  
<hr>";

$evl_id = -1;
if (isset($_REQUEST['evl_id']))
	$evl_id = $_REQUEST['evl_id'];

if (isset($_REQUEST['question'])) {
	$question = $_REQUEST['question'];
	$eval_type_id = $_REQUEST['eval_type_id'];
	$cat_id = $_REQUEST['cat_id'];
	$positive = 0;
	if (isset($_REQUEST['positive']))
		$positive = $_REQUEST['positive'];

	mysqli_query($conn, "INSERT INTO `kiusc_eval_questions`(`eval_id`, `eval_type_id`, `question`, `positive`, `cat_id`) 
	VALUES ('$evl_id', '$eval_type_id', '$question', '$positive', '$cat_id')");
}

if (isset($_REQUEST['did'])) {
	$did = $_REQUEST['did'];
	$ex = mysqli_query($conn, "SELECT * FROM `kiusc_eval_std` WHERE `question_id` = '$did'");
	$num = mysqli_num_rows($ex);
	if ($num > 0)
		echo "Student attempt the evaluation";
	else
		mysqli_query($conn, "DELETE FROM `kiusc_eval_questions` WHERE id = '$did'");
}

?>
<table class="table table-striped table-hover table_fee">
	<tr>
		<th>Select Evaluation:</th>
		<td><?php $evl_id = evalDropDown($conn, $evl_id); ?></td>
	</tr>
	<form action="" method="post">
		<tr>
			<th>Evaluation Type: </th>
			<td>
				<select name="eval_type_id" id="eval_type_id">
					<option value=""> Select Evaluation Type</option>
					<?php
					$eval_types = mysqli_query($conn, "SELECT * FROM `kiusc_evaluation_type`");
					while ($eval_type = mysqli_fetch_assoc($eval_types)) {
						echo "<option value='" . $eval_type['id'] . "'>" . $eval_type['eval_type'] . "</option>";
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<th>Question:</th>
			<td><textarea name="question" style="width:450px; height:80px"> </textarea></td>
		</tr>
		<tr>
			<th>Category: </th>
			<td>
				<select name="cat_id" id="cat_id">
					<option value=""> Select Category</option>
				</select>
			</td>
		</tr>
		<tr>
			<th>Positive: </th>
			<td><input type="checkbox" value="1" name="positive" checked="checked" /></td>
		</tr>
		<tr>
			<td colspan=2 style="text-align:center"><input type="submit" value="Save" /></td>
		</tr>
		<input type="hidden" name="evl_id" value="<?php echo $evl_id ?>" />
	</form>

</table>



<h4> List of questions saved in selected evaluation </h4>
<hr />

<table class="table table-striped table-hover table_fee">
	<tr>
		<th> SNo. </th>
		<th> Evaluation Type </th>
		<th> Questions </th>
		<th> Category </th>
		<th> Positive </th>
		<td> </td>
	</tr>

	<?php
	$sno = 0;


	$questions = mysqli_query($conn, "SELECT q.*,qc.name as cat_name, et.eval_type  FROM `kiusc_eval_questions` q 
								join kiusc_eval_ques_category qc on q.cat_id = qc.id 
								JOIN kiusc_evaluation_type et ON et.id= q.eval_type_id
								WHERE `eval_id` = '$evl_id' and qc.active=1  order by et.id asc");
	while ($ques = mysqli_fetch_assoc($questions)) {
		$sno++;
		?>
		<tr>
			<td> <?php echo $sno; ?> </td>
			<td> <?php echo $ques['eval_type']; ?> </td>
			<td> <?php echo $ques['question']; ?> </td>
			<td> <?php echo $ques['cat_name']; ?> </td>
			<td> <?php
			if ($ques['positive'] == 1)
				echo "Yes";
			else
				echo "No"; ?> </td>
			<td> <a iconCls="icon-no"
					href="<?php echo JURI::root(true) ?>/index.php/cms-admin/teacher-evaluation/evaluation-questions?did=<?php echo $ques['id'] ?>"
					class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this question?');">
					Delete </a> </td>
		</tr>
	<?php } ?>

</table>

<script type="text/javascript">
	// Attach an event listener to the evaluation type dropdown
	$('#eval_type_id').change(function () {
		var eval_type_id = $(this).val();
		$.ajax({
			type: 'POST',
			url: '../../newfiles/evaluation/get_categories.php', // The file that fetches the categories
			data: { eval_type_id: eval_type_id },
			success: function (response) {
				$('#cat_id').html(response); // Update the category dropdown with the new options
			}
		});
	});
</script>








<?php
function evalDropDown($conn, $evl_id)
{
	echo '	
<form id="evl_select" action="" method="post">
<select name="evl_id" id="evl_id">';

	$evaluations = mysqli_query($conn, "select * from kiusc_evaluation where active = 1");
	$i = 0;
	$sel_evl_id = -1;
	while ($eval = mysqli_fetch_assoc($evaluations)) {
		if ($i == 0) {
			$sel_evl_id = $eval['id'];
		}
		$i++;
		$sel = "";
		if ($evl_id == $eval['id']) {
			$sel = "selected";
			$sel_evl_id = $eval['id'];
		}
		echo " <option value='" . $eval['id'] . "' " . $sel . "> " . $eval['description'] . "</option>";
	}

	echo ' 
</select>
</form>

	<script type="text/javascript">
	$("#evl_id").change(function(){
    $("#evl_select").trigger("submit");
	});

	</script>';

	return $sel_evl_id;
}
?>