<?php

require_once 'Database.php';

class Product
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getProductById($productId)
    {
        $query = "SELECT name FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $productId);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getProductDetailsById($productId)
    {
        $query = "SELECT name, formatted_price FROM product_details WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $productId);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
