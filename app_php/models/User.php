<?php

require_once 'Database.php';

class User {
    private $conn;
    private $table_name = "users";

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
                        :pass
                        )";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':pass', $pass);

            $stmt->execute();
        } catch (Exception $e) {
            echo ("Error en el controlador: " . $e->getMessage());
        }
    }
}