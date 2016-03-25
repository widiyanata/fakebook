<?php

// koneksi ke database
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'socialmedia';
$appname = 'FakeBook';

$koneksi = new mysqli($host, $user, $pass, $db);

if ( $koneksi->connect_error ) die ( $koneksi->connect_error );

/*
*   fungsi
*/

// query ke database
function queryMysql( $query ) {
    global $koneksi;
    $hasil = $koneksi->query($query);
    if (!$hasil) die ( $koneksi->connect_error);

    return $hasil;
}

// Destroy Session - hapus session\
function destroySession() {
    $_SESSION = array();

    if ( session_id() != isset($_COOKIE[session_name()]) ) {
        setcookie( session_name(), '', time()-2592000, '/');
    }

    session_destroy();
}

// sanitize string - menghindari kode atau karakter yg berbahaya
function sanitizeString( $var ) {
    global $koneksi;
    $var = strip_tags( $var );
    $var = htmlentities( $var );
    $var = stripslashes( $var );
    return $koneksi->real_escape_string( $var );
}

// Show Profile - menampilkan detail dari user
function showProfile( $user ) {

  echo "<div class='profile'>";
    if ( file_exists("img/$user.jpg")) {
        echo "<img class='profile' src='img/$user.jpg' >";
    }

    $hasil = queryMysql("SELECT * FROM profiles WHERE user= '$user' ");

    if ( $hasil->num_rows ) {
        $row = $hasil->fetch_array(MYSQLI_ASSOC);
        echo stripslashes($row['text']);
    }

  echo "</div>";
}
