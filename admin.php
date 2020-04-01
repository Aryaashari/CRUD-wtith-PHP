<?php  
require 'database/db.php';
session_start();


if (!isset($_SESSION['login'])){
	header("Location: index.php");
}

$data = query("SELECT * FROM siswa");


?>

<!DOCTYPE html>
<html>
<head>
	<title>Data Siswa</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<style>
		body{
			padding: 10px;
		}
		form {
			display: inline-block;
			margin-bottom: 20px; 
		}
	</style>
</head>
<body>

<div class="container">
	
	<h1>Data Siswa</h1>

	<div class="tombol">
		<form action="logout.php" method="POST">
			<button type="submit" class="btn btn-secondary">Logout</button>
		</form>
	</div>

	<!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="keyword">
    </form> -->

	<div id="tabel">
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
	</div>

	<form action="crud/tambah.php" method="POST">
		<button type="submit" class="btn btn-secondary">Tambah Data</button>
	</form>

</div>

<script src="js/script.js"></script>
</body>
</html>