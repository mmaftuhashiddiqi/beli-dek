<?php

function hapus($id)
{
  global $con;

  $cart = mysqli_query($con, "SELECT * FROM carts WHERE product_id = $id");
  if (mysqli_num_rows($cart) >= 1) {
    mysqli_query($con, "DELETE FROM carts WHERE product_id = $id");
  }

  $wishlist = mysqli_query($con, "SELECT * FROM wishlists WHERE product_id = $id");
  if (mysqli_num_rows($wishlist) >= 1) {
    mysqli_query($con, "DELETE FROM wishlists WHERE product_id = $id");
  }

  $payment = mysqli_query($con, "SELECT * FROM payments WHERE product_id = $id");
  if (mysqli_num_rows($payment) >= 1) {
    mysqli_query($con, "DELETE FROM payments WHERE product_id = $id");
  }

  $order = mysqli_query($con, "SELECT * FROM orders WHERE product_id = $id");
  if (mysqli_num_rows($order) >= 1) {
    mysqli_query($con, "DELETE FROM orders WHERE product_id = $id");
  }

  mysqli_query($con, "DELETE FROM products WHERE product_id = $id");

  return mysqli_affected_rows($con);
}

function hapusOrder($productId, $userId)
{
  global $con;
  mysqli_query($con, "DELETE FROM orders WHERE product_id = $productId AND user_id = $userId");
  return mysqli_affected_rows($con);
}
