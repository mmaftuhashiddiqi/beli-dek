<?php

// php comment class
class Comment
{
  public $db = null;

  public function __construct(DBController $db)
  {
    if (!isset($db->con)) return null;
    $this->db = $db;
  }

  // get comment function
  public function getComments($product_id = null)
  {
    if ($product_id != null) {
      $result = $this->db->con->query(
        "SELECT users.user_username, users.user_fullname, comments.comment_content, comments.comment_date
        FROM `comments` 
        INNER JOIN `users` ON comments.user_id = users.user_id
        WHERE product_id = {$product_id}"
      );

      $resultArray = array();

      // fetch product data one by one
      while ($product = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $resultArray[] = $product;
      }

      return $resultArray;
    }
  }

  // add comment function
  public function addComment($data)
  {
    if ($data != null) {
      date_default_timezone_set('Asia/Jakarta');
      $datetime = date("Y-m-d H:i:s");

      $userId = $data["user_id"];
      $productId = $data["product_id"];
      $commentContent = htmlspecialchars($data["inputComment"]);

      $query = "INSERT INTO `comments` (`user_id`, `product_id`, `comment_content`, `comment_date`)
      VALUES ('$userId', '$productId', '$commentContent', '$datetime')";

      $result = $this->db->con->query($query);

      if ($result) {
        header("Location: product.php?product_id={$productId}");
      }

      return;
    }
  }
}
