<?php
if (isset($_POST['download_pdf'])) {
    // Simple HTML output that users can "Print as PDF" from their browser
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Employment Mode Report</title>
        <style>
            body { font-family: Arial, sans-serif; margin: 20px; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th, td { border: 1px solid #000; padding: 8px; text-align: left; }
            th { background-color: #f2f2f2; }
            .header { text-align: center; margin-bottom: 30px; }
            @media print {
                body { margin: 0; }
                .no-print { display: none; }
            }
        </style>
    </head>
    <body>
        <div class="header">
            <h1>Employment Mode Report</h1>
            <p>Generated on: <?php echo date('F j, Y, g:i a'); ?></p>
        </div>
        
        <button class="no-print" onclick="window.print()">Print as PDF</button>
        
        <table>
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Mode</th>
                <th>Scale</th>
                <th>Pay Scale</th>
                <th>Joining Date</th>
                <th>Status</th>
            </tr>
            <?php
            if (!empty($employees)) {
                $sno = 0;
                foreach ($employees as $emp) {
                    $sno++;
                    $department = '';
                    if ($userType == 'admin' && !empty($emp['admin_department'])) {
                        $department = $emp['admin_department'];
                    } elseif ($userType == 'academic' && !empty($emp['academic_department'])) {
                        $department = $emp['academic_department'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $sno; ?></td>
                        <td><?php echo $emp['first_name'] . ' ' . $emp['last_name']; ?></td>
                        <td><?php echo $emp['designation']; ?></td>
                        <td><?php echo $department; ?></td>
                        <td><?php echo $emp['mode_of_employment']; ?></td>
                        <td><?php echo $emp['employment_scale']; ?></td>
                        <td><?php echo $emp['pay_scale']; ?></td>
                        <td><?php echo $emp['date_of_joining'] ? date('d-m-Y', strtotime($emp['date_of_joining'])) : 'N/A'; ?></td>
                        <td><?php echo $emp['is_current'] == 1 ? 'Active' : 'Inactive'; ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        
        <script>
            // Auto-print and close
            window.onload = function() {
                window.print();
                setTimeout(function() {
                    window.close();
                }, 1000);
            };
        </script>
    </body>
    </html>
    <?php
    exit;
}
?>