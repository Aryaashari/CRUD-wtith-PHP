<?php 

require '../database/db.php';

$keyword = $_GET['keyword'];

$query = "SELECT * FROM siswa WHERE 

            nama LIKE '%$keyword%' OR
            umur LIKE '%$keyword%' OR
            alamat LIKE '%$keyword%'
";
$data = query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nama</th>
        <th scope="col">Umur</th>
        <th scope="col">Alamat</th>
        <th scope="col">Foto</th>
        <th scope="col">Aksi</th>
        </tr>
    </thead>

    <?php $i=1; ?>
    <?php foreach($data as $siswa) : ?>
    <tbody>
        <tr>
        <th scope="row"><?php echo $i; ?></th>
        <td><?php echo $siswa["nama"]; ?></td>
        <td><?php echo $siswa["umur"]; ?></td>
        <td><?php echo $siswa["alamat"]; ?></td>
        <td><img src="img/<?php echo $siswa["foto"]; ?>"></td>
        <td>
            <form action="crud/ubah.php?id=<?php echo $siswa['id'] ?>" method="POST">
                <button type="submit" class="btn btn-success">Ubah</button>
            </form>
            <form action="crud/hapus.php?id=<?php echo $siswa['id'] ?>" method="POST" onclick="return confirm('Yakin ingin menghapus data?'); ">
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </td>
        </tr>
    </tbody>
    <?php $i++; ?>
    <?php endforeach; ?>
    </table>
</body>
</html>