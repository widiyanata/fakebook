<?php

/*
    signup.php
*/
// menampilkan header
require_once 'header.php';

// konsisi error jika user dan atau password kosong
$error = $user = $pass = "";

// jika session dari 'user' masih ada, maka hapus
if ( isset($_SESSION['user'])){
     destroySession();
}

if ( isset($_POST['user'])) {

    $user = sanitizeString( $_POST['user']);
    $pass = sanitizeString( $_POST['pass']);

    if ( $user == "" || $pass == "" ) {
        $error = "Not all fields entered";
    } else {
        $result = queryMysql("SELECT * FROM members WHERE user = '$user'");

        if ( $result->num_rows ) {
            $error = "Account already exist";
        } else {
            queryMysql("INSERT INTO members VALUES('$user', '$pass')");
            die ("<h4>Account created</h4> Please <a href='http://fakebook.dev/login.php'>login</a>");
        }
    }

}

?>
    <div class='main'>
    <h3>Please enter your details to signup</h3>

    <form action='signup.php' method='post'>
        <?php echo $error ?>
        <input type='text' maxlength='16' name='user' value="<?php echo $user ?>" placeholder='Username' onblur='checkUser(this)'>
        <span id='info'></span>
        <input type='text' maxlength='16' name='pass' placeholder='Password' value="<?php echo $pass ?>">
        <input type='submit' value='sign up'>
    </form>
    </div>

    <script src="script.js">
    </script>

</body>
</html>
