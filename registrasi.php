<?php
// Koneksi ke database
require 'function.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo " <script>
            alert('user baru berhasil ditambahkan');
        </script> ";
    } else {
        echo mysqli_error($db);
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;700&display=swap" rel="stylesheet">
</head>
<body>
    
   <form action="" method="post" class="box">
       <div class="header">
           <h4>Register</h4>
       </div>
       <div class="login-area">
           <input type="text" name="username" class="username" placeholder="Username">
           <input type="password" name="password" class="password" placeholder="Password">
           <input type="submit" name="register" value="Register" class="submit">
           <a href="login.php">Login</a>
           
       </div>
   </form> 
</body>
</html>