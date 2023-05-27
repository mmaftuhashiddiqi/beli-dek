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
      "SELECT orders.order_id, orders.user_id, orders.product_id, users.user_username, orders.order_date, products.product_brand, products.product_name, products.product_price, orders.product_count, orders.payment_method, orders.delivery_method
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

  public function insertIntoDelivery($order_id)
  {
    if ($order_id) {
      date_default_timezone_set('Asia/Jakarta');
      $datetime = date("Y-m-d H:i:s");

      $dataOrder = "SELECT `user_id`, `product_id`, `product_count`, `payment_method`, `delivery_method`
                FROM `orders` WHERE order_id = {$order_id};";
      $dataOrderResult = $this->db->con->query($dataOrder);

      $query = "";
      foreach ($dataOrderResult as $order) {
        $paymentMethod = "{$order['payment_method']}";
        $deliveryMethod = "{$order['delivery_method']}";

        $query .= "INSERT INTO `deliveries` (`user_id`, `product_id`, `product_count`, `payment_method`, `delivery_method`, `delivery_date`)
                  VALUES ({$order['user_id']}, {$order['product_id']}, {$order['product_count']}, '$paymentMethod', '$deliveryMethod', '$datetime');";
      }

      $query .= "DELETE FROM `orders` WHERE order_id={$order_id};";

      // execute query
      $result = $this->db->con->multi_query($query);

      if ($result) {
        echo "
		      <script>
			      alert('product has been added to on delivery!');
			      document.location.href = 'orders.php';
		      </script>
	      ";
      } else {
        echo "
		      <script>
			      alert('product failed to be added to on delivery!');
			      document.location.href = 'orders.php';
		      </script>
	      ";
      }
      return;
    }
  }

  public function getDataDelivery()
  {
    $result = $this->db->con->query(
      "SELECT deliveries.delivery_id, deliveries.user_id, deliveries.product_id, users.user_username, deliveries.delivery_date, products.product_brand, products.product_name, products.product_price, deliveries.product_count, deliveries.payment_method, deliveries.delivery_method
      FROM deliveries
      INNER JOIN users ON deliveries.user_id = users.user_id
      INNER JOIN products ON deliveries.product_id = products.product_id"
    );

    $resultArray = array();

    // fetch product data one by one
    while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $resultArray[] = $item;
    }

    return $resultArray;
  }
}
