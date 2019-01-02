<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class InfoController extends Controller
{
    public function index()
    {
        return view('admin.index.index');
    }

    public function mail(Request $req){
        
        //验证输入的内容
        $req->validate([
            // 'title'=>'required | min:5 | max:10',
            'message'=>'required | min:5'
            ],[
            'message.required'=>'内容不能为空',
            'message.min'=>'内容最少5个字符'
            ]);


        //获取用户ip
        // $req->setTrustedProxies(['']);
        $ip = $req->getClientIp();

        //判断redis里是否已存在这个ip
        if(Redis::exists('user'.$ip)){
            //如果存在就把值加1
            Redis::incr('user'.$ip);
            //判断如果半小时内发送次数超过5次就禁止发送
            if(Redis::get('user'.$ip)>=6){
                $req->validate([
                    'message'=>'image'
                    ],[
                    'message.image'=>'操作频繁',
                    ]);
            }

        }else{

            //如果发送者的ip不存在redis里，就创建一个并设置有效期为半小时
            Redis::setex('user'.$ip, 1800 , 1);
        }
    

                
            // 设置邮件服务器账号
            $transport = (new \Swift_SmtpTransport('smtp.qq.com', 25)) // 邮件服务器IP地址和端口号
            ->setUsername('359394156@qq.com') // 发邮件账号
            ->setPassword('eioawvuwujnxcagf'); // 授权码
            // 创建发邮件对象
            $mailer = new \Swift_Mailer($transport);
            // 创建邮件消息
            $message = new \Swift_Message();
            $message->setSubject('blog') // 标题
            ->setFrom(['359394156@qq.com' => 'about']) // 发件人
            ->setTo(['359394156@qq.com', '359394156@qq.com' => 'about']) // 收件人
            ->setBody($req->message); // 邮件内容及邮件内容类型
            // 发送邮件
            $ret = $mailer->send($message);
            var_dump( $ret ); 
        

       

    }
}
