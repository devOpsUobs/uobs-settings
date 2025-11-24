<?php
include "newfiles/conn.php";

$doc->addScript(JURI::root(true) . "/dropdown2/jquery.js");
$doc->addScript(JURI::root(true) . "/dropdown2/jquery-ui.min.js");

// Initialize filter variables
$userType = isset($_REQUEST['userType']) ? $_REQUEST['userType'] : -1;
$departments = isset($_REQUEST['departments']) ? $_REQUEST['departments'] : array();
$employment_mode = isset($_REQUEST['employment_mode']) ? $_REQUEST['employment_mode'] : 'all';
$employment_scale = isset($_REQUEST['employment_scale']) ? $_REQUEST['employment_scale'] : 'all';
$status_filter = isset($_REQUEST['status_filter']) ? $_REQUEST['status_filter'] : 'active';



// CSV Export Functionality
if (isset($_POST['download_csv'])) {
    $filename = 'employment_mode_report_' . date('Y_m_d_H_i_s') . '.csv';
    
    // Set headers for CSV download
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    
    // Create output stream
    $output = fopen('php://output', 'w');
    
    // Add BOM for UTF-8 to support special characters in Excel
    fputs($output, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
    
    // CSV headers
    $headers = array(
        'S.No',
        'Employee No',
        'Full Name',
        'Father Name',
        'CNIC',
        'Designation',
        'Department',
        'Employment Nature',
        'Mode of Employment',
        'Employment Scale',
        'Pay Scale',
        'Joining Date',
        'Service End Date',
        'Contract Period (Months)',
        'Contract Status',
        'Days Remaining',
        'Current Status',
        'Contact Number',
        'Email'
    );
    
    fputcsv($output, $headers);
    
    // Get data with same filters
    $filters = array(
        'userType' => $userType,
        'departments' => $departments,
        'employment_mode' => $employment_mode,
        'employment_scale' => $employment_scale,
        'employment_nature' => $employment_nature,
        'status_filter' => $status_filter
    );
    
    $employees = getEmploymentModeReport($conn, $filters, $sort_by, $sort_order);
    
    if (!empty($employees)) {
        $sno_csv = 0;
        foreach ($employees as $emp) {
            $sno_csv++;
            
            // Department
            $department = '';
            if ($userType == 'admin' && !empty($emp['admin_department'])) {
                $department = $emp['admin_department'];
            } elseif ($userType == 'academic' && !empty($emp['academic_department'])) {
                $department = $emp['academic_department'];
            }
            
            // Contract status calculation
            $contract_status = 'N/A';
            $days_remaining = '';
            if ($emp['service_end_date']) {
                $current_date = date('Y-m-d');
                $end_date = date('Y-m-d', strtotime($emp['service_end_date']));
                if ($current_date > $end_date) {
                    $contract_status = 'Expired';
                } else {
                    $days_remaining = floor((strtotime($end_date) - strtotime($current_date)) / (60 * 60 * 24));
                    if ($days_remaining <= 30) {
                        $contract_status = 'Expiring Soon';
                    } else {
                        $contract_status = 'Active';
                    }
                }
            }
            
            // Current status
            $current_status = $emp['is_current'] == 1 ? 'Active' : 'Inactive';
            
            // Dates formatting for CSV
            $joining_date = $emp['date_of_joining'] ? date('d-m-Y', strtotime($emp['date_of_joining'])) : '';
            $service_end_date = $emp['service_end_date'] ? date('d-m-Y', strtotime($emp['service_end_date'])) : '';
            
            $row_data = array(
                $sno_csv,
                $emp['emp_no'],
                $emp['first_name'] . ' ' . $emp['last_name'],
                $emp['fname'],
                $emp['cnic'],
                $emp['designation'],
                $department,
                $emp['employment_nature'],
                $emp['mode_of_employment'],
                $emp['employment_scale'],
                $emp['pay_scale'],
                $joining_date,
                $service_end_date,
                $emp['contract_period_months'] ? $emp['contract_period_months'] : '',
                $contract_status,
                $days_remaining ? $days_remaining : '',
                $current_status,
                $emp['cell_no1'] ? $emp['cell_no1'] : '',
                $emp['email'] ? $emp['email'] : ''
            );
            
            fputcsv($output, $row_data);
        }
        
        // Add summary row
        fputcsv($output, array('')); // Empty row
        fputcsv($output, array('SUMMARY STATISTICS'));
        fputcsv($output, array('Total Employees', count($employees)));
        
        // Count by employment mode
        $mode_counts = array('Additional' => 0, 'Full Time' => 0, 'Part Time' => 0);
        foreach ($employees as $emp) {
            if (isset($mode_counts[$emp['mode_of_employment']])) {
                $mode_counts[$emp['mode_of_employment']]++;
            }
        }
        
        fputcsv($output, array('Employment Mode Breakdown'));
        foreach ($mode_counts as $mode => $count) {
            fputcsv($output, array($mode, $count));
        }
        
        // Count by status
        $active_count = 0;
        $inactive_count = 0;
        foreach ($employees as $emp) {
            if ($emp['is_current'] == 1) $active_count++;
            if ($emp['is_current'] == 0) $inactive_count++;
        }
        
        fputcsv($output, array('Status Breakdown'));
        fputcsv($output, array('Active', $active_count));
        fputcsv($output, array('Inactive', $inactive_count));
        
        // Report info
        fputcsv($output, array(''));
        fputcsv($output, array('Report Information'));
        fputcsv($output, array('Generated on', date('F j, Y, g:i a')));
        fputcsv($output, array('Filters', 
            'Category: ' . ($userType != -1 ? ucfirst($userType) : 'All') . 
            ' | Mode: ' . ($employment_mode != 'all' ? $employment_mode : 'All Modes') . 
            ' | Scale: ' . ($employment_scale != 'all' ? $employment_scale : 'All Scales') .
            ' | Nature: ' . ($employment_nature != 'all' ? $employment_nature : 'All Natures') .
            ' | Status: ' . ucfirst($status_filter)
        ));
        fputcsv($output, array('Sorted by', ucfirst(str_replace('_', ' ', $sort_by)) . ' (' . ($sort_order == 'asc' ? 'Ascending' : 'Descending') . ')'));
        
    } else {
        fputcsv($output, array('No employees found matching the selected criteria.'));
    }
    
    fclose($output);
    exit;
}
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
    font-size: 12px;
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
.status-active {
    color: green;
    font-weight: bold;
}
.status-inactive {
    color: red;
    font-weight: bold;
}
.mode-additional {
    background-color: #fff3cd;
    font-weight: bold;
}
.mode-fulltime {
    background-color: #d1ecf1;
}
.mode-parttime {
    background-color: #f8d7da;
}
.filter-form {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 5px;
    margin-bottom: 20px;
}
.report-header {
    background-color: #e9ecef;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
}
.summary-stats {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 5px;
    margin-top: 20px;
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
<div class="filter-form">
    <form action="" method="POST">
        <table class="table table-striped table-hover">
            <tr>
                <th>Select Category</th>
                <td>
                    <select id="userType" name="userType" style="width:250px">
                        <option value="-1">Select Category</option>
                        <?php
                        $categories = array("admin" => "Admin", "academic" => "Academic");
                        foreach ($categories as $cat_key => $cat_value) {
                            $sel = ($cat_key == $userType) ? " selected " : "";
                            echo "<option value='$cat_key' $sel>$cat_value</option>";
                        }
                        ?>
                    </select>
                </td>
                
                <th>Select Department</th>
                <td>
                    <select id="departments" name="departments[]" style="width:250px" multiple>
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
                <th>Mode of Employment</th>
                <td>
                    <select name="employment_mode" style="width:250px">
                        <option value="all" <?php echo ($employment_mode == 'all') ? 'selected' : ''; ?>>All Modes</option>
                        <option value="Additional" <?php echo ($employment_mode == 'Additional') ? 'selected' : ''; ?>>Additional Only</option>
                        <option value="Full Time" <?php echo ($employment_mode == 'Full Time') ? 'selected' : ''; ?>>Full Time Only</option>
                        <option value="Part Time" <?php echo ($employment_mode == 'Part Time') ? 'selected' : ''; ?>>Part Time Only</option>
                    </select>
                </td>
                
                <th>Employment Scale</th>
                <td>
                    <select name="employment_scale" style="width:250px">
                        <option value="all" <?php echo ($employment_scale == 'all') ? 'selected' : ''; ?>>All Scales</option>
                        <?php
                        $scale_options = array('BPS', 'IPFP', 'TTS', 'SPS', 'PPS', 'Others');
                        foreach ($scale_options as $scale) {
                            $sel = ($employment_scale == $scale) ? 'selected' : '';
                            echo "<option value='$scale' $sel>$scale</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Employment Status</th>
                <td>
                    <select name="status_filter" style="width:250px">
                        <option value="active" <?php echo ($status_filter == 'active') ? 'selected' : ''; ?>>Active Only</option>
                        <option value="all" <?php echo ($status_filter == 'all') ? 'selected' : ''; ?>>All Status</option>
                        <option value="inactive" <?php echo ($status_filter == 'inactive') ? 'selected' : ''; ?>>Inactive Only</option>
                    </select>
                </td>
                
                <td colspan="2" class="align-center">
                    <input type="submit" name="generate_report" value="Generate Report" class="btn success">
                    <input type="submit" name="download_pdf" value="Download PDF" class="btn btn-default">
                    <input type="submit" name="download_csv" value="Download CSV" class="btn btn-info">

                </td>
            </tr>
        </table>
    </form>
</div>

<?php
// Function to get employment mode report
function getEmploymentModeReport($conn, $filters = array()) {
    $where = "e.is_active = '1'";
    
    // Status filter
    if ($filters['status_filter'] == 'active') {
        $where .= " AND ed.is_current = 1";
    } elseif ($filters['status_filter'] == 'inactive') {
        $where .= " AND ed.is_current = 0";
    }
    
    // Department filter
    if (!empty($filters['departments'])) {
        $dep_ids = implode(",", $filters['departments']);
        if ($filters['userType'] == 'admin') {
            $where .= " AND ed.adm_department_id IN ($dep_ids)";
        } elseif ($filters['userType'] == 'academic') {
            $where .= " AND ed.acc_department_id IN ($dep_ids)";
        }
    }
    
    // Employment mode filter
    if ($filters['employment_mode'] != 'all') {
        $where .= " AND ed.mode_of_employment = '" . $filters['employment_mode'] . "'";
    }
    
    // Employment scale filter
    if ($filters['employment_scale'] != 'all') {
        $where .= " AND ed.employment_scale = '" . $filters['employment_scale'] . "'";
    }
    
    $query = "SELECT 
                e.id as emp_id,
                e.emp_no,
                e.first_name,
                e.last_name,
                e.fname,
                e.cnic,
                e.picture,
                e.cell_no1,
                e.email,
                e.date_of_joining as emp_joining_date,
                ed.designation_id,
                ed.acc_department_id,
                ed.adm_department_id,
                ed.date_of_joining,
                ed.service_end_date,
                ed.employment_nature,
                ed.contract_period_months,
                ed.mode_of_employment,
                ed.employment_scale,
                ed.pay_scale,
                ed.is_current,
                d.designation,
                ad.name as admin_department,
                acd.name as academic_department
              FROM kiusc_employees e
              JOIN kiusc_emp_designations ed ON e.id = ed.emp_id
              JOIN kiusc_designations d ON d.id = ed.designation_id
              LEFT JOIN kiusc_admin_departments ad ON ed.adm_department_id = ad.id
              LEFT JOIN kiusc_departments acd ON ed.acc_department_id = acd.id
              WHERE $where
              ORDER BY ed.mode_of_employment, e.first_name, e.last_name";
    
    return getMultipleRows($query);
}

// Function to get mode of employment badge
function getModeBadge($mode) {
    switch ($mode) {
        case 'Additional':
            return '<span class="mode-additional">📋 Additional</span>';
        case 'Full Time':
            return '<span class="mode-fulltime">💼 Full Time</span>';
        case 'Part Time':
            return '<span class="mode-parttime">⏰ Part Time</span>';
        default:
            return '<span>' . $mode . '</span>';
    }
}

// Function to get status badge
function getStatusBadge($is_current) {
    if ($is_current == 1) {
        return '<span class="status-active">● Active</span>';
    } else {
        return '<span class="status-inactive">● Inactive</span>';
    }
}

// Function to check contract status
function getContractStatus($service_end_date) {
    if (!$service_end_date) return 'N/A';
    
    $current_date = date('Y-m-d');
    $end_date = date('Y-m-d', strtotime($service_end_date));
    
    if ($current_date > $end_date) {
        return '<span style="color: red;">Expired</span>';
    } else {
        $days_remaining = floor((strtotime($end_date) - strtotime($current_date)) / (60 * 60 * 24));
        if ($days_remaining <= 30) {
            return '<span style="color: orange;">Expiring in ' . $days_remaining . ' days</span>';
        } else {
            return '<span style="color: green;">Active (' . $days_remaining . ' days left)</span>';
        }
    }
}

// Main report generation
if (isset($_REQUEST['generate_report']) || isset($_REQUEST['download_pdf'])) {
    $filters = array(
        'userType' => $userType,
        'departments' => $departments,
        'employment_mode' => $employment_mode,
        'employment_scale' => $employment_scale,
        'status_filter' => $status_filter
    );
    
    $employees = getEmploymentModeReport($conn, $filters);
    $sno = 0;
    
    if (isset($_REQUEST['download_pdf'])) {
        // PDF Generation
        $file_name = 'employment_mode_report';
        ob_clean();
        
        $folder_path = "newfiles/hr/additional_charges/pdf";
        if (!file_exists($folder_path)) {
            mkdir($folder_path, 0777, true);
        }
        
        require('newfiles/hr/additional_charges/pdf/makepdf/makepdf.php');
        $file_path = $folder_path . '/' . $file_name . '.pdf';

        if (file_exists($file_path)) {
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . basename($file_path) . '"');
            @readfile($file_path);
            unlink($file_path);
            exit;
        }
    }
    ?>
    
    <!-- Employment Mode Report -->
    <div class="report-header">
        <h3>Employment Mode Report - Additional Charges & Employment Types</h3>
        <p>Generated on: <?php echo date('F j, Y, g:i a'); ?></p>
        <p>Filters: 
            Category: <?php echo ($userType != -1) ? ucfirst($userType) : 'All'; ?> | 
            Mode: <?php echo ($employment_mode != 'all') ? $employment_mode : 'All Modes'; ?> | 
            Scale: <?php echo ($employment_scale != 'all') ? $employment_scale : 'All Scales'; ?> |
            Status: <?php echo ucfirst($status_filter); ?>
        </p>
    </div>
    
    <table class="table-report">
        <thead>
            <tr>
                <th>S. No</th>
                <th>Employee Details</th>
                <th>Designation & Scale</th>
                <th>Department</th>
                <th>Employment Nature</th>
                <th>Mode of Employment</th>
                <th>Pay Scale</th>
                <th>Joining Date</th>
                <th>Service End Date</th>
                <th>Contract Status</th>
                <th>Contract Period</th>
                <th>Current Status</th>
                <th>Contact Info</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($employees)) {
                foreach ($employees as $emp) {
                    $sno++;
                    
                    // Employee details
                    $emp_name = $emp['first_name'] . ' ' . $emp['last_name'];
                    $emp_father = $emp['fname'];
                    
                    // Department
                    $department = '';
                    if ($userType == 'admin' && !empty($emp['admin_department'])) {
                        $department = $emp['admin_department'];
                    } elseif ($userType == 'academic' && !empty($emp['academic_department'])) {
                        $department = $emp['academic_department'];
                    }
                    
                    // Designation with scale
                    $designation_info = $emp['designation'];
                    $scale_info = $emp['employment_scale'];
                    if (!empty($emp['pay_scale'])) {
                        $scale_info .= " - " . $emp['pay_scale'];
                    }
                    
                    // Mode of employment
                    $mode_badge = getModeBadge($emp['mode_of_employment']);
                    
                    // Dates
                    $joining_date = $emp['date_of_joining'] ? date('d-m-Y', strtotime($emp['date_of_joining'])) : 'N/A';
                    $service_end_date = $emp['service_end_date'] ? date('d-m-Y', strtotime($emp['service_end_date'])) : 'N/A';
                    
                    // Contract status
                    $contract_status = getContractStatus($emp['service_end_date']);
                    
                    // Current status
                    $status_badge = getStatusBadge($emp['is_current']);
                    
                    // Contact info
                    $contact_info = '';
                    if (!empty($emp['cell_no1'])) $contact_info .= $emp['cell_no1'] . '<br>';
                    if (!empty($emp['email'])) $contact_info .= $emp['email'];
                    if (empty($contact_info)) $contact_info = 'N/A';
                    
                    ?>
                    <tr>
                        <td><?php echo $sno; ?></td>
                        <td>
                            <strong><?php echo $emp_name; ?></strong><br>
                            Father: <?php echo $emp_father; ?><br>
                            CNIC: <?php echo $emp['cnic']; ?><br>
                            Emp No: <?php echo $emp['emp_no']; ?>
                        </td>
                        <td>
                            <strong><?php echo $designation_info; ?></strong><br>
                            Scale: <?php echo $scale_info; ?>
                        </td>
                        <td><?php echo $department; ?></td>
                        <td><?php echo $emp['employment_nature']; ?></td>
                        <td><?php echo $mode_badge; ?></td>
                        <td><?php echo $emp['pay_scale']; ?></td>
                        <td><?php echo $joining_date; ?></td>
                        <td><?php echo $service_end_date; ?></td>
                        <td><?php echo $contract_status; ?></td>
                        <td><?php echo $emp['contract_period_months'] ? $emp['contract_period_months'] . ' months' : 'N/A'; ?></td>
                        <td><?php echo $status_badge; ?></td>
                        <td><?php echo $contact_info; ?></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="13" style="text-align: center; padding: 20px;">
                        <strong>No employees found matching the selected criteria.</strong>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

    <!-- Summary Statistics -->
    <?php
    if (!empty($employees)) {
        $additional_count = 0;
        $fulltime_count = 0;
        $parttime_count = 0;
        $active_count = 0;
        $inactive_count = 0;
        
        foreach ($employees as $emp) {
            if ($emp['mode_of_employment'] == 'Additional') $additional_count++;
            if ($emp['mode_of_employment'] == 'Full Time') $fulltime_count++;
            if ($emp['mode_of_employment'] == 'Part Time') $parttime_count++;
            if ($emp['is_current'] == 1) $active_count++;
            if ($emp['is_current'] == 0) $inactive_count++;
        }
        ?>
        <div class="summary-stats">
            <h4>Employment Summary</h4>
            <p>Total Employees: <?php echo count($employees); ?> | 
               Additional: <?php echo $additional_count; ?> | 
               Full Time: <?php echo $fulltime_count; ?> | 
               Part Time: <?php echo $parttime_count; ?> | 
               Active: <?php echo $active_count; ?> | 
               Inactive: <?php echo $inactive_count; ?>
            </p>
            
            <!-- Scale-wise breakdown -->
            <h5>Scale-wise Distribution:</h5>
            <p>
                <?php
                $scale_counts = array();
                foreach ($employees as $emp) {
                    $scale = $emp['employment_scale'];
                    if (!isset($scale_counts[$scale])) {
                        $scale_counts[$scale] = 0;
                    }
                    $scale_counts[$scale]++;
                }
                
                $scale_breakdown = array();
                foreach ($scale_counts as $scale => $count) {
                    $scale_breakdown[] = "$scale: $count";
                }
                echo implode(' | ', $scale_breakdown);
                ?>
            </p>
        </div>
        <?php
    }
}

// If no report generated yet, show instructions
if (!isset($_REQUEST['generate_report']) && !isset($_REQUEST['download_pdf'])) {
    ?>
    <div class="alert alert-info">
        <h4>Employment Mode Report Instructions</h4>
        <p>This report displays employees based on their mode of employment (Additional, Full Time, Part Time).</p>
        <ul>
            <li><strong>Additional:</strong> Employees with additional charges/responsibilities</li>
            <li><strong>Full Time:</strong> Regular full-time employees</li>
            <li><strong>Part Time:</strong> Part-time or contractual employees</li>
            <li>Use filters to narrow down by department, employment scale, or status</li>
            <li>Contract status shows expiration information for time-bound employments</li>
        </ul>
    </div>
    <?php
}

?>