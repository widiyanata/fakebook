<?php

require_once "header.php";

$error = $user = $pass = "";
if ( isset($_POST['user']) ) {
  // filter masukan dari pengguna
  $user = sanitizeString($_POST['user']);
  $pass = sanitizeString($_POST['pass']);

  if ( $user == "" || $pass == "" ) {
    $error = "Field tidak boleh kosong";
  } else {
    $result = queryMysql("SELECT user, pass FROM members
      WHERE user='$user' AND pass='$pass'");

      if ( $result->num_rows == 0 ) {
        $error = "<span class='error'>Username atau Password tidak valid</span>";
      } else {
        // menyimpan pengguna di session
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        echo "Anda sudah masuk, <a href='/'>klik disini</a> untuk lanjut.";
        exit();
      }
  }
}

?>

<div class="main">
  <h2>Please Enter Detail to Log in</h2>
  <form class="login" action="login.php" method="post">
    <?= $error ?>
    <input type="text" name="user" value="<?= $user ?>">
    <input type="password" name="pass" value="<?= $pass ?>">
    <input type="submit" value="Login">
  </form>
</div>
</body>
</html>
