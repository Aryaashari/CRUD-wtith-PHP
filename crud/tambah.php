<?php 

require '../database/db.php';
session_start();


if (!$_SESSION['login']){
	header("Location: ../index.php");
}

if (isset($_POST['tambah'])){
    if (tambah($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil ditambahkan');
                document.location.href = '../admin.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal ditambahkan');
            </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    <title>Tambah Data</title>

    <style>
        h1 {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Tambah Data</h1>
    
    
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleFormControlInput1">Nama</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="masukkan nama anda" name="nama">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput2">Umur</label>
                <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="masukkan umur anda" name="umur">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput3">Alamat</label>
                <textarea class="form-control" id="exampleFormControlInput3" rows="3" name="alamat"></textarea>
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" class="form-control-file" name="foto" id="foto">
            </div>

            <button type="submit" name="tambah" class="btn btn-primary">Tambah Data</button>
        </form>
    </div>
</body>
</html>