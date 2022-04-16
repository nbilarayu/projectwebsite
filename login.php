
<?php

session_start();
require 'function.php';

// cek dulu cookie 
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($db, "SELECT username FROM user WHERE id = $id ");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: index1.php");
    exit;
}



if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($db, "SELECT * FROM user WHERE username = '$username' ");
    // cek username
    if (mysqli_num_rows($result) === 1) {
        // cek pssword
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            //set session 
            $_SESSION["login"] = true;

            // cek remember me
            if (isset($_POST['remember'])) {
                // buat cookie dan acak cookie

                setcookie('id', $row['id'], time() + 60);

                // mengacak $row dengan algoritma 'sha256'
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }

            header("Location: index1.php");
            exit;
        }
    }

    $error = true;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php if (isset($error)) : ?>
        <p style="color:red;">username / password salah</p>
    <?php endif ?>
   <div class="overlay"></div>
   <form action="" method="post" class="box">
       <div class="header">
           <h4>Login To Your Account</h4>
       </div>
       <div class="login-area">
           <input type="text" name="username" class="username" placeholder="Username">
           <input type="password" name="password" class="password" placeholder="Password">
           <input type="checkbox" name="remember" id="remember">
           <label for="remember"> Remember me</label>
           <input type="submit" name="login" value="Login" class="submit">
           <a href="registrasi.php">New Account</a>
       </div>
   </form> 
</body>
</html>