<?php

session_start();

if ( !isset($_SESSION["login"]) || !isset($_SESSION["admin"]) ) {
    header("Location: login.php");
    exit;
}

// include header.php file
include ('header.php');

?>

<?php

/* include products */
include ('Template/_products.php');
/* include products */

/* include top sale section */
include ('Template/_top-sale.php');
/* include top sale section */

/* include add button */
include ('Template/_add_button.php');
/* include add button */

?>

<?php

// include footer.php file
include ('footer.php');

?>