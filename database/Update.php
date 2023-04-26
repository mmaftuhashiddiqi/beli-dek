<?php

function ubah($data) {
	global $con;

	$id = $data["id"];
	$brandName = htmlspecialchars($data["inputBrandName"]);
    $productName = htmlspecialchars($data["inputProductName"]);
    $productPrice = htmlspecialchars($data["inputProductPrice"]);
	$productImageOld = htmlspecialchars($data["inputProductImageOld"]);
	
	// cek apakah user pilih gambar baru atau tidak
	if( $_FILES['inputProductImage']['error'] === 4 ) {
		$productImage = $productImageOld;
	} else {
		$productImage = upload();
	}

	$query = "UPDATE product SET
				item_brand = '$brandName',
				item_name = '$productName',
				item_price = '$productPrice',
				item_image = '$productImage'
			  WHERE item_id = $id;
			";

	mysqli_query($con, $query);

	return mysqli_affected_rows($con);	
}