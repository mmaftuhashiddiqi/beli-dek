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