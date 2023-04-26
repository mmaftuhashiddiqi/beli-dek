<?php

function cari($keyword) {
	$query = "SELECT * FROM product
				WHERE
			  item_brand LIKE '%$keyword%' OR
			  item_name LIKE '%$keyword%'
			";
	return query($query);
}