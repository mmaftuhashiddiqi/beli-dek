<?php

function query($query)
{
  global $con;
  $result = mysqli_query($con, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function cari($keyword)
{
  $query = "SELECT * FROM products
				WHERE
			  product_brand LIKE '%$keyword%' OR
			  product_name LIKE '%$keyword%'
			";
  return query($query);
}
