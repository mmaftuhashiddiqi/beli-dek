<?php
    session_start();

    if( !isset($_SESSION["login"]) ) {
	    header("Location: login.php");
	    exit;
    }

    if ( isset($_SESSION['user']) ) {
        header('Location: index.php');
        exit;
    }

    ob_start();
    // include header.php file
    include ('header.php');
?>

<?php
    /* include add product */
    include ('Template/_update_product.php');
    /* include add product */

    if ( isset($_SESSION['user']) ) {
        /* include chart button */
        include ('Template/_cart_button.php');
        /* include chart button */
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