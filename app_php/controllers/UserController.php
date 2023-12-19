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
    } else if ($_GET['action'] == 'login') {
        $userController->login();
    }
    if ($_GET['action'] == 'update') {
        $userController->update();
    }
}

class UserController
{
    private $model;
    public $idClient;

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
            $_SESSION['idClient'] = $this->model->logUser($email, $pass);
            $idClient = $_SESSION['idClient'];
            setcookie('idClient_cookie', $_SESSION['idClient'], time() + 3600, '/');

            // Manejar el caso en que no se puede obtener el ID del usuario
            header('Location: ../index.php');
        } catch (Exception $e) {
            // Log error o redirigir a una página de errorupdateUserDetails
            echo "Error en el controlador: " . $e->getMessage();
        }
    }

    public function update()
    {
        try {
            // Validar que no haya campos vacíos
            if (
                empty($_POST['nom']) ||
                empty($_POST['cognoms']) ||
                empty($_POST['adreça']) ||
                empty($_POST['ciutat']) ||
                empty($_POST['codipostal']) ||
                empty($_POST['telefon'])
            ) {
                //$_SESSION['error_message'] = 'Todos los campos son obligatorios.';
                header('Location: ../views/updateUserDetails.php');
                return;
            }

            // Filtrar y validar campos
            $firstName = filter_var($_POST['nom'], FILTER_SANITIZE_STRING);
            $lastName = filter_var($_POST['cognoms'], FILTER_SANITIZE_STRING);
            $street_primary = filter_var($_POST['adreça'], FILTER_SANITIZE_STRING);
            $city = filter_var($_POST['ciutat'], FILTER_SANITIZE_STRING);
            $postCode = filter_var($_POST['codipostal'], FILTER_VALIDATE_INT);
            $telephone = filter_var($_POST['telefon'], FILTER_VALIDATE_INT);

            if (!preg_match('/^[A-Za-z0-9.\s_@#$%^&*()-]+$/u', $street_primary)) {
                //$_SESSION['error_message'] = 'La dirección puede contener letras, números, puntos, guiones bajos y algunos caracteres especiales.';
                header('Location: ../views/updateUserDetails.php');
                return;
            }

            if (!ctype_alpha($firstName) || !ctype_alpha($lastName) || !ctype_alpha($city)) {
                //$_SESSION['error_message'] = 'Los nombres y la ciudad deben contener solo letras.';
                header('Location: ../views/updateUserDetails.php');
                return;
            }

            // Validar la longitud de los nombres
            if (strlen($firstName) > 12 || strlen($lastName) > 12) {
                //$_SESSION['error_message'] = 'Los nombres no pueden tener más de 12 caracteres.';
                header('Location: ../views/updateUserDetails.php');
                return;
            }

            if (!preg_match('/^\d{5}$/', $postCode)) {
                //$_SESSION['error_message'] = 'El código postal debe tener 5 dígitos.';
                header('Location: ../views/updateUserDetails.php');
                return;
            }

            if (!preg_match('/^\+?\d+$/', $telephone)) {
                //$_SESSION['error_message'] = 'El número de teléfono debe contener solo dígitos y puede comenzar con un signo +.';
                header('Location: ../views/updateUserDetails.php');
                return;
            }

            // Llamar al modelo para actualizar al usuario
            $this->model->updateUser($firstName, $lastName, $street_primary, $city, $postCode, $telephone);

            //$_SESSION['success_message'] = 'Usuario actualizado exitosamente.';
            header('Location: ../views/payment.php');
        } catch (PDOException $e) {
            // Log error o redirigir a una página de error
            echo "Error en el controlador: " . $e->getMessage();
        } catch (Exception $e) {
            // Log error o redirigir a una página de error
            echo "Error en el controlador: " . $e->getMessage();
        }
    }
}
