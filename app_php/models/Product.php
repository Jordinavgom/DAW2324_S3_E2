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
        $query = "SELECT name FROM products WHERE idProduct = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $productId);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getProductDetailsByProductId($productId)
    {
        $query = "SELECT name, formatted_price FROM productDetails WHERE idProduct = :product_id";
        $this->conn->exec("set names utf8");
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":product_id", $productId);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getImatgesByProductId($productId)
    {
        $query = "SELECT original, thumb FROM productImages WHERE idProduct = :product_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":product_id", $productId);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
