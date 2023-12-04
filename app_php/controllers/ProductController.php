<?php
require_once '../models/Product.php';

$database = new Database();
$db = $database->connect();
$product = new Product($db);

// Obtén la ID del producto de la URL
$productId = isset($_GET['id']) ? $_GET['id'] : die('ID del producto no proporcionada.');

// Llama al método getProductById para obtener la información del producto
$productInfo = $product->getProductById($productId);
$productDetails = $product->getProductDetailsByProductId($productId);
$productImage = $product->getImatgesByProductId($productId);
