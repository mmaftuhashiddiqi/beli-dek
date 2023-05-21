<?php

session_start();

if (!isset($_SESSION["login"]) || !isset($_SESSION["user"])) {
  header("Location: login.php");
  exit;
}

ob_start();
// include header.php file
include('header.php');

?>

<?php

/* include payment items if it is not empty */
count($payment->getDataPayment()) ? include('Template/_payments.php') :  include('Template/notFound/_payment_notFound.php');
/* include payment items if it is not empty */

?>

<?php

// include footer.php file
include('footer.php');

?>