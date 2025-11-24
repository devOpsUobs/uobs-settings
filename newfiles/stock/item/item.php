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
if (isset($_POST['stck_item'])) {
    $id = intval($_POST['item_id']);
    $category_id = $_POST['category_id'];
    $item_name = $_POST['item_name'];
    $item_code = $_POST['item_code'];
    $type = $_POST['type'];
    $unit = $_POST['unit'];
    $description = $_POST['description'];

    if ($id) {
        mysqli_query($conn, "UPDATE uobs_stck_items SET 
            category_id='$category_id',
            item_name='$item_name',
            item_code='$item_code',
            type='$type',
            unit='$unit',
            description='$description',
            updated_by='$userid' 
            WHERE id=$id");
        header("Location: ../index.php/stock/stock-item");
        exit;
    } else {
        $check = mysqli_query($conn, "SELECT id FROM uobs_stck_items WHERE category_id = '$category_id' AND item_name = '$item_name'");
        if (mysqli_num_rows($check) > 0) {
            // Optional: show an error message
            echo "<font color=red>Item with this category and name already exists!</font>";
        } else {
            // Proceed with insert
            mysqli_query($conn, "INSERT INTO uobs_stck_items 
                (category_id, item_name, item_code, type, unit, description, inserted_by) 
                VALUES ('$category_id', '$item_name', '$item_code', '$type', '$unit', '$description', '$userid')");
        }
    }
}

// Handle edit
if (isset($_GET['edit'])) {
    $eid = intval($_GET['edit']);
    $res = mysqli_query($conn, "SELECT * FROM uobs_stck_items WHERE id = $eid");
    $edit = mysqli_fetch_assoc($res);
}

// Handle delete
if (isset($_GET['delete'])) {
    $did = intval($_GET['delete']);

    // Check if this item ID exists in another table (e.g., referenced in uobs_stck_entries)
    $check = mysqli_query($conn, "SELECT id FROM uobs_stck_entries WHERE item_id = $did");

    if (mysqli_num_rows($check) > 0) {
        // Optional: use session to show message
        echo "<font color=red>Cannot delete this item. It is already used in stock entries.</font>";
    } else {
        // Proceed with deletion
        mysqli_query($conn, "DELETE FROM uobs_stck_items WHERE id = $did");
        echo "<font color=green>Item deleted successfully.</font>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Stock Items</title>
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
    <h3 class="mb-4">Manage Stock Items</h3>

    <form method="post" action="" class="border p-4 mb-4 bg-light rounded">
        <input type="hidden" name="item_id" value="<?= $edit['id'] ?? '' ?>">

        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Category</label>
                <select name="category_id" class="form-control" required>
                    <option value="">-- Select --</option>
                    <?php
                    $cat = mysqli_query($conn, "SELECT * FROM uobs_stck_category");
                    while ($c = mysqli_fetch_assoc($cat)) {
                        $sel = (isset($edit['category_id']) && $edit['category_id'] == $c['id']) ? "selected" : "";
                        echo "<option value='{$c['id']}' $sel>{$c['category']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Item Name</label>
                <input type="text" name="item_name" class="form-control" required value="<?= $edit['item_name'] ?? '' ?>">
            </div>
            <div class="form-group col-md-4">
                <label>Item Code</label>
                <input type="text" name="item_code" class="form-control" required value="<?= $edit['item_code'] ?? '' ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Type</label>
                <select name="type" class="form-control" required>
                    <option value="">-- Select --</option>
                    <option value="Consumable" <?= (isset($edit['type']) && $edit['type'] == 'Consumable') ? 'selected' : '' ?>>Consumable</option>
                    <option value="Not Consumable" <?= (isset($edit['type']) && $edit['type'] == 'Not Consumable') ? 'selected' : '' ?>>Not Consumable</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Unit</label>
                <input type="text" name="unit" class="form-control" value="<?= $edit['unit'] ?? '' ?>">
            </div>
            <div class="form-group col-md-4">
                <label>Description</label>
                <input type="text" name="description" class="form-control" value="<?= $edit['description'] ?? '' ?>">
            </div>
        </div>

        <button type="submit" name="stck_item" class="btn btn-<?= isset($edit['id']) ? 'success' : 'primary' ?> mt-3">
            <?= isset($edit['id']) ? '💾 Update Item' : '➕ Add Item' ?>
        </button>
    </form>

    <table id="dataTable" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Category</th>
            <th>Item Name</th>
            <th>Item Code</th>
            <th>Type</th>
            <th>Unit</th>
            <th>Description</th>
            <th>Inserted By</th>
            <th>Updated By</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $items = mysqli_query($conn, "SELECT i.*, c.category FROM uobs_stck_items i 
                                       LEFT JOIN uobs_stck_category c ON i.category_id = c.id 
                                       ORDER BY i.id DESC");
        while ($row = mysqli_fetch_assoc($items)) {
            echo "<tr>
                <td>{$row['category']}</td>
                <td>{$row['item_name']}</td>
                <td>{$row['item_code']}</td>
                <td>{$row['type']}</td>
                <td>{$row['unit']}</td>
                <td>{$row['description']}</td>
                <td>{$row['inserted_by']}</td>
                <td>{$row['updated_by']}</td>
                <td>
                    <a href='stock-item?edit={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                    <a href='stock-item?delete={$row['id']}' onclick='return confirm(\"Are you sure?\")' class='btn btn-sm btn-danger'>Delete</a>
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
        $('#dataTable').DataTable({
            pageLength: 10
        });
    });
</script>
</body>
</html>
