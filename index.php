<?php

require_once "header.php";

echo "<h2>Welcome to $appname</h2>";

if ( $loggedIn ) {
    echo "$user, You are login";
    showProfile($user);

} else {
    echo "Please signup or login first";
}

?>

</body>
</html>
