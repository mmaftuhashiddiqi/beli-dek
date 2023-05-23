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
count($orders) ? include('Template/_orders.php') :  include('Template/notFound/_order_notFound.php');
/* include order items if it is not empty */

?>

<?php

// include footer.php file
include('content-end.php');

?>