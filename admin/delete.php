<?php

session_start();

if (!isset($_SESSION["login"]) || !isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit;
}

?>

<?php

/* include delete product */
include('Template/_delete_product.php');
/* include delete product */

?>