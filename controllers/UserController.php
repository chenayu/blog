<?php 
namespace controllers;
use models\User;

    class UserController
    {
        public function register()
        {
            view('users.register');
        }

        public function store()
        {
            $email = $_POST['email'];
            $password = md5($_POST['password']);

            $user = new User;
            $ret = $user->add($email,$password);
            if(!$res){
                die ('注册失败!');
            }

            $mail = new \libs\Mail;
            $content = '注册成功！';

            $name = explode('@',$email);
            $from = [$email,$name[0]];
            $mail->send('注册成功',$content,$from);
        }
    }
?>