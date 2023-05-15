<?php

// require MySQL Connection
require('../database/DBController.php');

// require Product Class
require('../database/Product.php');

// require Cart Class
require('../database/Cart.php');

// DBController object
$db = new DBController();

// Product object
$product = new Product($db);

// Cart object
$Cart = new Cart($db);

if (isset($_POST['itemid'])) {
  $result = $product->getProduct($_POST['itemid']);
  echo json_encode($result);
}
