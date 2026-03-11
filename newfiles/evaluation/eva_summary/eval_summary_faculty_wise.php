<?php
$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/themes/icon.css");
$doc->addStyleSheet(JURI::root( true )."/jquery-easyui/demo/demo.css");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.min.js");
$doc->addScript(JURI::root( true )."/jquery-easyui/jquery.easyui1.min.js");

$doc->addStyleSheet(JURI::root( true )."/dropdown2/plugins.css");
$doc->addScript(JURI::root( true )."/dropdown2/jquery.js");
$doc->addScript(JURI::root( true )."/dropdown2/jquery-ui.min.js");
$doc->addScript(JURI::root( true )."/dropdown2/jquery.cooki.js");
$doc->addScript(JURI::root( true )."/dropdown2/plugins.js");
$doc->addScript(JURI::root( true )."/dropdown2/scripts.js");

include 'newfiles/common.php';
include 'newfiles/conn.php';

if (checkPermission(JFactory::getUser(), "faculty_evaluation") == 0) {
    echo "You dont have right to access this page!";
    return;
}

$evl_id = isset($_REQUEST['evl_id']) ? $_REQUEST['evl_id'] : -1;
$faculty = isset($_REQUEST['sel_faculty_id']) ? $_REQUEST['sel_faculty_id'] : -1;

echo '<body>';
?>

<table class="table table-bordered table-striped">
    <tr>
        <th>Select Evaluation Type:</th>
        <td><?php $evl_id = evalDropDown($conn, $evl_id); ?></td>
    </tr>
    <tr>
        <th>Select Faculty :</th>
        <td><?php $faculty = showEvalFacultySel($conn, $evl_id, $faculty); ?></td>
    </tr>
</table>

<hr />

<?php
if ($evl_id > 0) {

    /*** TEACHER EVALUATION REPORT ***/
    if ($evl_id > 14) { 
?>
        <form id="fm1" method="post"
            action="<?php echo JURI::root(true) ?>/newfiles/evaluation/eva_summary/faculty_wise_sumaary/msExcelExport.php"
            target="_blank">
            <input type="hidden" name="evl_id" value="<?php echo $evl_id ?>">
            <input type="hidden" name="sel_faculty_id" value="<?php echo $faculty ?>">

        </form>
        <a href="javascript:void(0)" class="easyui-linkbutton"
            onclick="exportDetail1()">Download Teacher Evaluation Summary</a>
			
    

<?php
    } else { 
	      echo "not record found";

       ?>
	    <!-- <form id="fm1" method="post"
            action="<?php echo JURI::root(true) ?>/newfiles/evaluation/eva_summary/faculty_wise_sumaary/teacher_eva_summary/msExcelExport.php"
            target="_blank">
            <input type="text" name="evl_id" value="<?php echo $evl_id ?>">
            <input type="text" name="sel_faculty_id" value="<?php echo $faculty ?>">

        </form>
        <a href="javascript:void(0)" class="easyui-linkbutton"
            onclick="exportDetail1()">Download Teacher Evaluation Summary</a> -->
	   <?php
    }
?>

   

   

<?php } ?>

<script type="text/javascript">
function exportDetail1() { $("#fm1").submit(); }
function exportDetail2() { $("#fm2").submit(); }
function exportDetail3() { $("#fm3").submit(); }
</script>

<?php

/*******************************************
 * EVALUATION DROPDOWN
 *******************************************/
function evalDropDown($conn, $evl_id)
{
    echo '<form id="evl_select" method="post">
            <select name="evl_id" id="evl_id">';

    $evaluations = mysqli_query($conn, "SELECT * FROM kiusc_evaluation WHERE active = 1");
    $sel_evl_id = -1;

    while ($eval = mysqli_fetch_assoc($evaluations)) {
        $sel = ($evl_id == $eval['id']) ? "selected" : "";
        if ($sel_evl_id == -1) $sel_evl_id = $eval['id'];

        echo "<option value='{$eval['id']}' $sel>{$eval['description']}</option>";
    }

    echo '</select>
        </form>

        <script>
            $("#evl_id").change(function(){ $("#evl_select").submit(); });
        </script>';

    return $evl_id;
}


/*******************************************
 * FACULTY DROPDOWN (NEW)
 *******************************************/
function showEvalFacultySel($conn, $evl_id, $faculty)
{
    $sql = "SELECT u.* 
            FROM s04cf_users u
            JOIN s04cf_user_usergroup_map g ON u.id = g.user_id
            WHERE u.block = 0 AND g.group_id = 11
            ORDER BY u.name ASC";

    $result = mysqli_query($conn, $sql);

    echo '<form id="fac_select" method="post">
            <input type="hidden" name="evl_id" value="' . $evl_id . '">
            <select name="sel_faculty_id" id="sel_faculty_id" style="width:250px;">';

    // ---------- ADD DEFAULT OPTION ----------
    echo '<option value="-1" disabled selected>Select Faculty</option>';

    // ---------- LIST FACULTIES ----------
    while ($row = mysqli_fetch_assoc($result)) {

        $s = ($faculty == $row['id']) ? "selected" : "";

        echo "<option value='{$row['id']}' $s>{$row['name']}</option>";
    }

    echo '</select>
        </form>

        <script>
            $("#sel_faculty_id").change(function(){ 
                $("#fac_select").submit(); 
            });
        </script>';

    return $faculty;
}


?>
