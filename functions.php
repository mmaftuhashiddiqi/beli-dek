<?php

// require MySQL Connection
require('database/DBController.php');

// require Product Class
require('database/Product.php');

// require Cart Class
require('database/Cart.php');

// require Payment Class
require('database/Payment.php');

// require Search Class
require('database/Search.php');

// require Registration Class
require('database/Registration.php');

// require Profile Class
require('database/Profile.php');

// require Convert Class
require('database/Convert.php');


// DBController object
$db = new DBController();

// Product object
$product = new Product($db);
$product_shuffle = $product->getData();

// Cart object
$Cart = new Cart($db);

// Payment object
$payment = new Payment($db);
