<?php

/*
    checkuser.php

    cek apakah user sudah ada atau belum
*/

require_once "functions.php";

if ( isset( $_POST['user'])) {
    $user = sanitizeString($_POST['user']);
    $result = queryMysql("SELECT * FROM members WHERE user='$user'");

    if ( $result->num_rows ) {
        echo "<span class='taken'> This username already taken</span>";
    } else {
        echo "<span class='available' >This username is available</span>";
    }
}
