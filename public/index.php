<?php

// 设置 SESSION 保存
ini_set('session.save_handler', 'redis');   // 使用 redis 保存 SESSION
ini_set('session.save_path', 'tcp://127.0.0.1:6379?database=3');  // 设置 redis 服务器的地址、端口、使用的数据库

// 开启 SESSION
session_start();

// 如果用户以 POST 方式访问网站时，需要验证令牌
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(!isset($_POST['_token']))
        die('违法操作！');

    if($_POST['_token'] != $_SESSION['token'])
        die('违法操作！');
}

// 定义常量
define('ROOT', dirname(__FILE__) . '/../');

// 引入 composer 自动加载文件
require(ROOT.'vendor/autoload.php');

// 实现类的自动加载
function autoload($class)
{
    $path = str_replace('\\', '/', $class);
    // echo $path."<br>";
    // echo ROOT . $path . '.php<br>';
    require(ROOT . $path . '.php');
}
spl_autoload_register('autoload');

// 添加路由 ：解析 URL 浏览器上 blog/index  CLI中就是 blog index

if(php_sapi_name() == 'cli')
{
    $controller = ucfirst($argv[1]) . 'Controller';
    $action = $argv[2];
}
else
{
    if( isset($_SERVER['PATH_INFO']) )
    {
        $pathInfo = $_SERVER['PATH_INFO'];
        // 根据 / 转成数组
        $pathInfo = explode('/', $pathInfo);

        // 得到控制器名和方法名 ：
        $controller = ucfirst($pathInfo[1]) . 'Controller';
        $action = $pathInfo[2];
    }
    else
    {
        // 默认控制器和方法
        $controller = 'IndexController';
        $action = 'index';
    }
}


// 为控制器添加命名空间
$fullController = 'controllers\\'.$controller;


$_C = new $fullController;
$_C->$action();

// 加载视图
// 参数一、加载的视图的文件名
// 参数二、向视图中传的数据
function view($viewFileName, $data = [])
{
    // 解压数组成变量
    extract($data);

    $path = str_replace('.', '/', $viewFileName) . '.html';

    // 加载视图
    require(ROOT . 'views/' . $path);
}

// 获取当前 URL 上所有的参数，并且还能排除掉某些参数
// 参数：要排除的变量
function getUrlParams($except = [])
{
    // ['odby','odway']
    // 循环删除变量
    foreach($except as $v)
    {
        unset($_GET[$v]);

        // unset($_GET['odby']);
        // unset($_GET['odway']);
    }

    /*
    $_GET['keyword'] = 'xzb';
    $_GET['is_show] = 1

    // 拼出：  keyword=abc&is_show=1
    */

    $str = '';
    foreach($_GET as $k => $v)
    {
        $str .= "$k=$v&";
    }

    return $str;

}

function config($name)
{
    static $config = null;
    if($config === null)
    {
        $config = require(ROOT.'config.php');
    }
    return $config[$name];
}

//跳转
function redirect($route)
{
    header('Location:',$route);
    exit;
}
function back()
{
    redirect($_SERVER['HTTP_REFERER']);
}


//提示消息
function message($message, $type, $url, $seconds = 5)
{
    if($type == 0)
    {
        echo "<script>alert('{$message}');location.href='{$url}';</script>";
        exit;

    }
    else if($type == 1)
    {
        // 加载消息页面
        view('common.success', [
            'message' => $message,
            'url' => $url,
            'seconds' => $seconds
        ]);
    }
    else if($type==2)
    {
        // 把消息保存到 SESSION
        $_SESSION['_MESS_'] = $message;
        // 跳转到下一个页面
        redirect($url);
    }
}

// 过滤XSS（在线编辑器填写的内容不能使用该函数过滤）
function e($content)
{
    return htmlspecialchars($content);
}

function csrf()
{
    if(!isset($_SESSION['token']))
    {
        // 生成一个随机的字符串
        $token = md5( rand(1,99999) . microtime() );
        $_SESSION['token'] = $token;
    }
    return $_SESSION['token'];
}

function csrf_field()
{
    $csrf = isset($_SESSION['token']) ? $_SESSION['token'] : csrf();
    echo "<input type='hidden' name='_token' value='{$csrf}'>";
}

