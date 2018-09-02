<?php 
namespace controllers;
use models\User;

    class UserController
    {
        public function hello()
        {
            $user = new User;
            $user = $user->getName();
           

            view('user.hello',['name'=>$user]);
        }
    }
?>