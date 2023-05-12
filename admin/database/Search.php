<?php

function cari($keyword) {
	$query = "SELECT * FROM products
				WHERE
			  product_brand LIKE '%$keyword%' OR
			  product_name LIKE '%$keyword%'
			";
	return query($query);
}

function sortedBy($keyword) {
	$query = "SELECT * FROM products
				ORDER BY product_price $keyword
			";
	return query($query);
}

function cariOrder($keyword) {
	$query = "SELECT orders.user_id, orders.product_id, users.user_username, orders.order_date, products.product_brand, products.product_name, products.product_price, orders.product_count
	            FROM orders
    	        INNER JOIN users ON orders.user_id = users.user_id
        	    INNER JOIN products ON orders.product_id = products.product_id
				WHERE
				product_brand LIKE '%$keyword%' OR
				product_name LIKE '%$keyword%' OR
				user_username LIKE '%$keyword%'
			";
	return query($query);
}

function sortedOrderBy($keyword) {
	$query = " SELECT orders.user_id, orders.product_id, users.user_username, orders.order_date, products.product_brand, products.product_name, products.product_price, orders.product_count
	            FROM orders
    	        INNER JOIN users ON orders.user_id = users.user_id
        	    INNER JOIN products ON orders.product_id = products.product_id;
				ORDER BY product.item_price $keyword
			";
	return query($query);
}