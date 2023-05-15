<?php

class Order
{
  public $db = null;

  public function __construct(DBController $db)
  {
    if (!isset($db->con)) return null;
    $this->db = $db;
  }

  // fecth order data using getDataOrder Method
  public function getDataOrder()
  {
    $result = $this->db->con->query(
      "SELECT orders.user_id, orders.product_id, users.user_username, orders.order_date, products.product_brand, products.product_name, products.product_price, orders.product_count
            FROM orders
            INNER JOIN users ON orders.user_id = users.user_id
            INNER JOIN products ON orders.product_id = products.product_id"
    );

    $resultArray = array();

    // fetch product data one by one
    while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $resultArray[] = $item;
    }

    return $resultArray;
  }
}
