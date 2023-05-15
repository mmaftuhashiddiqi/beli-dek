<?php

// require MySQL Connection
require('database/DBController.php');

// require Product Class
require('database/Product.php');

// require Cart Class
require('database/Cart.php');

// require Search Class
require('database/Search.php');

// require Registration Class
require('database/Registration.php');

// require View Class
require('database/View.php');

// require Profile Class
require('database/Profile.php');


// DBController object
$db = new DBController();

// Product object
$product = new Product($db);
$product_shuffle = $product->getData();

// Cart object
$Cart = new Cart($db);
