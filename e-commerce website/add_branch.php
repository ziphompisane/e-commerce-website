<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("INSERT INTO branch (name, address) VALUES (?, ?)");
    $stmt->bind_param('ss', $name, $address);
    $stmt->execute();
    echo "Branch added successfully";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Branch</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Add Branch</h1>
    <form action="add_branch.php" method="POST">
        <label for="name">Branch Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>
        <button type="submit">Add Branch</button>
    </form>
</body>
</html>
