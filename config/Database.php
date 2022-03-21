<?php 

class Database{

    private $host = "localhost";
    private $username = "root";
    private $password = "root";
    private $db = "testwork113";

    public function getConnection(){
        $this->conn = null;

        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->username, $this->password);
        
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }

          return $conn;

    }
}