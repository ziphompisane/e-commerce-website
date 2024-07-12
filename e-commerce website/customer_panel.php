<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Customer Panel</h1>
        <nav class="nav flex-column">
            <a class="nav-link btn btn-primary mb-2" href="index.php">Search Albums</a>
            <a class="nav-link btn btn-primary mb-2" href="productList.php">View Cart</a>
            <a class="nav-link btn btn-danger mt-4" href="logout.php">Logout</a>
        </nav>
    </div>
</body>
</html>
