<?php
require_once 'Database.php';

class Order
{
    private $conn;
    private $table_name = "orders";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAll()
    {
        $id_user = $_SESSION['id_user'];
        $query = 'SELECT * FROM ' . $this->table_name . ', orderDetails, products WHERE orders.id_order = orderDetails.id_order AND id_user = ' . $id_user;
        $this->conn->exec("set names utf8");
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
