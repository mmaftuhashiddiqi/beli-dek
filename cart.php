<?php
    session_start();

    if( !isset($_SESSION["login"]) ) {
	    header("Location: login.php");
	    exit;
    }

    ob_start();
    // include header.php file
    include ('header.php');
?>

<?php
    /* include cart items if it is not empty */
    count($product->getData('cart')) ? include ('Template/_cart-template.php') :  include ('Template/notFound/_cart_notFound.php');
    /* include cart items if it is not empty */

    /* include top sale section */
    include ('Template/_new-phones.php');
    /* include top sale section */

    /*  include cart button  */        
    include ('Template/_cart_button.php');
    /*  include cart button  */

    /*  include add button  */        
    include ('Template/_add_button.php');
    /*  include add button  */
?>

<?php
    // include footer.php file
    include ('footer.php');
?>