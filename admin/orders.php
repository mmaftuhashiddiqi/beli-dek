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

/* include product list */
include('Template/_orders.php');
/* include product list */

?>

<?php

// include footer.php file
include('content-end.php');

?>