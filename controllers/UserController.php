<?php
namespace controllers;

// 引入模型类
use models\User;
use models\Order;

class UserController
{


    public function uploadbig()
    {
        $count = $_POST['count'];
        $i = $_POST['i'];
        $size = $_POST['size'];
        $name = 'big_img_'.$_POST['img_name'];
        $img = $_FILES['img'];
       
        move_uploaded_file($img['tmp_name'],ROOT.'tmp/'.$i);

        $redisi = \libs\Redis::getInstance();
        $uploadedCount =$reids->incr($name);
        if($uploadedCount == $count)
        {
            $fp = fopen(ROOT.'public/uploads/big/'.$name.'.png','a');
            for($i=0;$i<$count;$i++)
            {
                fwrite($fp,$file_get_contents(ROOT.'tmp/'.$i));
                unlink(ROOT.'tmp/'.$i);
            }
            fclose($fp);
            $redis->del($name);
        }
    }

    public function setavatar()
    {
       $upload = \libs\Uploader::make();
       $path = $upload->upload('avatar','avatar');
    }

    public function avatar()
    {
        view('users.face');
    }

    public function login(){
        view('users.login');
    }

    public function dologin(){
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $user = new User;
        if($user->login($email,$password))
        {
            // die('登录成功!');
            redirect('index/index');
        }else{
            die('用户名或密码错误！');
        }
    }

    public function logout()
    {
        $_SESSION=[];
        die('退出成功！');
    }

    public function register()
    {
        // 显示视图
        view('users.add');
    }

    public function hello()
    {
        // 取数据
        $user = new User;
        $name = $user->getName();

        // 加载视图
        view('users.hello', [
            'name' => $name
        ]);
    }

    public function world()
    {
        echo 'world';
    }

    public function store()
    {
        // 1. 接收表单
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $code = md5(rand(1,99999));
        $redis = \libs\Redis::getInstance();
        $valut = json_encode([
            'email'=>$email,
            'password'=>$password,
        ]);
        $key = "temp_user:{$code}";
        $redis->setex($key,300,$value);
    
        $name = explode('@', $email);
        $from = [$email, $name[0]];

        $message = [
            'title' => '智聊系统-账号激活',
            'content' => "点击以下链接进行激活：<br> 点击激活：
            <a href='http://localhost:9999/user/active_user?code={$code}'>
            http://localhost:9999/user/active_user?code={$code}</a><p>
            如果按钮不能点击，请复制上面链接地址，在浏览器中访问来激活账号！</p>",
            'from' => $from,
        ];
        $message = json_encode($message);

        $redis = \libs\Redis::getInstace();

        $redis->lpush('email', $message);
        echo 'ok';
    }

    public function active_user()
    {
        $code = $_GET['code'];
        $redis = \libs\Redis::getInstance();
        $key = 'temp_user:'.$code;
        $data = $redis->get($key);
        if($data)
        {
            $redis->del($key);
            $data = json_decode($data,true);
            $user = new \models\User;
            $user->add($data['email'],$data['password']);
            header('Location:/user/login');
        }else{
            die('激活码无效！');
        }
    }

    public function charge()
    {
        view('users.charge');
    }

    public function docharge()
    {
        $money = $_POST['money'];
        $model = new Order;
        $model->create($money); 
        message('充值订单已生成',2,'/user/orders');
    }
    public function orders()
    {
        $order = new Order;
        $data = $order->search();
        view('users.order',$data);
    }

    public function money()
    {
        $user = new User;
        echo $user->getMoney();
    }

}