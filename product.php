<?php

session_start();

if ( !isset($_SESSION["login"]) || !isset($_SESSION["user"]) ) {
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
include ('Template/_top_sale.php');
/* include top sale section */

/* include cart button */        
include ('Template/_cart_button.php');
/*  include cart button  */

?>

<?php

// include footer.php file
include ('footer.php');

?>