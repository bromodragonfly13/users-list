<?php 

class User{

    private $conn;

    public $id;
    public $f_name;
    public $l_name;
    public $role;
    public $status;

    public function __construct($db)
    {
        $this->conn = $db;
    }
}