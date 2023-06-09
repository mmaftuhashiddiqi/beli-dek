<?php

$con = mysqli_connect("localhost", "root", "", "ecommerce");

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

function tambah($data)
{
  global $con;

  $brandName = htmlspecialchars($data["inputBrandName"]);
  $productName = htmlspecialchars($data["inputProductName"]);
  $productDesc = htmlspecialchars($data["inputProductDesc"]);
  $productStock = htmlspecialchars($data["inputProductStock"]);
  $productPrice = htmlspecialchars($data["inputProductPrice"]);
  $paymentMethod = $data["inputPaymentMethod"];
  $deliveryMethod = $data["inputDeliveryMethod"];

  // json encode payment method
  $paymentMethodStr = json_encode($paymentMethod);

  // json encode delivery method
  $deliveryMethodStr = json_encode($deliveryMethod);

  // upload gambar
  $productImage = upload();
  if (!$productImage) {
    return false;
  }

  $query = "INSERT INTO products (product_brand, product_name, product_desc, product_stock, product_price, payment_method, delivery_method, product_image)
                VALUES
                ('$brandName', '$productName', '$productDesc', '$productStock', '$productPrice', '$paymentMethodStr', '$deliveryMethodStr', '$productImage')
            ";
  mysqli_query($con, $query);

  return mysqli_affected_rows($con);
}

function upload()
{
  $namaFile = $_FILES['inputProductImage']['name'];
  $ukuranFile = $_FILES['inputProductImage']['size'];
  $error = $_FILES['inputProductImage']['error'];
  $tmpName = $_FILES['inputProductImage']['tmp_name'];

  // cek apakah tidak ada gambar yang diupload
  if ($error === 4) {
    echo "<script>
                alert('pilih gambar terlebih dahulu!');
              </script>";
    return false;
  }

  // cek apakah yang diupload adalah gambar
  $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    echo "<script>
                alert('yang anda upload bukan gambar!');
              </script>";
    return false;
  }

  // cek jika ukurannya terlalu besar
  if ($ukuranFile > 2000000) {
    echo "<script>
                alert('ukuran gambar terlalu besar!');
              </script>";
    return false;
  }

  // lolos pengecekan, gambar siap diupload
  // generate nama gambar baru
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiGambar;

  move_uploaded_file($tmpName, './../assets/products/' . $namaFileBaru);

  return $namaFileBaru;
}
