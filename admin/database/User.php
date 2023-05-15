<?php

// php user class
class User
{
  public $db = null;

  public function __construct(DBController $db)
  {
    if (!isset($db->con)) return null;
    $this->db = $db;
  }

  // get data admin with condition
  public function getDataUser($table = 'users')
  {
    $result = $this->db->con->query("SELECT * FROM {$table}");

    $resultArray = array();

    // fetch product data one by one
    while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $resultArray[] = $item;
    }

    return $resultArray;
  }
}
