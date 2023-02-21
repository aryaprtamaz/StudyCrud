<?php
session_start();
if ( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}

// koneksi ke database
require 'function.php';

// ambil data dari tabel mahasiswa / query data mahasiswa
$mahasiswa = query("SELECT * FROM mahasiswa");

// tombol cari ditekan
if (isset($_POST["Serch"])) {
    $mahasiswa = Serch($_POST["keyword"]);
}

// ambil data (feth) mahasiswa dari objek result 
// mysqli_fetch_row() // mengembalikan array numerik,memakai angka[1];
// mysqli-fetch_assoc() // mengembalikan array associative memakai variable/stirng [""];
// mysqli_fetch_array() // bisa memakai angka atau variable/string ["sting"] [angka],kekurangan nya data yg disajikan double 
// mysqli_fetch_object() //

//  while ($mhs = mysqli_fetch_assoc($result) ) {
    // var_dump($mhs["nama"]);
//  }
// 
// ketika kita melakukan query mysql query akan mengembalikan 2 hal jika berhasil maka query akan dilakukan dan mengembalikan nilai true jika gagal maka fungsi ini tidak akan menjalankan query tapi mengembalikan nilai false

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hallo</title>
    <style>
        .loader {
            width: 25px;
            position: absolute;
            top: 140px;
            left: 185px;
            z-index: -1;
            display: none;
        }

        @media print{
            .logout, .tambah, .form-cari, .aksi{
                display: none;
            }
        }
    </style>
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>

    <a href="logout.php" class="logout">Logout</a> | <a href="cetak.php" target="_blank">Cetak</a>

    <h1>Daftar mahasiswa</h1>
    <a href="tambah.php" class="tambah" >Tambah data mahasiswa</a>
    <br></br>

    <form action="" method="post" class="form-serch" >
    <input type="text" name="keyword" size="20" autofocus placeholder="Serch keyword.." autocomplete="off" id="keyword">
    <button type="submit" name="Serch" id="tombol-serch">Serch</button>

    <img src="img/loader.gif" class="loader" >

    </form>
    <br>
    <div id="container"> 
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No.</th>
         <th class="aksi" >Aksi</th>
          <th>Gambar</th>
            <th>NRP</th>
           <th>Nama</th>
         <th>Email</th>
        <th>jurusan</th>
    </tr>
    <?php $i =1; ?>
    <?php foreach($mahasiswa as $jad) : ?>
        <tr>
        <td><?= $jad ["id"]; ?></td>
        <td class="aksi" >
            <a href="ubah.php?id=<?= $jad["id"]; ?>">edit</a> | 
            <a href="hapus.php?id=<?= $jad["id"]; ?>" onclick="return confirm('yakin?')">delete</a>
        </td>
        <td><img src="img/<?= $jad ["gambar"]; ?>" width="70"></td>
        <td><?= $jad["nrp"]; ?></td>   
        <td><?= $jad ["nama"]; ?></td>
        <td><?= $jad ["email"]; ?></td>
        <td><?= $jad ["jurusan"]; ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
</table>
    </div>

</body>
</html>