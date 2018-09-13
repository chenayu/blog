<?php
namespace models;
use PDO;

class User extends Base
{
    public function add($email,$password)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (email,password) VALUES(?,?)");
        return $stmt->execute([
                                $email,
                                $password,
                            ]);
    }

    public function login($email,$password)
    {
        $stmt = self::$pdo->prepare('SELECT * FROM users WHERE email=? AND password=?');
        $stmt->execute([
            $email,
            $password
        ]);
        $user = $stmt->fetch();
        if($user)
        {
            $_SESSION['id']=$user['id'];
            $_SESSION['email']=$user['email'];
            $_SESSION['money']=$user['money'];
            return true;
        }else{
            return flase;
        }
    }

    public function addMoney($money,$userId)
    {
        $stmt = self::$pdo->prepare("UPDATE users SET money=money+? WHERE id=?");
        return $stmt->execute([
            $money,
            $userId
        ]);
    }

    public function getMoney()
    {
        $id = $_SESSION['id'];
        $stmt = self::$pdo->prepare('SELECT money FROM users WHERE id=?');
        $stmt->execute([
            $id
        ]);
        $money = $stmt->fetch(PDO::FETCH_COLUMN);
        $_SESSION['money']=$money;
        return $money;
    }
}