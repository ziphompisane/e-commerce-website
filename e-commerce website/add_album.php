<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $album_type = $_POST['album_type'];
    $album_category = $_POST['album_category'];

    $stmt = $conn->prepare("INSERT INTO album (title, artist, album_type, album_category) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $title, $artist, $album_type, $album_category);
    $stmt->execute();
    echo "Album added successfully";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Album</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Add Album</h1>
    <form action="add_album.php" method="POST">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <label for="artist">Artist:</label>
        <input type="text" id="artist" name="artist" required>
        <label for="album_type">Album Type:</label>
        <select id="album_type" name="album_type" required>
            <option value="non-promo">Non-promo</option>
            <option value="promotional">Promotional</option>
            <option value="on-discount">On Discount</option>
        </select>
        <label for="album_category">Album Category:</label>
        <input type="text" id="album_category" name="album_category" required>
        <button type="submit">Add Album</button>
    </form>
</body>
</html>
