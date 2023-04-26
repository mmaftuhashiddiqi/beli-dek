<?php

// require MySQL Connection
require ('database/DBController.php');

// require Product Class
require ('database/Product.php');

// require Cart Class
require ('database/Cart.php');

// require Add Class
require ('database/Add.php');

// require Delete Class
require ('database/Delete.php');

// require Update Class
require ('database/Update.php');

// require Search Class
require ('database/Search.php');


// DBController object
$db = new DBController();

// Product object
$product = new Product($db);
$product_shuffle = $product->getData();

// Cart object
$Cart = new Cart($db );