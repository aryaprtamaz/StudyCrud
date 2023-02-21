<?php
usleep(500000);
require '../function.php';

$keyword = $_GET["keyword"];

$query = "SELECT * FROM mahasiswa
    WHERE
    nama LIKE '%$keyword%' OR
    nrp LIKE '%$keyword%' OR
    jurusan LIKE '%$keyword%' 
    ";
$mahasiswa = query($query);

?>
    <table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No.</th>
         <th>Aksi</th>
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
        <td>
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