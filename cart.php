<?php

session_start();

if ( !isset($_SESSION["login"]) || !isset($_SESSION["user"]) ) {
    header("Location: login.php");
    exit;
}

ob_start();
// include header.php file
include ('header.php');

?>

<?php

/* include cart items if it is not empty */
count($Cart->getDataCart('cart')) ? include ('Template/_cart_template.php') :  include ('Template/notFound/_cart_notFound.php');
/* include cart items if it is not empty */

/* include top sale section */
count($Cart->getDataCart('wishlist')) ? include ('Template/_wishilist_template.php') :  include ('Template/notFound/_wishlist_notFound.php');
/* include top sale section */

/* include top sale section */
include ('Template/_new_phones.php');
/* include top sale section */

/* include cart button */        
include ('Template/_cart_button.php');
/* include cart button */

?>

<?php

// include footer.php file
include ('footer.php');

?>