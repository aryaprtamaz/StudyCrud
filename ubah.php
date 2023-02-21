<?php
session_start();
if ( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}
require 'function.php';

// ambil data URL
$id = $_GET["id"];
// query data mahasiswa berdasarkan id
$jos = query("SELECT * FROM mahasiswa WHERE id = $id")[0]; // ambil data = query

// cek apakah tombol submit sudah di tekan atau belum
    if ( isset($_POST["submit"]) ) {
// cek apakah data berhasil diubah atau tidak
    if( ubah($_POST) > 0 ){
        echo " 
        <script>
                alert('data berhasil diubah');
                document.location.href = 'index.php';
            </script>
            ";
    }else {
        echo "
        <script>
            alert('data gagal diubah!!');
            document.location.href = 'index.php':
        </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ubah data mahasiswa</title>
</head>
<body>
    <h1>Ubah data mahasiswa</h1>

    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $jos["id"]; ?>">
        <ul>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama"required value="<?= $jos["nama"]; ?>">
            </li>
            <li>
                <label for="nrp">NRP :</label>
                <input type="text" name="nrp" id="nrp" required value="<?= $jos["nrp"]; ?>">
            </li>
             <li>
                <label for="email">Email :</label>
                <input type="text" name="email" id="email" value="<?= $jos["email"]; ?>">
             </li>
             <li> 
                <label for="jurusan">Jurusan :</label>
                <input type="text" name="jurusan" id="jurusan" value="<?= $jos["jurusan"]; ?>">
             </li>
             <li>
                <label for="gambar">Gambar :</label>
                <img src="img/<?= $jos ['gambar'];  ?>" style="" width="100">
                <input type="file" name="gambar" id="gambar">
             </li> 
             <li>
                <button type="submit" name="submit">Ubah Data!</button>
             </li>
        </ul>



    </form>
    
</body>
</html>