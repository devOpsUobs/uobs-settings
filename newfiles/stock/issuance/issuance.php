<?php
include 'newfiles/conn.php';
include 'newfiles/common.php';

$user = JFactory::getUser();
$userid = $user->id;


// Permission check
if (checkPermission($user, "stock_setting") == 0) {
    echo "You don't have permission to access this page!";
    return;
}

$edit = null;

// Handle form submission
if (isset($_POST['stck_issue'])) {
    $id = intval($_POST['issuance_id']);
    $stockentry_id = $_POST['stockentry_id'];
   
    $issue_to = $_POST['issue_to'];
    $issue_date = $_POST['issue_date'];
    $quantity = $_POST['quantity'];
    $return_date = $_POST['return_date'];
    $remarks = $_POST['remarks'];

    if ($id) {
        mysqli_query($conn, "UPDATE uobs_stck_issuance SET 
            stockentry_id='$stockentry_id',
            issue_to='$issue_to',
            issue_date='$issue_date',
            quantity='$quantity',
            return_date='$return_date',
            remarks='$remarks',
            updated_by='$userid' 
            WHERE id=$id");
             header("Location: ../index.php/stock/stock-issuance");
    } else {
        mysqli_query($conn, "INSERT INTO uobs_stck_issuance 
            (stockentry_id,issue_to, issue_date, quantity, return_date, remarks, inserted_by) 
            VALUES ('$stockentry_id', '$issue_to', '$issue_date', '$quantity', '$return_date', '$remarks', '$userid')");
    }
   
}

// Handle edit
if (isset($_GET['edit'])) {
    $eid = intval($_GET['edit']);
    $res = mysqli_query($conn, "SELECT * FROM uobs_stck_issuance WHERE id = $eid");
    $edit = mysqli_fetch_assoc($res);
}

// Handle delete
if (isset($_GET['delete'])) {
    $did = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM uobs_stck_issuance WHERE id = $did");
    echo "<font color=green>Issuance record deleted successfully.</font>";
     header("Location: ../index.php/stock/stock-issuance");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Stock Issuance</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <style>
        body { font-size: 16px; }
        .form-control, .btn, table { font-size: 16px; }
        table.dataTable td, table.dataTable th { font-size: 14px !important; }
        h3 { font-size: 24px; font-weight: bold; }
    </style>
</head>
<body class="p-4">
<div class="container">
    <h3 class="mb-4">Stock Issuance</h3>

    <form method="post" action="" class="border p-4 bg-light mb-4 rounded">
        <input type="hidden" name="issuance_id" value="<?= $edit['id'] ?? '' ?>">

        <div class="form-row">
           <div class="form-group col-md-4">
                <label>Stock Entry</label>
                <select name="stockentry_id" class="form-control" required>
                    <option value="">-- Select Entry --</option>
                    <?php
                    $entries = mysqli_query($conn, "SELECT e.id, e.ass_number, i.item_name 
                                                    FROM uobs_stck_entries e
                                                    LEFT JOIN uobs_stck_items i ON e.item_id = i.id
                                                    ORDER BY e.id DESC");
                    while ($entry = mysqli_fetch_assoc($entries)) {
                        $selected = (isset($edit['stockentry_id']) && $edit['stockentry_id'] == $entry['id']) ? "selected" : "";
                        echo "<option value='{$entry['id']}' $selected>
                                  ({$entry['item_name']}) - {$entry['ass_number']}
                            </option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Issued To</label>
                <select name="issue_to" class="form-control select2" required>
                    <option value="">-- Select Employee --</option>
                    <?php
                    $employees = mysqli_query($conn, "
                        SELECT e.emp_no, e.first_name, e.last_name, d.designation 
                        FROM kiusc_employees e
                        LEFT JOIN kiusc_designations d ON e.designation_id = d.id
                        WHERE e.is_active = 1
                        ORDER BY e.first_name, e.last_name
                    ");
                    while ($emp = mysqli_fetch_assoc($employees)) {
                        $fullName = trim($emp['first_name'] . ' ' . $emp['last_name']);
                        $designation = $emp['designation'] ?? 'N/A';
                        $empLabel = "{$fullName} ({$designation})";
                        $selected = (isset($edit['issue_to']) && $edit['issue_to'] == $emp['emp_no']) ? "selected" : "";
                        echo "<option value='{$emp['emp_no']}' $selected>$empLabel</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group col-md-4">
                <label>Issue Date</label>
                <input type="date" name="issue_date" class="form-control" required value="<?= $edit['issue_date'] ?? '' ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Quantity</label>
                <input type="number" name="quantity" class="form-control" required value="<?= $edit['quantity'] ?? '' ?>">
            </div>
            <div class="form-group col-md-4">
                <label>Return Date</label>
                <input type="date" name="return_date" class="form-control" value="<?= $edit['return_date'] ?? '' ?>">
            </div>
            <div class="form-group col-md-4">
                <label>Remarks</label>
                <input type="text" name="remarks" class="form-control" value="<?= $edit['remarks'] ?? '' ?>">
            </div>
        </div>

        <button type="submit" name="stck_issue" class="btn btn-<?= isset($edit['id']) ? 'success' : 'primary' ?>">
            <?= isset($edit['id']) ? '💾 Update Issuance' : '➕ Issue Stock' ?>
        </button>
    </form>

    <table id="issuanceTable" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>StockEntry ID</th>
            <th>Issued To</th>
            <th>Issue Date</th>
            <th>Quantity</th>
            <th>Return Date</th>
            <th>Remarks</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
       <?php
        $data = mysqli_query($conn, "
            SELECT i.id AS issuance_id, i.issue_to, i.issue_date, i.quantity, i.return_date, i.remarks,
                e.ass_number, it.item_name,
                emp.first_name, emp.last_name, desig.designation
            FROM uobs_stck_issuance i
            LEFT JOIN uobs_stck_entries e ON i.stockentry_id = e.id
            LEFT JOIN uobs_stck_items it ON e.item_id = it.id
            LEFT JOIN kiusc_employees emp ON i.issue_to = emp.emp_no
            LEFT JOIN kiusc_designations desig ON emp.designation_id = desig.id
            ORDER BY i.id DESC
        ");


            while ($row = mysqli_fetch_assoc($data)) {
                $entryLabel = "{$row['ass_number']} ({$row['item_name']})";
                $issuedToLabel = trim($row['first_name'] . ' ' . $row['last_name']) . " ({$row['designation']})";

                echo "<tr>
                    <td>{$entryLabel}</td>
                    <td>{$issuedToLabel}</td>
                    <td>{$row['issue_date']}</td>
                    <td>{$row['quantity']}</td>
                    <td>{$row['return_date']}</td>
                    <td>{$row['remarks']}</td>
                    <td>
                        <a href='stock-issuance?edit={$row['issuance_id']}' class='btn btn-sm btn-warning'>Edit</a>
                        <a href='stock-issuance?delete={$row['issuance_id']}' onclick='return confirm(\"Are you sure?\")' class='btn btn-sm btn-danger'>Delete</a>
                    </td>
                </tr>";
            }

?>

        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#issuanceTable').DataTable({ pageLength: 10 });
    });
</script>
</body>
</html>
