<?php
include 'newfiles/conn.php';
include 'newfiles/common.php';

$user = JFactory::getUser();
$userid = $user->id;

if (checkPermission($user, "stock_setting") == 0) {
    echo "You don't have permission to access this page!";
    return;
}

$edit = null;

// Insert or Update Entry
if (isset($_POST['stck_entry'])) {
    $id = intval($_POST['entry_id']);
    $item_id = $_POST['item_id'];
    $ass_number = $_POST['ass_number'];
    $quantity = $_POST['quantity'];
    $date = $_POST['date'];
    $remarks = $_POST['remarks'];

    if ($id) {
        $disposed = isset($_POST['disposed']) ? 1 : 0;
        $disposed_date = $_POST['disposed_date'] ?: NULL;

        mysqli_query($conn, "UPDATE uobs_stck_entries SET 
            item_id='$item_id',
            ass_number='$ass_number',
            quantity='$quantity',
            date='$date',
            disposed='$disposed',
            disposed_date=" . ($disposed_date ? "'$disposed_date'" : "NULL") . ",
            remarks='$remarks',
            updated_by='$userid' 
            WHERE id=$id");
              header("Location: ../index.php/stock/stock-entry");
    } else {
        // Insert without disposed/disposed_date
        mysqli_query($conn, "INSERT INTO uobs_stck_entries 
            (item_id, ass_number, quantity, date, remarks, inserted_by) 
            VALUES ('$item_id', '$ass_number', '$quantity', '$date', '$remarks', '$userid')");
    }

    
}

// Edit
if (isset($_GET['edit'])) {
    $eid = intval($_GET['edit']);
    $res = mysqli_query($conn, "SELECT * FROM uobs_stck_entries WHERE id = $eid");
    $edit = mysqli_fetch_assoc($res);
}

// Delete
if (isset($_GET['delete'])) {
    $did = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM uobs_stck_entries WHERE id = $did");
    echo "<div class='alert alert-success'>Entry deleted successfully.</div>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Stock Entries</title>
    <meta charset="UTF-8">
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
    <h3 class="mb-4">Manage Stock Entries</h3>

    <form method="post" action="" class="border p-4 mb-4 bg-light rounded">
        <input type="hidden" name="entry_id" value="<?= $edit['id'] ?? '' ?>">

        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Item</label>
                <select name="item_id" class="form-control" required>
                    <option value="">-- Select Item --</option>
                    <?php
                    $items = mysqli_query($conn, "SELECT id, item_name FROM uobs_stck_items");
                    while ($item = mysqli_fetch_assoc($items)) {
                        $sel = (isset($edit['item_id']) && $edit['item_id'] == $item['id']) ? 'selected' : '';
                        echo "<option value='{$item['id']}' $sel>{$item['item_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Asset Number</label>
                <input type="text" name="ass_number" class="form-control" value="<?= htmlspecialchars($edit['ass_number'] ?? '', ENT_QUOTES) ?>">
            </div>
            <div class="form-group col-md-4">
                <label>Quantity</label>
                <input type="number" name="quantity" class="form-control" required value="<?= $edit['quantity'] ?? '' ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Date</label>
                <input type="date" name="date" class="form-control" required value="<?= $edit['date'] ?? '' ?>">
            </div>

            <?php if (isset($edit['id'])): ?>
                <div class="form-group col-md-4">
                    <label>Disposed</label><br>
                    <input type="checkbox" name="disposed" <?= ($edit['disposed']) ? 'checked' : '' ?>> Yes
                </div>
                <div class="form-group col-md-4">
                    <label>Disposed Date</label>
                    <input type="date" name="disposed_date" class="form-control" value="<?= $edit['disposed_date'] ?? '' ?>">
                </div>
            <?php else: ?>
                <div class="form-group col-md-8"></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Remarks</label>
            <textarea name="remarks" class="form-control"><?= htmlspecialchars($edit['remarks'] ?? '', ENT_QUOTES) ?></textarea>
        </div>

        <button type="submit" name="stck_entry" class="btn btn-<?= isset($edit['id']) ? 'success' : 'primary' ?> mt-3">
            <?= isset($edit['id']) ? '💾 Update Entry' : '➕ Add Entry' ?>
        </button>
    </form>

    <table id="dataTable" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Item</th>
            <th>Asset No</th>
            <th>Qty</th>
            <th>Date</th>
            <th>Disposed</th>
            <th>Disposed Date</th>
            <th>Remarks</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $entries = mysqli_query($conn, "SELECT e.*, i.item_name FROM uobs_stck_entries e 
                                        LEFT JOIN uobs_stck_items i ON e.item_id = i.id 
                                        ORDER BY e.id DESC");
        while ($row = mysqli_fetch_assoc($entries)) {
            echo "<tr>
                <td>{$row['item_name']}</td>
                <td>{$row['ass_number']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['date']}</td>
                <td>" . ($row['disposed'] ? 'Yes' : 'No') . "</td>
                <td>{$row['disposed_date']}</td>
                <td>{$row['remarks']}</td>
                <td>
                    <a href='stock-entry?edit={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                    <a href='stock-entry?delete={$row['id']}' onclick='return confirm(\"Are you sure?\")' class='btn btn-sm btn-danger'>Delete</a>
                </td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({ pageLength: 10 });
    });
</script>
</body>
</html>
