<?php
session_start();
require 'function.php';

// cek cookie
// fitur di browser = cookie
//cookie = seperti session ( informasi yang bisa dikases dimana saja di dalam web ) tapi cookie disimpan di browser/client, kalau sedsion informasinya disimpan di server ( tidak bisa diakses ),client bisa mengubah informasi dari cookie seperti diedit dan diubah dll
//cookie bisa digunakan untuk mengenali user ( browser bisa tahu siapa user yang login atau mengakses sebuah halaman  tertentu)
//fitur shopping cart ( ke halaman barang berikutnya tanpa menghilangkan barang belanjaan di dalam shopping cart ),
//untuk personalisasi = mengethaui perilaku/preferensi dari user ( digunakaan untuk iklan seprrrti facebook yang iklanya mirip dengan barang yang sama yang dicari oleh user di market place lain, sama dengan recomendation user karena menggunakan cookie)
//$_cookie = mengakses nilai cookie di browser
if ( isset($_COOKIE['id']) && isset($_COOKIE['key']) ){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn,"SELECT username FROM user WHERE id = $id" );
    $jad = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if( $key === hash('sha256', $jad['username']) ) {
        $_SESSION['login'] = true;
    }

}

if(isset($_SESSION["login"]) ) {
    header("location: index.php");
    exit;
}

if(isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn,"SELECT * FROM user WHERE username = '$username'" );


    // cek username
    if( mysqli_num_rows($result) === 1 ) {// mysqli_num_rows() adalah cek apakah ada barisan yg dikembalikan query $result,dan jika hasil nya sama dengan 1 berarti ada
    
        
        // cek password
        // dengan cara mengambil password dari dalam database berdasarkan user,jika tidak ada maka keluar dari if()
        $jad = mysqli_fetch_assoc($result);
        //password_verify adalah mengecek sebuah string mengecek sama tidak dgn hashnya,jika sama passwordnya benar/truer
        if(password_verify($password, $jad["password"]) ) {
            // set session
            $_SESSION["login"] = true;

            // cek remember me
            if (isset($_POST['remember'])) {
                // buat cookie
                
                setcookie('id', $jad['id'], time()+60);
                setcookie('key', hash('sha256', $jad['username']),time()+60);
            }


            header("location: index.php");
            exit;
        }
    }

        $error = true;

}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Halaman Login</title>
</head>
<body>
    
    <h1>Halaman Login</h1>

    <?php if(isset($error)) : ?>
        <p style="color: crimson; font-style:italic" >Username / Password salah</p>
    <?php endif; ?>

    <form action="" method="post">
    <ul>
        <li>
            <label for="username">Username :</label>
            <input type="text" name="username" id="username">
        </li>
        <li>
            <label for="password">Password :</label>
            <input type="password" name="password" id="password">
        </li>
        <li>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember me </label>
        </li>
        <li>
            <button type="submit" name="login">Login</button>
        </li>
    </ul>

    </form>



</body>
</html>