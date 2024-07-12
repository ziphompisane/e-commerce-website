<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

require 'db.php';

$report_type = isset($_GET['report_type']) ? $_GET['report_type'] : 'stock';

if ($report_type == 'stock') {
    $result = $conn->query("SELECT branch.name AS branch_name, album.title, album.artist, stock.quantity 
                            FROM stock 
                            JOIN branch ON stock.branch_id = branch.branch_id 
                            JOIN album ON stock.album_id = album.album_id");
} elseif ($report_type == 'deliveries') {
    $result = $conn->query("SELECT branch.name AS branch_name, driver.name AS driver_name, deliveries.delivery_date 
                            FROM deliveries 
                            JOIN branch ON deliveries.branch_id = branch.branch_id 
                            JOIN driver ON deliveries.driver_id = driver.driver_id");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generate Reports</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Generate Reports</h1>
        <form method="GET" action="generate_report.php">
            <div class="form-group">
                <label for="report_type">Report Type:</label>
                <select id="report_type" name="report_type" class="form-control">
                    <option value="stock" <?php echo ($report_type == 'stock') ? 'selected' : ''; ?>>Stock Levels</option>
                    <option value="deliveries" <?php echo ($report_type == 'deliveries') ? 'selected' : ''; ?>>Deliveries</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Generate Report</button>
        </form>
        <?php if (isset($result) && $result->num_rows > 0): ?>
            <table class="table table-bordered table-striped mt-4">
                <thead>
                    <tr>
                        <?php if ($report_type == 'stock'): ?>
                            <th>Branch</th>
                            <th>Album Title</th>
                            <th>Artist</th>
                            <th>Quantity</th>
                        <?php elseif ($report_type == 'deliveries'): ?>
                            <th>Branch</th>
                            <th>Driver</th>
                            <th>Delivery Date</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <?php if ($report_type == 'stock'): ?>
                                <td><?php echo $row['branch_name']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['artist']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                            <?php elseif ($report_type == 'deliveries'): ?>
                                <td><?php echo $row['branch_name']; ?></td>
                                <td><?php echo $row['driver_name']; ?></td>
                                <td><?php echo $row['delivery_date']; ?></td>
                            <?php endif; ?>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="mt-4">No records found for the selected report type.</p>
        <?php endif; ?>
    </div>
</body>
</html>
