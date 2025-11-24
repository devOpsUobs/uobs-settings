<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;

$doc = JFactory::getDocument();

// CSS
$doc->addStyleSheet(JURI::root(true) . "/jquery-easyui/themes/default/easyui.css");
$doc->addStyleSheet(JURI::root(true) . "/jquery-easyui/themes/icon.css");
$doc->addStyleSheet(JURI::root(true) . "/jquery-easyui/demo/demo.css");
$doc->addStyleSheet(JURI::root(true) . "/jquery-easyui/demo/color.css");
$doc->addStyleSheet(JURI::root(true) . "/myfiles/mycss.css");

// JS
$doc->addScript(JURI::root(true) . "/jquery-easyui/jquery.min.js");
$doc->addScript(JURI::root(true) . "/jquery-easyui/jquery.easyui.min.js");
$doc->addScript(JURI::root(true) . "/jquery-easyui/datagrid-filter.js");
$doc->addScript(JURI::root(true) . "/myfiles/students/myScripts.js");

include 'newfiles/common.php';
include 'newfiles/conn.php';

// Permission check
if (checkPermission(JFactory::getUser(), "faculty_evaluation") == 0) {
    echo "You don't have rights to access this page!";
    return;
}

$evl_ids = $_POST['evl_id'] ?? [];
$department = $_POST['sel_dep_id'] ?? -1;
?>

<body>
<form method="post" id="main_form">
    <table class="table table-bordered table-striped">
        <tr>
            <th>Select Evaluation Type(s):</th>
            <td><?php echo evalMultiSelect($conn, $evl_ids); ?></td>
        </tr>
        <tr>
            <th>Select Department:</th>
            <td><?php echo showEvalDepartmentSel($conn, $evl_ids, $department); ?></td>
        </tr>
    </table>
    <hr />
</form>

<?php if (!empty($evl_ids)): ?>
    <form id="export_form" method="post"
          action="<?php echo JURI::root(true); ?>/newfiles/evaluation/eva_summary_multiple_semester/teacher_eva_summary/msExcelExport.php"
          target="_blank">
        <?php foreach ($evl_ids as $id): ?>
            <input type="hidden" name="evl_id[]" value="<?php echo htmlspecialchars($id); ?>" />
        <?php endforeach; ?>
        <input type="hidden" name="sel_dep_id" value="<?php echo htmlspecialchars($department); ?>" />
    </form>

    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true"
       onclick="exportDetail1()">Download Teacher Evaluation Summary</a>
<?php endif; ?>

<script type="text/javascript">
    function exportDetail1() {
        $("#export_form").submit();
    }

    $(document).ready(function () {
        $("#evl_id, #sel_dep_id").change(function () {
            $("#main_form").submit();
        });
    });
</script>
</body>

<?php
function evalMultiSelect($conn, $selected_ids)
{
    $evaluations = mysqli_query($conn, "SELECT * FROM kiusc_evaluation WHERE active = 1");

    echo '<select name="evl_id[]" id="evl_id" multiple style="width: 300px; height: 150px;">';

    while ($eval = mysqli_fetch_assoc($evaluations)) {
        $selected = in_array($eval['id'], $selected_ids) ? 'selected' : '';
        echo "<option value='{$eval['id']}' $selected>{$eval['description']}</option>";
    }

    echo '</select>';
}

function showEvalDepartmentSel($conn, $evl_ids, $dep)
{
    $db = JFactory::getDBO();
    $db->setQuery("SELECT * FROM kiusc_departments");
    $db->execute();
    $departments = $db->loadAssocList();

    echo '<select name="sel_dep_id" id="sel_dep_id" style="width: 250px;">';

    foreach ($departments as $dept) {
        if (checkPermission(JFactory::getUser(), $dept['group']) == 1) {
            $selected = ($dep == $dept['id']) ? 'selected' : '';
            echo "<option value='{$dept['id']}' $selected>{$dept['name']}</option>";
        }
    }

    echo '</select>';
}
?>
