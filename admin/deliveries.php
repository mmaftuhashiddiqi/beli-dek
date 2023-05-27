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

/* include order items if it is not empty */
count($deliveries) ? include('Template/_deliveries.php') :  include('Template/notFound/_delivery_notFound.php');
/* include order items if it is not empty */

?>

<?php

// include footer.php file
include('content-end.php');

?>