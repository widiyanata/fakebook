<?php
require "header.php";

if ( isset($_SESSION['user']) ) {
  destroySession();

  echo "Anda sudah log out.. <a href='/'>refresh</a>";
}
?>
</body>
</html>
