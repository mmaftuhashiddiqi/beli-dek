<?php

function cari($keyword) {
	$query = "SELECT * FROM product
				WHERE
			  item_brand LIKE '%$keyword%' OR
			  item_name LIKE '%$keyword%'
			";
	return query($query);
}

function sortedBy($keyword) {
	$query = "SELECT * FROM product
				ORDER BY item_price $keyword
			";
	return query($query);
}

function cariOrder($keyword) {
	$query = " SELECT orders.user_id, orders.item_id, user.username, product.item_brand, product.item_name, product.item_price
				FROM orders
				INNER JOIN user ON orders.user_id = user.user_id
				INNER JOIN product ON orders.item_id = product.item_id
				WHERE
				item_brand LIKE '%$keyword%' OR
				item_name LIKE '%$keyword%' OR
				username LIKE '%$keyword%'
			";
	return query($query);
}

function sortedOrderBy($keyword) {
	$query = " SELECT orders.user_id, orders.item_id, user.username, product.item_brand, product.item_name, product.item_price
				FROM orders
				INNER JOIN user ON orders.user_id = user.user_id
				INNER JOIN product ON orders.item_id = product.item_id
				ORDER BY product.item_price $keyword
			";
	return query($query);
}