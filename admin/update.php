<?php

session_start();

if (!isset($_SESSION["login"]) || !isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Product</title>

  <?php
  // require library
  require('library/head.php');
  ?>

  <!-- Custom CSS file -->
  <link rel="stylesheet" href="style.css">

  <?php
  // require functions.php file
  require('functions.php');
  ?>
</head>

<body>

  <?php

  /* include add product */
  include('Template/_update_product.php');
  /* include add product */

  /* include add button */
  include('Template/_add_button.php');
  /* include add button */

  // require library
  require('library/body.php');

  ?>

  <!-- Custom Javascript -->
  <script src="script.js"></script>

</body>

</html>