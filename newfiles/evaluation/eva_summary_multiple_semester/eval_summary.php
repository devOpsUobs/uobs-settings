<?php
defined('_JEXEC') or die;
include 'newfiles/common.php';
include 'newfiles/conn.php';

// Fetch Evaluation Types
function getEvaluationOptions($conn) {
    $options = '';
    $result = mysqli_query($conn, "SELECT id, description FROM kiusc_evaluation WHERE active = 1");
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= "<option value='{$row['id']}'>{$row['description']}</option>";
    }
    return $options;
}

// Fetch Departments
function getDepartmentOptions($conn) {
    $options = '';
    $result = mysqli_query($conn, "SELECT id, name FROM kiusc_departments");
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= "<option value='{$row['id']}'>{$row['name']}</option>";
    }
    return $options;
}
?>

<form method="post" action="<?php echo JURI::root(true); ?>/newfiles/evaluation/eva_summary_multiple_semester/teacher_eva_summary/msExcelExport.php" target="_blank">
    <table class="table table-bordered">
        <tr>
            <th>Select Evaluation Type(s):</th>
            <td>
                <select name="evl_id[]" multiple size="5" style="width: 300px;">
                    <?php echo getEvaluationOptions($conn); ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Select Department:</th>
            <td>
                <select name="sel_dep_id" style="width: 300px;">
                    <option value="">-- Select Department --</option>
                    <?php echo getDepartmentOptions($conn); ?>
                </select>
            </td>
        </tr>
         <tr>
            <td colspan="2" style="text-align: center;">
                <button type="submit" class="btn btn-primary" style="border-radius: 25px; padding: 10px 30px; font-size: 16px;">
                    <i class="fa fa-download" style="margin-right: 8px;"></i> Download Teacher Evaluation Summary
                </button>
            </td>

        </tr>
    </table>
   
</form>
