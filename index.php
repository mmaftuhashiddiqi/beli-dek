<?php

session_start();

if (!isset($_SESSION["login"]) || !isset($_SESSION["user"])) {
  header("Location: login.php");
  exit;
}

ob_start();
// include header.php file
include('header.php');

?>

<?php

/* include banner area */
include('Template/_banner_area.php');
/* include banner area */

/* include top sale section */
include('Template/_top_sale.php');
/* include top sale section */

/* include special price section */
include('Template/_special_price.php');
/* include special price section */

/* include banner ads */
include('Template/_banner_ads.php');
/* include banner ads */

/* include new phones section */
include('Template/_new_phones.php');
/* include new phones section */

/* include blog area */
include('Template/_blogs.php');
/* include blog area */

/* include cart button */
include('Template/_cart_button.php');
/* include cart button */

?>

<?php

// include footer.php file
include('footer.php');

?>