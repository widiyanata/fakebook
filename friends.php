<?php
require_once 'header.php';

if ( !$loggedIn ) {
  die();
}

if ( isset($_GET['view'])) {
  $view = sanitizeString($_GET['view']);
} else {
  $view = $user;
}

if ( $view == $user ) {
  $name1 = $name2 = "Your";
  $name3 = "You are";
} else {
  $name1 = "<a href='members.php?view=$view'>$view</a>'s";
  $name2 = "$view's";
  $name3 = "$view is";
}
// open main div
echo "<div class='main'>";

showProfile($view);

$followers = array();
$following = array();

$result = queryMysql("SELECT * FROM friends WHERE user = '$view'");
$num = $result->num_rows;

for ($j = 0; $j < $num; $j++) {
  $row = $result->fetch_array(MYSQLI_ASSOC);
  $followers[$j] = $row['friend'];
}

$result = queryMysql("SELECT * FROM friends WHERE friend = '$view'");
$num = $result->num_rows;

for ($j = 0; $j < $num; $j++) {
  $row = $result->fetch_array(MYSQLI_ASSOC);
  $following[$j] = $row['user'];
}

$mutual = array_intersect($followers, $following);
$followers = array_diff($followers, $mutual);
$following = array_diff($following, $mutual);
$friends = FALSE;

if (sizeof($mutual)) {
  echo "<br><span class=''>$name2 mutual friends</span>";
  echo "<ul>";
  foreach ($mutual as $friend) {
    echo "<li><a href='members.php?view=$friend'>$friend</a>";
  }
  echo "</ul>";
  $friends = TRUE;
}

if (sizeof($followers)) {
  echo "<br><span class=''>$name2 followers</span>";
  echo "<ul>";
  foreach ($followers as $friend) {
    echo "<li><a href='members.php?view=$friend'>$friend</a>";
  }
  echo "</ul>";
  $friends = TRUE;
}

if (sizeof($following)) {
  echo "<br><span class=''>$name3 following</span>";
  echo "<ul>";
  foreach ($following as $friend) {
    echo "<li><a href='members.php?view=$friend'>$friend</a>";
  }
  echo "</ul>";
  $friends = TRUE;
}

if (!$friends) {
  echo "You don't have any friends yet.";
}

echo "<a class='btn' href='messages.php?view=$view'>" . "View $name2 messages</a>";

?>

<!-- close .main  -->
</div>
</body>
</html>
