<?php
require_once 'dompdf/autoload.inc.php';  

use Dompdf\Dompdf;
$dompdf = new Dompdf();
require 'function.php';
$query = "SELECT * FROM mahasiswa";
$mahasiswa = queryObj($query);

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$jads = '';
foreach($mahasiswa as $key => $jad) {
    $key++;
    $jads .= '<tr>
    <td>'.$key.'</td>
    <td> <img src="img/'. $jad-> gambar .'"> </td>
    <td>'.$jad->nrp.'</td>   
    <td>'.$jad->nama.'</td>
     <td>'.$jad->email.'</td>
     <td>'.$jad->jurusan.'</td>
    </td>
</tr>';
}

$html = "<!DOCTYPE html>
<html>
<head> 
    <title>Daftar Mahasiwa</title>
</head>
<body>
    <h1>Daftar Mahasiwa</h1>
    <table border='1' cellpadding='10' cellspacing='0'>
        <tr>
            <th>No.</th>
              <th>Gambar</th>
                <th>NRP</th>
               <th>Nama</th>
             <th>Email</th> 
            <th>jurusan</th>
        </tr>
            $jads
    </table>
</body>
</html>";


$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();
ob_end_clean();
// Output the generated PDF to Browser
$dompdf->stream('test.pdf');
  
?>