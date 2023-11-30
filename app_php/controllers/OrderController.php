<?php
require_once '../models/Order.php';
require_once '../models/Database.php';

$database = new Database();
$conn = $database->connect();

if (!$conn) {
    echo "Error al conectar a la base de datos.";
} else {
    $orderController = new OrderController();
    $orders = $orderController->index();
}

class OrderController
{
    private $model;

    public function __construct()
    {
        $this->model = new Order();
    }

    public function index()
    {
        return $this->model->getAll();
    }
}
