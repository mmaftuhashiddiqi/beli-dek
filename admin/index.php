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

/* include dashboard */
include('Template/_dashboard.php');
/* include dashboard */

/* include statistics */
include('Template/_statistics.php');
/* include statistics */

?>

<?php

// include footer.php file
include('content-end.php');

?>