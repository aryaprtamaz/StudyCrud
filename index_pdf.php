<?php
require 'function.php';

$query = "SELECT * FROM mahasiswa";
$mahasiswa = query($query);

?>
<!DOCTYPE html>
<html>
<head> 
    <title>Daftar Mahasiwa</title>
</head>
<body>
    <h1>Daftar Mahasiwa</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
              <th>Gambar</th>
                <th>NRP</th>
               <th>Nama</th>
             <th>Email</th> 
            <th>jurusan</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach($mahasiswa as $jad): ?>
        <tr>
            <td><img src="img/<?= $jad ["gambar"]; ?>"</td>
            <td><?= $jad["nrp"]; ?></td>   
            <td><?= $jad ["nama"]; ?></td>
             <td><?= $jad ["email"]; ?></td>
             <td><?= $jad ["jurusan"]; ?></td>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>