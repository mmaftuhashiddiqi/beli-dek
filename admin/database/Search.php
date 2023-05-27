<?php

function cari($keyword)
{
  $query = "SELECT * FROM products
				WHERE
			  product_brand LIKE '%$keyword%' OR
			  product_name LIKE '%$keyword%'
			";
  return query($query);
}

function sortedBy($keyword)
{
  $query = "SELECT * FROM products
				ORDER BY product_price $keyword
			";
  return query($query);
}

function cariOrder($keyword)
{
  $query = "SELECT orders.order_id, orders.user_id, orders.product_id, users.user_username, orders.order_date, products.product_brand, products.product_name, products.product_price, orders.product_count, orders.payment_method, orders.delivery_method
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

function sortedOrderBy($keyword)
{
  $query = " SELECT orders.order_id, orders.user_id, orders.product_id, users.user_username, orders.order_date, products.product_brand, products.product_name, products.product_price, orders.product_count, orders.payment_method, orders.delivery_method
	FROM orders
		INNER JOIN users ON orders.user_id = users.user_id
		INNER JOIN products ON orders.product_id = products.product_id 
	ORDER BY products.product_price $keyword
	";
  return query($query);
}

function cariDelivery($keyword) {
	$query = "SELECT deliveries.delivery_id, deliveries.user_id, deliveries.product_id, users.user_username, deliveries.delivery_date, products.product_brand, products.product_name, products.product_price, deliveries.product_count, deliveries.payment_method, deliveries.delivery_method
		FROM deliveries
		INNER JOIN users ON deliveries.user_id = users.user_id
		INNER JOIN products ON deliveries.product_id = products.product_id 
	WHERE
		product_brand LIKE '%$keyword%' OR
		product_name LIKE '%$keyword%' OR
		user_username LIKE '%$keyword%'
	";
  return query($query);
}

function sortedDeliveryBy($keyword)
{
  $query = "SELECT deliveries.delivery_id, deliveries.user_id, deliveries.product_id, users.user_username, deliveries.delivery_date, products.product_brand, products.product_name, products.product_price, deliveries.product_count, deliveries.payment_method, deliveries.delivery_method
		FROM deliveries
		INNER JOIN users ON deliveries.user_id = users.user_id
		INNER JOIN products ON deliveries.product_id = products.product_id 
	ORDER BY products.product_price $keyword
	";
  return query($query);
}

function cariUser($keyword)
{
  $query = "SELECT users.user_fullname, users.user_username, users.user_phone, users.user_address
				FROM users
				WHERE
				user_fullname LIKE '%$keyword%' OR
				user_username LIKE '%$keyword%' OR
				user_phone LIKE '%$keyword%' OR
				user_address LIKE '%$keyword%'";
  return query($query);
}
