<?php

// Use to fetch product data
class Product
{
  public $db = null;

  public function __construct(DBController $db)
  {
    if (!isset($db->con)) return null;
    $this->db = $db;
  }

  // fetch product data using getData Method
  public function getData($table = 'products')
  {
    $result = $this->db->con->query("SELECT * FROM {$table}");

    $resultArray = array();

    // fetch product data one by one
    while ($product = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $resultArray[] = $product;
    }

    return $resultArray;
  }

  // get product using product id
  public function getProduct($product_id = null, $table = 'products')
  {
    if (isset($product_id)) {
      $result = $this->db->con->query("SELECT * FROM {$table} WHERE product_id={$product_id}");

      $resultArray = array();

      // fetch product data one by one
      while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $resultArray[] = $item;
      }

      return $resultArray;
    }
  }
}
