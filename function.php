<?php 
// koneksi ke database
$conn = mysqli_connect("localhost","root","","phpdasar");

function query($query) {

    global $conn;
    $result = mysqli_query($conn, $query);
    $jads = [];
    while ( $jad = mysqli_fetch_assoc($result) ) {
        $jads[] = $jad;
    }
    return $jads;
}

function queryObj($query) {
    
    global $conn;
    $result = mysqli_query($conn, $query);
    $jads = [];
    while ( $jad = mysqli_fetch_object($result) ) {
        $jads[] = $jad;
    }
    return $jads;
}

function tambah($data) {
    global $conn;

             $nama = htmlspecialchars($data["nama"]);
             $nrp = htmlspecialchars($data["nrp"]);
             $email = htmlspecialchars($data["email"]);
             $jurusan = htmlspecialchars($data["jurusan"]);

        //$gambar = htmlspecialchars($data["gambar"]);
        // upload gambar
        $gambar = upload();
        if ( !$gambar) {
            return false;
        }

             
    $query = "INSERT INTO mahasiswa
            VALUES
    ('','$nama', '$nrp', '$email', '$jurusan', '$gambar')
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function upload() {
    
    $namafile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpname = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yg diupload
        if ( $error === 4 ) {
            echo "<script>
            alert('Select gambar LOL');
            </script>";
            return false;
        }

    // cek apakah yg diupload adalah gambar
        $gambarvalid = ['jpg','jpeg','png','jfif'];
        $ektensigambar = explode('.', $namafile); //explode adalah sebuah fungsi untuk memecah sebuah string menjadi array,menggunakan delimiter 
        $ektensigambar = strtolower(end($ektensigambar));
        if ( !in_array($ektensigambar, $gambarvalid) ) {
        echo "<script>
        alert('Not gambar');
        </script>";
        return false;
        }

    // cek jika ukuranya terlalu besar
    if( $ukuranfile > 100000 ){
        echo "<script>
        alert('gambar to big!');
        </script>";
        return false;
    }

        // lolos pengecekan,gambar siap diupload
        // generate nama gambar baru
        $namafilebaru = uniqid();
        $namafilebaru .= '.';
        $namafilebaru .= $ektensigambar;

        move_uploaded_file($tmpname,'img/' . $namafilebaru);
        
        return $namafilebaru;
    }

function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data) {
    global $conn;


    $id = $data["id"]; 
    $nama = htmlspecialchars($data["nama"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambar = htmlspecialchars($data["gambar"]);

    $query = "UPDATE mahasiswa SET
        nama = '$nama',
        nrp = '$nrp',
        email = '$email',
        jurusan = '$jurusan',
        gambar = '$gambar'   
        WHERE id = $id
        ";       

    mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
}


function Serch($keyword){           
    $query = "SELECT * FROM mahasiswa
        WHERE
        nama LIKE '%$keyword%' OR
        nrp LIKE '%$keyword%' OR
        jurusan LIKE '%$keyword%' 
        ";
        return query($query);
}

function registrasi ($data) {
     global $conn;

     $username = strtolower(stripslashes($data ["username"]));
     $password = mysqli_real_escape_string($conn, $data["password"]);
     $password2 = mysqli_real_escape_string($conn, $data ["password2"]);
    
    // cek username sudah ada atau belum
    $result = mysqli_query($conn,"SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert ('username sudah terdaftar!');
        </script>";
        return false;
    }

    //  cek konfirmasi password
    if ( $password != $password2 ) {
        echo "<script>
            alert ('Konfirmasi password tidak sesuai!');
        </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    // password_hash adalah fungsi mengajak string menjadi hash

 
    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);
     
}








?>