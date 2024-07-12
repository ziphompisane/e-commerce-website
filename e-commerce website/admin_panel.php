<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: admin_login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Admin Panel</h1>
        <nav class="nav flex-column">
            <a class="nav-link btn btn-primary mb-2" href="add_album.php">Add Album</a>
            <a class="nav-link btn btn-primary mb-2" href="update_stock.php">Update Stock</a>
            <a class="nav-link btn btn-primary mb-2" href="view_stock.php">View Stock</a>
            <a class="nav-link btn btn-primary mb-2" href="add_branch.php">Add Branch</a>
            <a class="nav-link btn btn-primary mb-2" href="assign_driver.php">Assign Driver to Delivery</a>
            <a class="nav-link btn btn-primary mb-2" href="generate_report.php">Generate Reports</a>
            <a class="nav-link btn btn-danger mt-4" href="logout.php">Logout</a>
        </nav>
    </div>
</body>
</html>