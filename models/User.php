<?php 
namespace models;
use PDO;

    class User
    {
        public $pdo;
        public function __construct()
        {
            $this->pdo = new PDO('mysql:host=localhost;dbname=blog001','root','');
            $this->pdo->exec('set names utf8');
        }
        public function add($email,$password){
            $stmt = $this->pdo->prepare("INSERT INTO users(email,password) VALUES(?,?)");
            return $stmt->execute([$email,$password]);
        }
    }
?>