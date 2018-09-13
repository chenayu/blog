<?php 
namespace controllers;

use Yansongda\Pay\Pay;

class WxpayController
{
    protected $config = [
        'app_id' => 'wx426b3015555a46be', // 公众号 APPID
        'mch_id' => '1900009851',
        'key' => '8934e7d15453e97507ef794cf7b0519d',
        'notify_url' => 'http://requestbin.fullcontact.com/11ixocg1',
    ];

    public function pay()
    {
        $order = [
            'out_trade_no' => time(),
            'total_fee' => '1', // **单位：分**
            'body' => 'test body - 测试',
            // 'openid' => 'onkVf1FjWS5SBIixxxxxxx',
        ];

        $pay = Pay::wechat($this->config)->scan($order);

        echo $pay->return_code , '<hr>';
        echo $pay->return_msg , '<hr>';
        echo $pay->appid , '<hr>';
        echo $pay->result_code , '<hr>';
        echo $pay->code_url , '<hr>';
    }

    public function notify()
    {
        $log = new \libs\Log('wxpay');
        $log->log('接收到微信的消息');
        $pay = Pay::wechat($this->config);

        try{
            $data = $pay->verify(); // 是的，验签就这么简单！

            $log->log('验证成功，接收的数据是:'.file_get_contents('php://input'));
            if($data->result_code == 'SUCCESS' && $data->return_code == 'SUCCESS')
            {
                //记录日志
                $log->log('支付成功');
                $order = new \models\Order;

                $orderInfo = $order->findBySn($data->out_trade_no);
                if($orderInfo['status'] == 0)
                {
                    $order->startTrans();
                    // 设置订单为已支付状态
                   $ret1 = $order->setPaid($data->out_trade_no);

                    // 更新用户余额
                    $user = new \models\User;
                    $ret2 = $user->addMoney($orderInfo['money'], $orderInfo['user_id']);
              
                    if($ret1&&$ret2)
                    {
                        $order->commit();
                    }else{
                        $order->rollback();
                    }
                }
                
            }

        } catch (Exception $e) {
            $log->log('验证失败！'.$e->getMessage());
            var_dump( $e->getMessage() );
        }
        
        $pay->success()->send();
    }
}
?>