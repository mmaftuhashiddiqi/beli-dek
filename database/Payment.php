<?php

// php payment class
class Payment
{
  public $db = null;

  public function __construct(DBController $db)
  {
    if (!isset($db->con)) return null;
    $this->db = $db;
  }

  // get payment method
  public function getPaymentMethod($product_id)
  {
    $resultStr = $this->db->con->query("SELECT `payment_method` FROM `products` WHERE `product_id` = {$product_id}");
    $resultArr = json_decode($resultStr);
    return $resultArr;
  }

  // fetch cart data using getDataCart Method
  public function getDataPayment($table = 'payments')
  {
    $userId = $_SESSION["user"];
    $result = $this->db->con->query("SELECT * FROM {$table} WHERE user_id = $userId");

    $resultArray = array();

    // fetch product data one by one
    while ($product = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $resultArray[] = $product;
    }

    return $resultArray;
  }

  // calculate sub total
  public function getSumPrice($priceCol = 'product_price', $amountCol = 'product_count', $table = 'payments')
  {
    $userId = $_SESSION["user"];
    $result = $this->db->con->query("SELECT {$table}.user_id, {$table}.product_id, products.{$priceCol}, {$table}.{$amountCol} FROM {$table} INNER JOIN products ON {$table}.product_id = products.product_id WHERE user_id = {$userId}");

    $resultArray = array();

    // fetch product data one by one
    while ($product = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $resultArray[] = $product;
    }

    $sumPrice = 0;
    foreach ($resultArray as $price) {
      $sumPrice += $price[$priceCol] * $price[$amountCol];
    }
    return $sumPrice;
  }

  // proceed to buy
  public function proceedToBuy($user_id = null, $payment_method = null)
  {
    if ($user_id != null && $payment_method != null) {
      date_default_timezone_set('Asia/Jakarta');
      $datetime = date("Y-m-d H:i:s");

      $dataCart = "SELECT `user_id`, `product_id`, `product_count`, `payment_method` FROM `payments` WHERE user_id={$user_id};";
      $dataCartResult = $this->db->con->query($dataCart);

      $result = "";
      foreach ($dataCartResult as $cart) {
        $result .= "INSERT INTO `orders` (`order_date`, `user_id`, `product_id`, `product_count`, `payment_method`)
                    VALUES ('$datetime', {$cart['user_id']}, {$cart['product_id']}, {$cart['product_count']}, '$payment_method');";
      }

      $result .= "DELETE FROM `payments` WHERE user_id={$user_id};";

      // execute query
      $result = $this->db->con->multi_query($result);

      if ($result) {
        header("Location: index.php");
      }
      return;
    }
  }
}
