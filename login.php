<?php 
session_start();
require 'database/db.php';

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($db, "SELECT username FROM user WHERE id='$id' ");
    $row = mysqli_fetch_assoc($result);

    if ($key === hash('sha256', $row['username'])){
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION['login'])){
    header("Location: admin.php");
}

if (isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $results = mysqli_query($db, "SELECT * FROM user WHERE username = '$username' ");

    if (mysqli_num_rows($results) == 1){
        $row = mysqli_fetch_assoc($results);

        // SET SESSION
        $_SESSION['login'] = true;

        // CEK TOMBOL REMEMBER
        if (isset($_POST['remember'])){
            // SET COOKIE
            setcookie('id', $row['id'], time()+60);
            setcookie('key', hash('sha256', $row['username']), time()+60);
        }

        if (password_verify($password, $row['password'])){
            header("Location: admin.php");
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <title>Document</title>
    <style>
        p{
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Masuk</h1>

    <form action="" method="POST">
        <div class="form-group">
            <label for="username">Nama User</label>
            <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Kata Sandi</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
            <label class="form-check-label" for="exampleCheck1">Ingat saya</label>
        </div>
        <button type="submit" class="btn btn-primary" name="login">Masuk</button><br>
        <p>Belum punya akun?</p>
        <a href="register.php">daftar</a>
    </form>
</div>
    
</body>
</html>