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

    // insert into cart table
    public  function insertIntoCart($params = null, $table = "carts"){
        if ($this->db->con != null){
            if ($params != null){
                // "Insert into cart(user_id) values (0)"
                // get table columns
                $columns = implode(',', array_keys($params));

                $values = implode(',' , array_values($params));

                // create sql query
                $query_string = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);

                // execute query
                $result = $this->db->con->query($query_string);
                return $result;
            }
        }
    }

    // to get user_id and product_id and insert into cart table
    public  function addToCart($userid, $productid){
        if (isset($userid) && isset($productid)){
            $params = array(
                "user_id" => $userid,
                "product_id" => $productid
            );

            // insert data into cart
            $result = $this->insertIntoCart($params);
            if ($result){
                // Reload Page
                header("Location: " . $_SERVER['PHP_SELF']);
            }
        }
    }

    // delete cart product using cart product id
    public function deleteCart($product_id = null, $user_id= null, $table = 'carts'){
        if($product_id != null && $user_id != null){
            $result = $this->db->con->query("DELETE FROM {$table} WHERE product_id={$product_id} AND user_id={$user_id}");
            if($result){
                header("Location: " . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }

    // fetch cart data using getDataCart Method
    public function getDataCart($table = 'carts'){
        $userId = $_SESSION["user"];
        $result = $this->db->con->query("SELECT * FROM {$table} WHERE user_id = $userId");
        
        $resultArray = array();
        
        // fetch product data one by one
        while ($product = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $product;
        }
        
        return $resultArray;
    }

    // calculate sub total
    public function getSum($arr){
        if(isset($arr)){
            $sum = 0;
            foreach ($arr as $product){
                $sum += floatval($product[0]);
            }
            return sprintf('%.2f' , $sum);
        }
    }

    // get product_id of shopping cart list
    public function getCartId($cartArray = null, $key = "product_id"){
        if ($cartArray != null){
            $cart_id = array_map(function ($value) use($key){
                return $value[$key];
            }, $cartArray);
            return $cart_id;
        }
    }

    // Save for later
    public function saveForLater($product_id = null, $user_id, $saveTable = "wishlists", $fromTable = "carts"){
        if ($product_id != null && $user_id != null){
            $query = "INSERT INTO $saveTable (`user_id`, `product_id`, `product_count`) SELECT `user_id`, `product_id`, `product_count` FROM $fromTable WHERE `product_id`=$product_id AND `user_id`=$user_id;";
            $query .= "DELETE FROM $fromTable WHERE `product_id`=$product_id AND `user_id`=$user_id;";

            // execute multiple query
            $result = $this->db->con->multi_query($query);

            if($result){
                header("Location: " . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }

    // proceed to buy
    public function proceedToBuy($user_id = null) {
        if ($user_id != null){
            date_default_timezone_set('Asia/Jakarta');
            $datetime = date("Y-m-d H:i:s");
            echo $datetime;

            $dataCart = "SELECT `user_id`, `product_id`, `product_count` FROM `carts` WHERE user_id={$user_id};";
            $dataCartResult = $this->db->con->query($dataCart);

            $result = "";
            foreach ($dataCartResult as $cart) {
                $result .= "INSERT INTO `orders` 
                            VALUES ('', '$datetime', {$cart['user_id']}, {$cart['product_id']}, {$cart['product_count']});";
            }

            $result .= "DELETE FROM `carts` WHERE user_id={$user_id};";

            // execute query
            $result = $this->db->con->multi_query($result);

            if($result){
                header("Location: " . $_SERVER['PHP_SELF']);
            }
            return;
        }
    }
}