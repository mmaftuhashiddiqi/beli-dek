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
    /* include banner area */
    include ('Template/_banner-area.php');
    /* include banner area */

    /* include top sale section */
    include ('Template/_top-sale.php');
    /* include top sale section */

    /* include special price section */
    include ('Template/_special-price.php');
    /* include special price section */

    /* include banner ads */
    include ('Template/_banner-ads.php');
    /* include banner ads */

    /* include new phones section */
    include ('Template/_new-phones.php');
    /* include new phones section */

    /* include blog area */
    include ('Template/_blogs.php');
    /* include blog area */

    if ( isset($_SESSION['user']) ) {
        /* include cart button */        
        include ('Template/_cart_button.php');
        /* include cart button */
    }

    if ( isset($_SESSION['admin']) ) {
        /* include add button */        
        include ('Template/_add_button.php');
        /* include add button */
    }
?>

<?php
    // include footer.php file
    include ('footer.php');
?>