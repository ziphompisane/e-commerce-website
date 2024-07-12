<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $branch_id = $_POST['branch_id'];
    $driver_id = $_POST['driver_id'];
    $delivery_date = $_POST['delivery_date'];

    $stmt = $conn->prepare("INSERT INTO deliveries (branch_id, driver_id, delivery_date) VALUES (?, ?, ?)");
    $stmt->bind_param('iis', $branch_id, $driver_id, $delivery_date);
    $stmt->execute();
    echo "Driver assigned to delivery successfully";
}

$branches = $conn->query("SELECT * FROM branch");
$drivers = $conn->query("SELECT * FROM driver");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assign Driver to Delivery</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Assign Driver to Delivery</h1>
    <form action="assign_driver.php" method="POST">
        <label for="branch_id">Branch:</label>
        <select id="branch_id" name="branch_id" required>
            <?php while ($branch = $branches->fetch_assoc()): ?>
                <option value="<?php echo $branch['branch_id']; ?>"><?php echo $branch['name']; ?></option>
            <?php endwhile; ?>
        </select>
        <label for="driver_id">Driver:</label>
        <select id="driver_id" name="driver_id" required>
            <?php while ($driver = $drivers->fetch_assoc()): ?>
                <option value="<?php echo $driver['driver_id']; ?>"><?php echo $driver['name']; ?></option>
            <?php endwhile; ?>
        </select>
        <label for="delivery_date">Delivery Date:</label>
        <input type="date" id="delivery_date" name="delivery_date" required>
        <button type="submit">Assign Driver</button>
    </form>
</body>
</html>
