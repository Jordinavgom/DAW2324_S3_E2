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
            $query = "INSERT INTO " . $this->table_name . "(
                        email, 
                        password
                        ) 
                      VALUES (
                        :email, 
                        :password
                        )";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $pass);

            $stmt->execute();
        } catch (Exception $e) {
            echo ("Error en el controlador: " . $e->getMessage());
        }
    }

    public function logUser($email, $pass)
    {
        try {

            $sql = "SELECT id_user, email, password FROM " . $this->table_name . " 
            WHERE email = :email AND password = :password";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $pass);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Las credenciales son válidas, el usuario está autenticado
                return $result['id_user']; // Devuelve el ID del usuario autenticado
            } else {
                // Las credenciales son inválidas
                return false;
            }
        } catch (PDOException $e) {
            // Manejo de la excepción, como registro de errores o redirección a una página de error.
            echo "Error en el controlador: " . $e->getMessage();
        }
    }

    public function getId()
    {
        return $this->id;
    }
}
