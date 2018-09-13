<?php 
namespace libs;

    class Redis
    {
        private static $redis = null;
        private function __clone(){}
        private function __construct(){}

        public static function getInstance()
        {
            if(self::$redis === null)
            {
                self::$redis = new \Predis\Client([
                    'scheme'=>'tcp',
                    'host'=>'127.0.0.1',
                    'port'=>32768.
                ]);

            }
            return self::$redis;
        }
    }
?>