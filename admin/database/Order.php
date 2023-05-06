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
    public function getDataOrder(){
        $result = $this->db->con->query(
            "SELECT orders.user_id, orders.item_id, user.username, product.item_brand, product.item_name, product.item_price
            FROM orders
            INNER JOIN user ON orders.user_id = user.user_id
            INNER JOIN product ON orders.item_id = product.item_id"
        );

        $resultArray = array();
        
        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }
        
        return $resultArray;
    }
}