<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

require 'db.php';

$result = $conn->query("SELECT branch.name AS branch_name, album.title, album.artist, stock.quantity 
                        FROM stock 
                        JOIN branch ON stock.branch_id = branch.branch_id 
                        JOIN album ON stock.album_id = album.album_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Stock</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Stock Levels</h1>
    <table>
        <thead>
            <tr>
                <th>Branch</th>
                <th>Album Title</th>
                <th>Artist</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['branch_name']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['artist']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
