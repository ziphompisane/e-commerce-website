<?php
session_start();
require 'db.php';

$session_id = session_id();

$stmt = $conn->prepare("SELECT cart.*, albums.title, albums.artist, albums.price, albums.stock FROM cart JOIN albums ON cart.album_id = albums.album_id WHERE session_id = ?");
$stmt->bind_param('s', $session_id);
$stmt->execute();
$result = $stmt->get_result();
$cart_items = $result->fetch_all(MYSQLI_ASSOC);

$errors = [];
foreach ($cart_items as $item) {
    if ($item['quantity'] > $item['stock']) {
        $errors[] = "Not enough stock for " . htmlspecialchars($item['title']) . ". Available: " . htmlspecialchars($item['stock']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($errors)) {
    // Proceed to finalize the checkout, e.g., reduce stock, clear cart, etc.
    foreach ($cart_items as $item) {
        $new_stock = $item['stock'] - $item['quantity'];
        $stmt = $conn->prepare("UPDATE albums SET stock = ? WHERE album_id = ?");
        $stmt->bind_param('ii', $new_stock, $item['album_id']);
        $stmt->execute();
    }

    // Clear the cart
    $stmt = $conn->prepare("DELETE FROM cart WHERE session_id = ?");
    $stmt->bind_param('s', $session_id);
    $stmt->execute();

    // Redirect to a thank you page or confirmation
    header('Location: thank_you.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Checkout</h1>
        <?php if ($errors): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form method="POST" action="checkout.php">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Artist</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['title']); ?></td>
                            <td><?php echo htmlspecialchars($item['artist']); ?></td>
                            <td><?php echo htmlspecialchars($item['price']); ?></td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($item['price'] * $item['quantity']); ?></td>
                        </tr>
                        <?php $total += $item['price'] * $item['quantity']; ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total</th>
                        <th><?php echo htmlspecialchars($total); ?></th>
                    </tr>
                </tfoot>
            </table>
            <button type="submit" class="btn btn-success">Confirm Purchase</button>
        </form>
    </div>
</body>
</html>
