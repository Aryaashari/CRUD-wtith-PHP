<?php 

require '../database/db.php';
session_start();


if (!$_SESSION['login']){
	header("Location: ../index.php");
}

$id = $_GET['id'];

$data = query("SELECT * FROM siswa WHERE id=$id")[0];

if (isset($_POST['ubah'])){
    if (ubah($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil diubah!');
                document.location.href = '../admin.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Anda tidak mengubah data');
                document.location.href = '../admin.php';
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
    <title>Ubah Data</title>

    <style>
        h1 {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Ubah Data</h1>
    
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="fotolama" value="<?php echo $data['foto']; ?>">
            <div class="form-group">
                <label for="exampleFormControlInput1">Nama</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="masukkan nama anda" name="nama" value="<?php echo $data['nama']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput2">Umur</label>
                <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="masukkan umur anda" name="umur" value="<?php echo $data['umur']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput3">Alamat</label>
                <textarea class="form-control" id="exampleFormControlInput3" rows="3" name="alamat" ><?php echo $data['alamat']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="foto">Foto</label><br>
                <img src="../img/<?php echo $data['foto']; ?>">
                <input type="file" class="form-control-file" name="foto" id="foto" >
            </div>

            <button type="submit" name="ubah" class="btn btn-primary">Ubah Data</button>
        </form>
    </div>
</body>
</html>