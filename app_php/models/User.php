<?php
session_start();
require_once 'Database.php';
require_once '../controllers/UserController.php';

class User
{
    private $conn;
    private $table_name = "clients";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function createUser($email, $pass)
    {
        try {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $query = "INSERT INTO " . $this->table_name . " (email, password) VALUES (:email, :password)";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hash);

            $stmt->execute();
        } catch (Exception $e) {
            // Log error o redirigir a una página de error
            echo "Error en el modelo: " . $e->getMessage();
        }
    }

    public function isEmailAvailable($email)
    {
        try {
            $query = "SELECT COUNT(*) as count FROM clients WHERE email = :email";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return ($result['count'] == 0);
        } catch (Exception $e) {
            // Log error o manejar de otra manera
            return false;
        }
    }

    public function logUser($email, $pass)
    {
        try {
            $sql = "SELECT idClient, email, password FROM " . $this->table_name . " WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && password_verify($pass, $result['password'])) {
                return $result['idClient'];
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Log error o redirigir a una página de error
            echo "Error en el modelo: " . $e->getMessage();
        }
    }

    public function updateUser($firstName, $lastName, $street_primary, $city, $postCode, $telephone)
    {

        $idClient = $_SESSION['idClient'];

        try {
            $sql = "UPDATE " . $this->table_name . " 
            SET name = :firstname, 
                surnames = :lastname, 
                address = :street_primary, 
                city = :city, 
                postcode = :postcode, 
                telephone = :telephone 
            WHERE idClient = :idClient";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':firstname', $firstName);
            $stmt->bindParam(':lastname', $lastName);
            $stmt->bindParam(':street_primary', $street_primary);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':postcode', $postCode);
            $stmt->bindParam(':telephone', $telephone);
            $stmt->bindParam(':idClient', $idClient);
            $stmt->execute();
        } catch (Exception $e) {
            // Log error or redirect to an error page
            echo "Error en el modelo: " . $e->getMessage();
        }
    }

    public function isValidUser($email, $password)
    {
        // Recupera el hash almacenado para el usuario con el correo electrónico dado
        $storedHash = $this->getStoredHash($email);

        // Verifica si la contraseña proporcionada coincide con el hash almacenado
        return password_verify($password, $storedHash);
    }


    private function getStoredHash($email)
    {
        try {
            $stmt = $this->conn->prepare("SELECT password FROM " . $this->table_name . " WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result['password'];
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Log error o redirigir a una página de error
            echo "Error en el modelo: " . $e->getMessage();
            return false;
        }
    }
}
