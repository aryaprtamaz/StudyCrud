<?php
session_start();
if ( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}

require 'function.php';

// koneksi ke DBMS
    //$conn = mysqli_connect("localhost", "root", "", "phpdasar");

// cek apakah tombol submit sudah di tekan atau belum
    if (isset($_POST["submit"]) ) {

//ambil data dari tiap element dalam from
    // $nama = $_POST["nama"];
    // $nrp = $_POST["nrp"];
    // $email = $_POST["email"];
    // $jurusan = $_POST["jurusan"];
    // $gambar = $_POST["gambar"];
    
    // query insert data 
    //$query = "INSERT INTO mahasiswa
          //  VALUES
          //  ('id','$nama','$nrp','$email','$jurusan','$gambar')
          // ";
    //mysqli_query($coon, "query");

    // cek apakah data berhasil ditambahkan atau tidak
    if( tambah($_POST) > 0 ) {
        echo " <script>
                alert('data berhasil ditambahkan');
                document.location.href = 'index.php';
            </script>
            ";
    }else {
        echo "
        <script>
            alert('data gagal ditambahkan!');
            document.location.href = 'index.php':
        </script>
        ";
    }
    // mengecek data  
    // if(mysqli_affected_rows($conn) > 0 ){
        // echo "berhasil";
    // }else {
        // echo "gagal";
        // echo "<br>";
        // echo mysqli_error($conn);
    // }
// 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah data mahasiswa</title>
</head>
<body>
    <h1>Tambah data mahasiswa</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama"required>
            </li>
            <li>
                <label for="nrp">NRP :</label>
                <input type="text" name="nrp" id="nrp" required>
            </li>
             <li>
                <label for="email">Email :</label>
                <input type="text" name="email" id="email">
             </li>
             <li> 
                <label for="jurusan">Jurusan :</label>
                <input type="text" name="jurusan" id="jurusan">
             </li>
             <li>
                <label for="gambar">Gambar :</label>
                <input type="file" name="gambar" id="gambar">
             </li>
             <br>
             <li>
                <button type="submit" name="submit">Tambah Data!</button>
             </li>
        </ul>



    </form>
    
</body>
</html>