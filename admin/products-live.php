<?php

session_start();

if (!isset($_SESSION["login"]) || !isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit;
}

?>

<?php

/* include product live */
include('Template/_products_live.php');
/* include product live */

?>