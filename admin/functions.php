<?php

// require MySQL Connection
require ('database/DBController.php');

// require Admin Class
require ('database/Admin.php');

// require Product Class
require ('database/Product.php');

// require Cart Class
require ('database/Cart.php');

// require Order Class
require ('database/Order.php');

// require Add Class
require ('database/Add.php');

// require Delete Class
require ('database/Delete.php');

// require Update Class
require ('database/Update.php');

// require Search Class
require ('database/Search.php');

// require Registration Class
require ('database/Registration.php');


// DBController object
$db = new DBController();

// Admin object
$admin = new Admin($db);

// Product object
$product = new Product($db);
$product_shuffle = $product->getData();

// Cart object
$Cart = new Cart($db );

// Order object
$order = new Order($db);
$orders = $order->getDataOrder();