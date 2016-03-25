<?php

// diakses hampir semua file

# mulai session
session_start();

// HTML5
echo
"
<!doctype html>
<html>
<head>
";

require_once "functions.php";

$userstr = '(Guest)';

if ( isset( $_SESSION['user']) ) {
    $user = $_SESSION['user'];
    $loggedIn = true;
    $userstr = "($user)";
} else {
    $loggedIn = FALSE;
}

echo "
    <title>$appname $userstr</title>
    <link rel='stylesheet' href='style.css' type='text/css'>
    </head>
<body>
    <a href='/' class='logo'>$appname</a>
    <div class='appname'>$appname $userstr</div>
";

if ( $loggedIn ) {
    echo "
    <ul class='menu'>
        <li><a href='members.php?view=$user'>Home</a></li>
        <li><a href='members.php'>Members</a></li>
        <li><a href='friends.php'>Friends</a></li>
        <li><a href='messages.php'>Messages</a></li>
        <li><a href='profile.php'>Edit Profile</a></li>
        <li><a href='logout.php'>Log Out</a></li>
    </ul>
    ";

} else {
    echo "
    <ul class='menu'>
        <li><a href='index.php'>Home</a></li>
        <li><a href='signup.php'>Sign Up</a></li>
        <li><a href='login.php'>Log In</a></li>
    </ul>
    <!-- span class='info'>Please signup or login first</span>-->
    ";
}

?>
