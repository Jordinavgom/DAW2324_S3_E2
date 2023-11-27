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
    if ($_GET['action'] == 'login') {
        $userController->login();
    }
}

// ...

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
            // Validaciones generales
            if (empty($_POST['email']) || empty($_POST['pass'])) {
                header("Location: ../views/sign_up_form.php");
                return;
            }

            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            if (!$email) {
                header("Location: ../views/sign_up_form.php");
                return;
            }

            $pass = $_POST['pass'];

            // Validar longitud de la contraseña, puedes ajustar según tus criterios
            if (strlen($pass) < 8) {
                header("Location: ../views/sign_up_form.php");
                return;
            }

            // Crear usuario
            $this->model->createUser($email, $pass);

            // Redirigir después del registro
            header("Location: ../views/registroResponse.php");
        } catch (Exception $e) {
            // Log error o redirigir a una página de error
            echo "Error en el controlador: " . $e->getMessage();
        }
    }

    public function login()
    {
        try {
            // Validaciones generales
            if (empty($_POST['email']) || empty($_POST['pass'])) {
                header('Location: ../views/loginStandAlone.php');
                return;
            }

            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            if (!$email) {
                header('Location: ../views/loginStandAlone.php');
                return;
            }

            $pass = $_POST['pass'];

            // Validar longitud de la contraseña, puedes ajustar según tus criterios
            if (strlen($pass) < 8) {
                header('Location: ../views/loginStandAlone.php');
                return;
            }

            // Validación de seguridad contra la inyección de SQL
            if (!$this->model->isValidUser($email, $pass)) {
                header('Location: ../views/loginStandAlone.php');
                return;
            }

            // Iniciar sesión
            session_start();
            $_SESSION['id_user'] = $this->model->logUser($email, $pass);
            setcookie('id_user_cookie', $_SESSION['id_user'], time() + 3600, '/');

            // Redirigir después del inicio de sesión
            header('Location: ../index.php');
        } catch (Exception $e) {
            // Log error o redirigir a una página de error
            echo "Error en el controlador: " . $e->getMessage();
        }
    }
}
