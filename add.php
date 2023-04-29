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
    include ('Template/_add_product.php');
    /* include add product */

    /* include add button */        
    include ('Template/_add_button.php');
    /* include add button */
?>

<?php
    // include footer.php file
    include ('footer.php');
?>