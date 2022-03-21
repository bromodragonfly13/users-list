<?php 

class User{

    private $conn;
    private $db_table = 'users';

    public $id;
    public $f_name;
    public $l_name;
    public $role;
    public $status;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM $this->db_table";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;

    }

    public function create()
    {
        $query = "INSERT INTO
        " . $this->db_table . " SET f_name=:f_name, l_name=:l_name, role=:role, status=:status";

        $stmt = $this->conn->prepare($query);

        $this->f_name=htmlspecialchars(strip_tags($this->f_name));
        $this->l_name=htmlspecialchars(strip_tags($this->l_name));
        $this->role=htmlspecialchars(strip_tags($this->role));
        $this->status=htmlspecialchars(strip_tags($this->status));

        $stmt->bindParam(":f_name", $this->f_name);
        $stmt->bindParam(":l_name", $this->l_name);
        $stmt->bindParam(":role", $this->role);
        $stmt->bindParam(":status", $this->status);

        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

    public function readOne()
    {
        $query = "SELECT * FROM $this->db_table WHERE id=?";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->l_name = $row['l_name'];
        $this->f_name = $row['f_name'];
        $this->role = $row['role'];
        $this->status = $row['status'];
    }
}