<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $branch_id = $_POST['branch_id'];
    $album_id = $_POST['album_id'];
    $quantity = $_POST['quantity'];

    $stmt = $conn->prepare("INSERT INTO stock (branch_id, album_id, quantity) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE quantity = ?");
    $stmt->bind_param('iiii', $branch_id, $album_id, $quantity, $quantity);
    $stmt->execute();
    echo "Stock updated successfully";
}

$branches = $conn->query("SELECT * FROM branch");
$albums = $conn->query("SELECT * FROM album");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Stock</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Update Stock</h1>
    <form action="update_stock.php" method="POST">
        <label for="branch_id">Branch:</label>
        <select id="branch_id" name="branch_id" required>
            <?php while ($branch = $branches->fetch_assoc()): ?>
                <option value="<?php echo $branch['branch_id']; ?>"><?php echo $branch['name']; ?></option>
            <?php endwhile; ?>
        </select>
        <label for="album_id">Album:</label>
        <select id="album_id" name="album_id" required>
            <?php while ($album = $albums->fetch_assoc()): ?>
                <option value="<?php echo $album['album_id']; ?>"><?php echo $album['title']; ?></option>
            <?php endwhile; ?>
        </select>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required>
        <button type="submit">Update Stock</button>
    </form>
</body>
</html>
