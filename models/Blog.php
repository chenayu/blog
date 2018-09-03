<?php 
namespace models;
use PDO;
    class Blog
    {
        public function search()
        {
            $pdo = new PDO('mysql:host=localhost;dbname=blog001','root','');
            $pdo->exec('set names utf8');
            $where = 1;
            if(isset($_GET['keyword']) && $_GET['keyword'])
            {          
                $where = 'title like "%'.$_GET['keyword'].'%" OR content like  "%'.$_GET['keyword'].'%"';
            }
            $stmt = $pdo->query("SELECT * FROM blogs WHERE $where");
           return $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>