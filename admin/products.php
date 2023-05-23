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
count($product_shuffle) ? include('Template/_products.php') :  include('Template/notFound/_product_notFound.php');
/* include user items if it is not empty */

/* include add button */
// include('Template/_add_button.php');
/* include add button */

?>

<?php

// include footer.php file
include('content-end.php');

?>