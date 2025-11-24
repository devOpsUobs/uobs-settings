<?php
include "newfiles/conn.php";

$doc->addScript(JURI::root(true) . "/dropdown2/jquery.js");
$doc->addScript(JURI::root(true) . "/dropdown2/jquery-ui.min.js");

// Initialize filter variables
$userType = isset($_REQUEST['userType']) ? $_REQUEST['userType'] : -1;
$employment_scale = isset($_REQUEST['employment_scale']) ? $_REQUEST['employment_scale'] : array();
$designation = isset($_REQUEST['designation']) ? $_REQUEST['designation'] : array();
$emp_scale_1 = isset($_REQUEST['emp_scale_1']) ? $_REQUEST['emp_scale_1'] : -1;
$emp_scale_2 = isset($_REQUEST['emp_scale_2']) ? $_REQUEST['emp_scale_2'] : -1;
$departments = isset($_REQUEST['departments']) ? $_REQUEST['departments'] : array();
?>

<style>
.chzn-drop > ul {
    background-color: white !important;
}
span {
    color: black;
}
.table-report {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}
.table-report th, .table-report td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}
.table-report th {
    background-color: #f2f2f2;
    font-weight: bold;
}
.img-thumbnail {
    max-width: 80px;
    max-height: 80px;
}
</style>

<script>
$(document).ready(function() {
    $('#userType').change(function() {
        var selectedOption = $(this).val();
        $.ajax({
            url: '../../../../uobs-accounts/myfiles/emp_allowances/get_departments.php',
            method: 'GET',
            data: { userType: selectedOption },
            success: function(response) {
                $('#departments').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script>

<!-- Filter Form -->
<form action="" method="POST">
    <table class="table table-striped table-hover">
        <tr>
            <th>Select Category</th>
            <td colspan=3>
                <select id="userType" name="userType" style="width:500px">
                    <option value="-1">Select Department</option>
                    <?php
                    $categories = array("admin" => "Admin", "academic" => "Academic");
                    foreach ($categories as $cat_key => $cat_value) {
                        $sel = ($cat_key == $userType) ? " selected " : "";
                        echo "<option value='$cat_key' $sel>$cat_value</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Select Department</th>
            <td colspan=3>
                <select id="departments" name="departments[]" style="width:500px" multiple>
                    <?php
                    if ($userType != -1) {
                        $query = ($userType === 'admin') ? "SELECT * FROM kiusc_admin_departments" : "SELECT * FROM kiusc_departments";
                        $result = mysqli_query($conn, $query);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $sel = in_array($row['id'], $departments) ? " selected " : "";
                                echo '<option value="' . $row['id'] . '" ' . $sel . '>' . $row['name'] . '</option>';
                            }
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Employee Scale</th>
            <td colspan=3>
                <select name="employment_scale[]" style="width:500px" multiple>
                    <?php
                    $employment_scales = mysqli_query($conn, "SHOW COLUMNS FROM kiusc_employees WHERE Field = 'employment_scale'");
                    $emp_scale = mysqli_fetch_assoc($employment_scales);
                    $emp_scale = explode("','", preg_replace("/(enum|set)\('(.+?)'\)/", "\\2", $emp_scale['Type']));
                    foreach ($emp_scale as $type) {
                        $sel = (isset($employment_scale) && in_array($type, $employment_scale)) ? " selected " : "";
                        echo "<option value='$type' $sel>$type</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Designations</th>
            <td colspan=3>
                <select name="designation[]" style="width:500px" multiple>
                    <?php
                    $designations = mysqli_query($conn, "SELECT * FROM kiusc_designations ORDER BY designation ASC");
                    while ($desg = mysqli_fetch_assoc($designations)) {
                        $sel = (isset($designation) && in_array($desg['id'], $designation)) ? " selected " : "";
                        echo "<option value='" . $desg['id'] . "' " . $sel . ">" . $desg['designation'] . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Scale From</th>
            <td>
                <select name="emp_scale_1">
                    <option value='-1'>Select Scale</option>
                    <?php
                    $empl_types = getMultipleRows("SELECT DISTINCT(pay_scale) FROM `kiusc_employees` ORDER BY pay_scale ASC");
                    foreach ($empl_types as $et) {
                        $sel = ($et['pay_scale'] == $emp_scale_1) ? " selected " : "";
                        echo "<option value='" . $et['pay_scale'] . "' $sel>" . $et['pay_scale'] . "</option>";
                    }
                    ?>
                </select>
            </td>
            <th>Scale To</th>
            <td>
                <select name="emp_scale_2">
                    <option value='-1'>Select Scale</option>
                    <?php
                    $empl_types = getMultipleRows("SELECT DISTINCT(pay_scale) FROM `kiusc_employees` ORDER BY pay_scale ASC");
                    foreach ($empl_types as $et) {
                        $sel = ($et['pay_scale'] == $emp_scale_2) ? " selected " : "";
                        echo "<option value='" . $et['pay_scale'] . "' $sel>" . $et['pay_scale'] . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="align-center">
                <input type="submit" name="check" value="Check" class="btn success">
            </td>
        </tr>
    </table>
</form>

<br><br>

<?php
// Function to get employee education details
function getEmployeeEducation($emp_id, $conn) {
    $education = array();
    $query = "SELECT * FROM kiusc_emp_educations WHERE emp_id = '$emp_id' ORDER BY is_highest DESC, year_of_passing DESC";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $education[] = $row;
        }
    }
    return $education;
}

// Function to get promotion history
function getPromotionHistory($emp_id, $conn) {
    $promotions = array();
    $query = "SELECT ed.*, d.designation, ad.name as admin_dept, acd.name as academic_dept 
              FROM kiusc_emp_designations ed 
              LEFT JOIN kiusc_designations d ON ed.designation_id = d.id 
              LEFT JOIN kiusc_admin_departments ad ON ed.adm_department_id = ad.id 
              LEFT JOIN kiusc_departments acd ON ed.acc_department_id = acd.id 
              WHERE ed.emp_id = '$emp_id' 
              ORDER BY ed.date_of_joining DESC";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $promotions[] = $row;
        }
    }
    return $promotions;
}

// Function to format education details
function formatEducationDetails($education) {
    if (empty($education)) return '';
    
    $formatted = '';
    foreach ($education as $edu) {
        $degree = $edu['degree_name'];
        if (!empty($edu['degree_title'])) {
            $degree .= " in " . $edu['degree_title'];
        }
        if (!empty($edu['specialized_area'])) {
            $degree .= " (" . $edu['specialized_area'] . ")";
        }
        if (!empty($edu['year_of_passing'])) {
            $degree .= " - " . $edu['year_of_passing'];
        }
        $formatted .= $degree . "<br>";
    }
    return $formatted;
}

// Main report generation
if (isset($_REQUEST['check'])) {
    $sno = 0;
    
    // Build WHERE clause
    $where = "e.is_active = '1' AND e.is_payroll = 1 AND ed.is_current = 1";
    
    // Department filter
    if (!empty($departments)) {
        $dep_ids = implode(",", $departments);
        if ($userType == 'admin') {
            $where .= " AND ed.adm_department_id IN ($dep_ids)";
        } elseif ($userType == 'academic') {
            $where .= " AND ed.acc_department_id IN ($dep_ids)";
        }
    }
    
    // Employment scale filter
    if (!empty($employment_scale)) {
        $employment_scale_ids = "'" . implode("','", $employment_scale) . "'";
        $where .= " AND ed.employment_scale IN ($employment_scale_ids)";
    }
    
    // Designation filter
    if (!empty($designation)) {
        $designation_ids = "'" . implode("','", $designation) . "'";
        $where .= " AND ed.designation_id IN ($designation_ids)";
    }
    
    // Pay scale range filter
    if ($emp_scale_1 != -1 && $emp_scale_2 != -1) {
        $where .= " AND ed.pay_scale BETWEEN '$emp_scale_1' AND '$emp_scale_2'";
    }
    
    // Main query to get employees
    $query = "SELECT e.id, e.emp_no, e.first_name, e.last_name, e.fname, e.cnic, e.picture,
                     ed.designation_id, ed.pay_scale,ed.employment_nature, ed.employment_scale, ed.date_of_joining,
                     ed.acc_department_id, ed.adm_department_id,
                     d.designation,
                     ad.name as admin_department,
                     acd.name as academic_department
              FROM kiusc_employees e
              JOIN kiusc_emp_designations ed ON e.id = ed.emp_id
              JOIN kiusc_designations d ON d.id = ed.designation_id
              LEFT JOIN kiusc_admin_departments ad ON ed.adm_department_id = ad.id
              LEFT JOIN kiusc_departments acd ON ed.acc_department_id = acd.id
              WHERE $where
              ORDER BY e.first_name, e.last_name";
    
    $employees = getMultipleRows($query);
    
    // PDF download form
    ?>
    <form action="" method="post" target="_blank">
        <input type="hidden" name="userType" value="<?php echo $userType ?>">
        <input type="hidden" name="emp_scale_1" value="<?php echo $emp_scale_1 ?>">
        <input type="hidden" name="emp_scale_2" value="<?php echo $emp_scale_2 ?>">
        <?php
        foreach ($employment_scale as $scale) {
            echo '<input type="hidden" name="employment_scale[]" value="' . $scale . '">';
        }
        foreach ($departments as $dept) {
            echo '<input type="hidden" name="departments[]" value="' . $dept . '">';
        }
        foreach ($designation as $desg) {
            echo '<input type="hidden" name="designation[]" value="' . $desg . '">';
        }
        ?>
        <input type="submit" name="download_pdf" value="Download PDF" class="btn btn-default button_season"/>
                            <input type="submit" name="download_csv" value="Download CSV" class="btn btn-info">

    </form>
    
    <!-- Comprehensive Employee Report Table -->
    <table class="table-report">
        <thead>
            <tr>
                <th>S. No</th>
                <th>Employ Name</th>
                <th>Position (BPS/TTS/Contract etc.)</th>
                <th>Employee Nature</th>
                <th>Department</th>
                <th>Degrees/Specialization</th>
                <th>Date of Joining UoBS</th>
                <th>Job Responsibilities</th>
                <th>Promotion (if any)</th>
                <th>Date of Promotion</th>
                <th>Additional Assignments (if any)</th>
                <th>Picture</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($employees as $emp) {
                $sno++;
                
                // Get additional data
                $education = getEmployeeEducation($emp['id'], $conn);
                $promotions = getPromotionHistory($emp['id'], $conn);
                
                // Determine department
                $department = '';
                if ($userType == 'admin' && !empty($emp['admin_department'])) {
                    $department = $emp['admin_department'];
                } elseif ($userType == 'academic' && !empty($emp['academic_department'])) {
                    $department = $emp['academic_department'];
                }
                
                // Position information
                $position = $emp['designation'];
                if (!empty($emp['employment_scale'])) {
                    $position .= " (" . $emp['employment_scale'] . ")";
                }
                if (!empty($emp['pay_scale'])) {
                    $position .= " - " . $emp['pay_scale'];
                }
				$nature='';
                if (!empty($emp['employment_nature'])) {
                    $nature .= $emp['employment_nature'];
                }
                
                // Format education
                $education_details = formatEducationDetails($education);
                
                // Promotion information
                $promotion_info = '';
                $promotion_date = '';
                if (count($promotions) > 1) {
                    // Get the most recent promotion (excluding current position)
                    $latest_promotion = $promotions[1] ?? $promotions[0];
                    $promotion_info = $latest_promotion['designation'] ?? '';
                    $promotion_date = $latest_promotion['date_of_joining'] ?? '';
                }
                
                // Job responsibilities (placeholder - you might have this data in another table)
                $job_responsibilities = "As per " . $emp['designation'] . " role requirements";
                
                // Additional assignments (placeholder)
                $additional_assignments = "To be assigned as needed";
                
                ?>
                <tr>
                    <td><?php echo $sno; ?></td>
                    <td><?php echo $emp['first_name'] . ' ' . $emp['last_name']; ?></td>
                    <td><?php echo $position; ?></td>
                    <td><?php echo $nature; ?></td>
                    <td><?php echo $department; ?></td>
                    <td><?php echo $education_details ?: 'Not specified'; ?></td>
                    <td><?php echo $emp['date_of_joining'] ? date('d-m-Y', strtotime($emp['date_of_joining'])) : 'Not specified'; ?></td>
                    <td><?php echo $job_responsibilities; ?></td>
                    <td><?php echo $promotion_info; ?></td>
                    <td><?php echo $promotion_date ? date('d-m-Y', strtotime($promotion_date)) : ''; ?></td>
                    <td><?php echo $additional_assignments; ?></td>
                    <td>
                        <img src="<?php echo (file_exists('newfiles/hr/pictures/' . $emp['picture'])) ? 'newfiles/hr/pictures/' . $emp['picture'] : 'newfiles/jobs/pictures/pic.jpg'; ?>" 
                             alt="" class="img-thumbnail">
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}

// PDF Download Handler
if (isset($_POST['download_pdf'])) {
    $file_name = 'comprehensive_employee_report';
    ob_clean();
    
    $folder_path = "newfiles/hr/employee_list/pdf";
    if (!file_exists($folder_path)) {
        mkdir($folder_path, 0777, true);
    }
    
    // Include your PDF generation library
    require('newfiles/hr/pdf/makepdf/makepdf.php');
    $file_path = $folder_path . '/' . $file_name . '.pdf';

    // Open the PDF file in the browser
    if (file_exists($file_path)) {
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . basename($file_path) . '"');
        @readfile($file_path);
        unlink($file_path);
        exit;
    }
}
?>