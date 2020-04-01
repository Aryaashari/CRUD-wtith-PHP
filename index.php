<?php  

session_start();
require 'database/db.php';

if (isset($_SESSION['login'])){
	header("Location: admin.php");
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
		<form action="login.php" method="POST">
			<button type="submit" class="btn btn-secondary">Masuk</button>
		</form>
		<form action="register.php" method="POST">
			<button type="submit" class="btn btn-secondary">Daftar</button>
		</form>
	</div>

	<table class="table table-hover">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Nama</th>
	      <th scope="col">Umur</th>
	      <th scope="col">Alamat</th>
	      <th scope="col">Foto</th>
	    </tr>
	  </thead>

	  <?php $i=1; ?>
	  <?php foreach($data as $siswa) : ?>
	  <tbody>
	    <tr>
	      <th scope="row"><?php echo $i; ?></th>
	      <td><?php echo $siswa["nama"] ?></td>
	      <td><?php echo $siswa["umur"] ?></td>
	      <td><?php echo $siswa["alamat"] ?></td>
	      <td><img src="../img/<?php echo $siswa["foto"] ?>"></td>
	    </tr>
	  </tbody>
	  <?php $i++; ?>
	  <?php endforeach; ?>
	</table>

</div>

</body>
</html>