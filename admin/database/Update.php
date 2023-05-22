<?php

function ubah($data)
{
  global $con;

  $id = $data["id"];
  $brandName = htmlspecialchars($data["inputBrandName"]);
  $productName = htmlspecialchars($data["inputProductName"]);
  $productDesc = htmlspecialchars($data["inputProductDesc"]);
  $productStock = htmlspecialchars($data["inputProductStock"]);
  $productPrice = htmlspecialchars($data["inputProductPrice"]);
  $paymentMethod = $data["inputPaymentMethod"];
  $productImageOld = htmlspecialchars($data["inputProductImageOld"]);

  // json encode payment method
  $paymentMethodStr = json_encode($paymentMethod);

  // cek apakah user pilih gambar baru atau tidak
  if ($_FILES['inputProductImage']['error'] === 4) {
    $productImage = $productImageOld;
  } else {
    $productImage = upload();
  }

  $query = "UPDATE products SET
				product_brand = '$brandName',
				product_name = '$productName',
        product_desc = '$productDesc',
				product_stock = '$productStock',
				product_price = '$productPrice',
        payment_method = '$paymentMethodStr',
				product_image = '$productImage'
			  WHERE product_id = $id;
			";

  mysqli_query($con, $query);

  return mysqli_affected_rows($con);
}
