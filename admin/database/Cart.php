<?php

// php cart class
class Cart
{
  public $db = null;

  public function __construct(DBController $db)
  {
    if (!isset($db->con)) return null;
    $this->db = $db;
  }

  // insert into carts table
  public  function insertIntoCart($params = null, $table = "carts")
  {
    if ($this->db->con != null) {
      if ($params != null) {
        // "Insert into carts(user_id) values (0)"
        // get table columns
        $columns = implode(',', array_keys($params));

        $values = implode(',', array_values($params));

        // create sql query
        $query_string = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);

        // execute query
        $result = $this->db->con->query($query_string);
        return $result;
      }
    }
  }

  // to get user_id and product_id and insert into carts table
  public  function addToCart($userid, $productid)
  {
    if (isset($userid) && isset($productid)) {
      $params = array(
        "user_id" => $userid,
        "product_id" => $productid
      );

      // insert data into carts
      $result = $this->insertIntoCart($params);
      if ($result) {
        // Reload Page
        header("Location: " . $_SERVER['PHP_SELF']);
      }
    }
  }

  // delete cart product using cart product id
  public function deleteCart($product_id = null, $table = 'carts')
  {
    if ($product_id != null) {
      $result = $this->db->con->query("DELETE FROM {$table} WHERE product_id={$product_id}");
      if ($result) {
        header("Location:" . $_SERVER['PHP_SELF']);
      }
      return $result;
    }
  }

  // calculate sub total
  public function getSum($arr)
  {
    if (isset($arr)) {
      $sum = 0;
      foreach ($arr as $product) {
        $sum += floatval($product[0]);
      }
      return sprintf('%.2f', $sum);
    }
  }

  // get product_id of shopping cart list
  public function getCartId($cartArray = null, $key = "product_id")
  {
    if ($cartArray != null) {
      $cart_id = array_map(function ($value) use ($key) {
        return $value[$key];
      }, $cartArray);
      return $cart_id;
    }
  }

  // Save for later
  public function saveForLater($product_id = null, $saveTable = "wishlists", $fromTable = "carts")
  {
    if ($product_id != null) {
      $query = "INSERT INTO {$saveTable} SELECT * FROM {$fromTable} WHERE product_id={$product_id};";
      $query .= "DELETE FROM {$fromTable} WHERE product_id={$product_id};";

      // execute multiple query
      $result = $this->db->con->multi_query($query);

      if ($result) {
        header("Location :" . $_SERVER['PHP_SELF']);
      }
      return $result;
    }
  }
}
