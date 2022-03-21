<?php 

class Database{

    private $host = "fdb34.awardspace.net";
    private $username = "4069303_tetsban";
    private $password = "08PF,l]}8})hZE1u";
    private $db = "4069303_tetsban";

    public function getConnection()
    {
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