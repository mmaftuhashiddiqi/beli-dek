<?php

// php cart class
class Admin
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    // get data admin with condition
    public function getAdmin($admin_id = null, $table = 'admins') {
        if (isset($admin_id)){
            $result = $this->db->con->query("SELECT * FROM {$table} WHERE admin_id={$admin_id}");

            $resultArray = array();

            // fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }

            return $resultArray;
        }
    }
}