<?php
    ob_start();
    // include header.php file
    include ('header.php');
?>

<?php
    /* include add product */
    include ('Template/_update_product.php');
    /* include add product */
    
    /* include chart button */
    include ('Template/_cart_button.php');
    /* include chart button */
    
    /*  include add button  */        
    include ('Template/_add_button.php');
    /*  include add button  */
?>

<?php
    // include footer.php file
    include ('footer.php');
?>