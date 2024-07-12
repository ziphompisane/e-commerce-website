<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $username, $password, $role);

    if ($stmt->execute()) {
        header('Location: user_Login.php');
        exit;
    } else {
        $error = "Error registering user.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Registration Page</title>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="wrapper_2">
        <form action="" method="post">
                <h3> Register</h3>

                    <div class="input-box">
                        <input type="text" name="username" required placeholder="username">
                        <i class='bx bxs-user'></i>
                        </div>
                    
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" class="form-control" required>
                                    <option value="customer">Customer</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>  

                        <div class="input-box">
                        <input type="password" name="password"  required placeholder="confirm password">
                        <i class='bx bxs-lock-alt'></i>   
                    </div>
                    

                        <input type="submit" name="submit" class="btn" value="register">
                    <div class="login-link"></div>
                    <p>
                      Already have an account! <a href="user_Login.php">login here </a>  
                    </p>
                </div>
        </form>
    </div> 
</body>
</html>

