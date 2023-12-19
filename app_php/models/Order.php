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
        $idClient = $_SESSION['idClient'];
        $query = 'SELECT * FROM ' . $this->table_name . ', orderDetails, products WHERE orders.id_order = orderDetails.id_order AND idClient = ' . $idClient;
        $this->conn->exec("set names utf8");
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
