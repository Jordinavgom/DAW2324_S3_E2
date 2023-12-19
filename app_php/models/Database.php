<?php
class Database
{
    private $host = 'mariadb';
    private $db_name = 'botiga_online';
    private $username = 'testuser';
    private $password = 'testpassword';
    private $conn;

    public function connect()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        return $this->conn;
    }
}
