<?php
namespace controllers;

class TestController
{
    public function register()
    {
        // 注册成功

        // 发邮件
        $redis = \libs\Redis::getInstace();


        // 消息队列的信息
        $data = [
            'email' => 'fortheday@126.com',
            'title' => '标题',
            'content' => '内容',
        ];

        // 数组转成 JSON
        $data = json_encode($data);

        $redis->lpush('email', $data);

        echo '注册成功！';
    }

    // 发邮件
    public function mail()
    {
        // 设置 socket 永不超时
        ini_set('default_socket_timeout', -1); 

        echo "邮件程序已启动....等待中...";

        $redis = \libs\Redis::getInstace();


        // 循环监听一个列表
        while(true)
        {
            // 从队列中取数据，设置为永久不超时
            $data = $redis->brpop('email', 0);

            echo '开始发邮件';
            // 处理数据
            var_dump($data);
            echo "发完邮件，继续等待\r\n";
        }
    }

    public function testMail1()
    {
        $mail = new \libs\Mail;
        $mail->send('测试meila类', '测试mail类', ['359394156@qq.com', '小吴']);
    }

    public function testMail()
    {
        // 设置邮件服务器账号
        $transport = (new \Swift_SmtpTransport('smtp.qq.com', 25))  // 邮件服务器IP地址和端口号
        ->setUsername('359394156@qq.com')       // 发邮件账号
        ->setPassword('eioawvuwujnxcagf');      // 授权码

        // 创建发邮件对象
        $mailer = new \Swift_Mailer($transport);

        // 创建邮件消息
        $message = new \Swift_Message();

        $message->setSubject('测试标题')   // 标题
                ->setFrom(['359394156@qq.com' => '大神'])   // 发件人
                ->setTo(['359394156@qq.com', '359394156@qq.com' => '你好'])   // 收件人
                ->setBody('Hello <a href="http://localhost:9999">点击激活</a> World ~', 'text/html');     // 邮件内容及邮件内容类型

        // 发送邮件
        $ret = $mailer->send($message);

        var_dump( $ret );
    }

    public function testt(){
        $client = new \Predis\Client([
            'scheme'=>'tcp',
            'host'=>'127.0.0.1',
            'port'=>6379,
    ]);

    $client->set('name','tom');
    echo $client->get('name');
    }
}