<?php
require_once 'header.php';

if (!$loggedIn) die();

if (isset($_GET['view'])) {
  $view = sanitizeString($_GET['view']);
} else {
  $view = $user;
}

if (isset($_POST['text'])) {
  $text = sanitizeString($_POST['text']);

  if ( $text != "") {
    $pm = substr(sanitizeString($_POST['pm']), 0, 1);
    $time = time();
    queryMysql("INSERT INTO messages VALUES(NULL, '$user', '$view', '$pm', $time, '$text')");
  }
}

if ($view != "") {
  if ($view == $user) {
    $name1 = $name2 = "Your";
  } else {
    $name1 = "<a href='members.php?view=$view'>$view</a>";
    $name2 = "$view's";
  }

  echo "<div class='main'><h3>$name1 messages</h3>";
  showProfile($view);

  include 'form-message.php';

  if (isset($_GET['erase'])) {
    $erase = sanitizeString($_GET['erase']);
    queryMysql("DELETE FROM messages WHERE id= $erase AND recip = '$user'");
  }

  $query = "SELECT * FROM messages WHERE recip = '$view' ORDER BY time DESC";
  $result = queryMysql($query);
  $num = $result->num_rows;

  for ($j=0; $j < $num; $j++) {
    $row = $result->fetch_array(MYSQLI_ASSOC);

    if ($row['pm'] == 0 || $row['auth'] == $user || $row['recip'] == $user) {

      $time = date('M jS\' y:ia:', $row['time']);
      $auth = $row['auth'];
      $message = $row['message'];
      $id = $row['id'];


      echo "<div class='messages'>";
      echo $time;
      echo "<a href='messages.php?view=$auth'>$auth</a>";

      if ($row['pm'] == 0) {
        echo " says: &quot; $message &quot; ";
      } else {
        echo "whispered: <span class='whisper'>&quot; $message &quot;</span>";
      }

      if ($row['recip'] == $user ) {
        echo "<a href='messages.php?view=$view&erase=$id'>erase</a>";
      }

      echo "</div>";

    }
  }
}

if (!$num) {
  echo "<a class='btn' href='messages.php?view=$view'>Refresh messages</a>";
}

?>

</div>
</body>
</html>
