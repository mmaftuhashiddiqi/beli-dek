<?php

session_start();

if (!isset($_SESSION["login"]) || !isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit;
}

?>

<?php

/* include order live */
include('Template/_orders_live.php');
/* include order live */

?>