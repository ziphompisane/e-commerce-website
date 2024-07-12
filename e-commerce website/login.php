<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_id, password, role FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hash, $role);
        $stmt->fetch();

        if (password_verify($password, $hash)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['role'] = $role;

            if ($role == 'admin') {
                header('Location: admin_panel.php');
            } else {
                header('Location: Search&Cart/index.php');
            }
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found with that username.";
    }
}
?>
    <script>
        function validateLoginForm() {
            let username = document.getElementById('username').value;
            let password = document.getElementById('password').value;
            let valid = true;
            let usernameError = '';
            let passwordError = '';

            // Validate username
            if (username.length < 5) {
                usernameError = 'Username must be at least 5 characters long.';
                valid = false;
            }

            // Validate password
            if (password.length < 5) {
                passwordError = 'Password must be at least 5 characters long.';
                valid = false;
            }

            // Display error messages
            document.getElementById('usernameError').textContent = usernameError;
            document.getElementById('passwordError').textContent = passwordError;

            return valid;
        }
    </script>
<!DOCTYPE html>
	<html lang="en">
	    <head>
	        <meta charset="UTF-8">
	        <meta http-equiv="X-UA-Compatible" content="IE=edge">
	        <meta name="viewport" content="width=device-width, initial-scale=1">
	        <title>Login Page</title>
	        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	        <link rel="stylesheet" href="style.css">
	        <script src="login.js"></script>
	    </head>
	    <body>
	        <div class="wrapper">
	            <div class="form-container">
	                <form action=" " onsubmit="return validateForm()" method="post">
	                    <h3> Login</h3>
	                    <div class="input-box">
	                    <input type="text"id="username"name="username" required placeholder="username">
	                    <i class='bx bxs-user'></i>
	                    </div>
	                    <div class="input-box">
	                    <input type="password" name="password"  required placeholder="password">
	                    <i class='bx bxs-lock-alt'></i>
	                    </div>
	                    <button class="login"  href="Search&Cart/index.html">Login now</button>
	              
	        <div class="register-link"></div>
	            <p>
	            don't have an account? <a href="register.html">register now </a>  
	            </p>
	        </div>
	                </form>
	            </div>
	    </body>
	</html>
