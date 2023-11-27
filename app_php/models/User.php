<?php

require_once 'Database.php';

class User
{
    private $conn;
    private $table_name = "users";
    private $id;

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

    public function logUser($email, $pass)
    {
        try {
            $sql = "SELECT id_user, email, password FROM " . $this->table_name . " WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && password_verify($pass, $result['password'])) {
                return $result['id_user'];
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Log error o redirigir a una página de error
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
            $stmt = $this->conn->prepare("SELECT password FROM users WHERE email = :email");
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
