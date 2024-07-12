<?php
session_start();
// Unset all session variables
$_SESSION = array();
// Destroy the session
session_destroy();
// Redirect to login page or home page
header("Location: welcome page.php");
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="logout.css">
    <title>Welcome</title>
</head>
<body>
    <div class="welcome-box">
        <h2>Welcome <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>You have successfully logged in.</p>
        <a class="logout" href="logout.php">Logout</a>
    </div>
</body>
</html>

