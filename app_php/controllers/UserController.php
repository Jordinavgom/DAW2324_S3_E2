<?php
require_once '../models/User.php';
require_once '../models/Database.php';

$database = new Database();
$conn = $database->connect();

if (!$conn) {
    echo "Error al conectar a la base de datos.";
} else {
    $userController = new UserController();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_GET['action'] == 'signup') {
        $userController->create();
    }
}

class UserController
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function create()
    {
        try {
            $email = $_POST['email'];
            $pass = md5($_POST['pass']);

            $this->model->createUser($email, $pass);

            header("Location: ../views/registroResponse.php");
        } catch (Exception $e) {
            echo "Error en el controlador: " . $e->getMessage();
        }
    }
}
