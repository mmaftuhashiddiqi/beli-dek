<?php

session_start();

if (!isset($_SESSION["login"]) || !isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit;
}

?>

<?php

/* include delete order */
include('Template/_delete_order.php');
/* include delete order */

?>