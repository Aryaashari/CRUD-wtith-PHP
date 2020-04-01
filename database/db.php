<?php 

$db = mysqli_connect("sql211.epizy.com", "epiz_25272702", "admin01arya2003", "epiz_25272702_data_siswa");


function query($query){
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)){

        $rows[] = $row;
    }

    return $rows;
}


function tambah($data){
    global $db;

    $nama = htmlspecialchars($data['nama']);
    $umur = htmlspecialchars($data['umur']);
    $alamat = htmlspecialchars($data['alamat']);

    $foto = upload();
    if (!$foto){
        return false;
    }

    $query = "INSERT INTO siswa VALUES

                ('', '$nama', '$umur', '$alamat', '$foto')
    ";

    mysqli_query($db, $query);

    return $data;
    // return mysqli_affected_rows($db);
}


function upload(){
    global $db;

    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmp = $_FILES['foto']['tmp_name'];

    // cek apakah ada file yang diupload
    if ($error === 4){
        echo "
            <script>
                alert('Upload foto terlebih dahulu!');
            </script>
        ";
        return false;
    }

    // cek ekstensi valid
    $ekstensiValid = ["jpg", "jpeg", "png"];
    $ekstensi = explode('.', $namaFile);
    $ekstensi = strtolower(end($ekstensi));

    if (!in_array($ekstensi, $ekstensiValid)){
        echo "
            <script>
                alert('Yang anda upload bukan gambar!');
            </script>
        ";
        return false;
    }

    // cek ukuran file
    if ($ukuranFile > 3000000){
        echo "
            <script>
                alert('Ukuran file terlalu besar!');
            </script>
        ";
        return false;
    }

    // ubah nama file
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensi;

    move_uploaded_file($tmp, '../img/' . $namaFileBaru);

    return $namaFileBaru;
}



function hapus($id){
    global $db;

    mysqli_query($db, "DELETE FROM siswa WHERE id=$id");

    return mysqli_affected_rows($db);
}



function ubah($data){
    global $db;

    $id = $data['id'];
    $fotolama = $data['fotolama'];
    $nama = htmlspecialchars($data['nama']);
    $umur = htmlspecialchars($data['umur']);
    $alamat = htmlspecialchars($data['alamat']);

    // ambil data foto
    if ($_FILES['foto']['error'] === 4){
        $foto = $fotolama;
    } else {
        $foto = upload();
    };

    $query = "UPDATE siswa SET 

                id = $id,
                nama = '$nama',
                umur = '$umur',
                alamat = '$alamat',
                foto = '$foto'
                WHERE id=$id
    ";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}



function register($data){
    global $db;

    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($db, $data['password']);
    $password2 = mysqli_real_escape_string($db, $data['password2']);

    // cek username
    $result = mysqli_query($db, "SELECT username FROM user WHERE username='$username' ");
    if (mysqli_fetch_assoc($result)){
        echo "
            <script>
                alert('Username sudah terdaftar!');
            </script>
        ";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2){
        echo "
        <script>
            alert('Konfirmasi password tidak sesuai!');
        </script>
    ";
    return false;
    }

    // eckripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // INSERT USER KE DATABASE
    mysqli_query($db, "INSERT INTO user VALUES ('', '$username', '$password') ");

    return mysqli_affected_rows($db);

}

?>