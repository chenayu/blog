<?php 
    define('ROOT',dirname(__FILE__).'/../');
    function autoload($class)
    {
        $path = str_replace('\\','/',$class);
        require(ROOT.$path.'.php');
        
    }

    spl_autoload_register('autoload');

    if(isset($_SERVER['PATH_INFO']))
    {
        $pathInfo = $_SERVER['PATH_INFO'];
        $pathInfo = explode('/',$pathInfo);

        $controller = ucfirst($pathInfo[1]).'Controller';
        $action = $pathInfo[2];
    }else{
        $controller = 'IndexController';
        $action = 'index';
    }

    $fullController = 'controllers\\'.$controller;
   // echo $fullController;

    // $_C = new controllers\UserController;
    // $_C->hello();
    $_C = new $fullController;
    $_C->$action();

    function view($viewFileName,$data=[])
    {
       extract($data);
         //echo $name;
        $path = 'views/'.str_replace('.','/',$viewFileName).'.html';
        // echo ROOT.$path;
        require(ROOT.$path);  
    };

?>