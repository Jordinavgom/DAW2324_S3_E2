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
        $query = 'SELECT * FROM ' . $this->table_name . ', orderDetails, products, productImages WHERE orders.idOrder = orderDetails.idOrder AND idClient = ' . $idClient . ' AND orderDetails.idProduct = products.idProduct AND products.idProduct = productImages.idProduct';
        $this->conn->exec("set names utf8");
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
