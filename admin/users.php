<?php

session_start();

if (!isset($_SESSION["login"]) || !isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit;
}

ob_start();
// include header.php file
include('content-start.php');

?>

<?php

/* include user items if it is not empty */
count($users) ? include('Template/_users.php') :  include('Template/notFound/_user_notFound.php');
/* include user items if it is not empty */

?>

<?php

// include footer.php file
include('content-end.php');

?>