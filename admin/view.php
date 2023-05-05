<?php

session_start();

if ( !isset($_SESSION["login"]) || !isset($_SESSION["admin"]) ) {
    header("Location: login.php");
    exit;
}

ob_start();
// include header.php file
include ('header.php');

?>

<?php

/* include top sale section */
include ('Template/_top-sale.php');
/* include top sale section */

/* include special price section */
include ('Template/_special-price.php');
/* include special price section */

/* include new phones section */
include ('Template/_new-phones.php');
/* include new phones section */

/* include add button */        
include ('Template/_add_button.php');
/* include add button */

?>

<?php

// include footer.php file
include ('footer.php');

?>