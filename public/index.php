<?php 
    define('ROOT',dirname(__FILE__).'/../');
    function autoload($class)
    {
        $path = str_replace('\\','/',$class);
        require(ROOT.$path.'.php');
        
    }

    spl_autoload_register('autoload');
    $_C = new controllers\UserController;
    $_C->hello();
  

    function view($a,$b){};

?>