<?php 
session_start();
require 'database/db.php';

if (isset($_SESSION['login'])){
    header("Location: admin.php");
}

if (isset($_POST['register'])){
    if (register($_POST) > 0){
        echo "
            <script>
                alert('User baru berhasil ditambahkan!');
                document.location.href = 'login.php';
            </script>
        ";
    } else {
        echo "
        <script>
            alert('User baru gagal ditambahkan!');
        </script>
    ";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <title>Daftar</title>
    <style>
        p{
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Daftar</h1>

    <form action="" method="POST">
        <div class="form-group">
            <label for="username">Nama User</label>
            <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Kata Sandi</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword2">Konfirmasi Sandi</label>
            <input type="password" class="form-control" id="exampleInputPassword2" name="password2">
        </div>
        <button type="submit" class="btn btn-primary" name="register">Daftar</button><br>
        <p>Sudah punya akun?</p>
        <a href="login.php">masuk</a>
    </form>
</div>
    
</body>
</html>