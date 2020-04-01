<?php 

require '../database/db.php';
session_start();


if (!$_SESSION['login']){
	header("Location: ../index.php");
}

$id = $_GET['id'];

if (hapus($id) > 0){
    echo "
        <script>
            alert('Data berhasil dihapus!');
            document.location.href = '../admin.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data berhasil dihapus!');
        </script>
    ";
}

?>