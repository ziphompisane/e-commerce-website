<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['admin_id'];
        header('Location: admin_panel.php');
    } else {
        echo "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login Page</title>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="style_admin.css">
        <script src="login.js"></script>
    </head>
    <body>
        <div class="wrapper">
            <div class="form-container">
                <form action=" " method="post">
                    <h3> Login</h3>
                    <div class="input-box">
                    <input type="text"id="username"name="username" required placeholder="username" autocomplete="off">
                    <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box">
                    <input type="password" name="password"  required placeholder="password" autocomplete="off">
                    <i class='bx bxs-lock-alt'></i>
                    </div>
                    
                    <input type="checkbox" name="forgot password" value="forgot password">
                    <label for="forgot password">Forgot Password</label><br>
                    
                    <button class="login" onclick="login()">Login now</button>
                    <br><br>
                    <button class="cancel" onclick="cancel()">CANCEL</button>
   <script>      
    function cancel(){
        window.location.href="WelcomePage.html";
        }
    function login(){
        alert("Welcome Admin");
        window.location.href = "dashboard.html";
        }
    </script>

       </form>
         </div>
           </div>
    </body>
</html>
