<?php
session_start();
class Database{
    private $servername = 'localhost';
    private $username = 'root';
    private $password = 'root';
    private $database = 'mywebsite';
    public $conn;

    public function __construct(){
        $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->database);

        if($this->conn->connect_error){
            die('connection failed'.$this->conn->connect_error);
        }else{
            return $this->conn;
        }
    }
}
?>