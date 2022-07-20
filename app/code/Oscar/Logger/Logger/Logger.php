<?php
namespace Oscar\Logger\Logger;

//Singleton pattern para el logger

class Logger {

    protected $logger;

    protected static $_instance;

    public function __construct()
    {
       
        $writer = new \Laminas\Log\Writer\Stream(BP . '/var/log/test.log');
        $this->logger = new \Laminas\Log\Logger();
        $this->logger->addWriter($writer);
    }

    public static function getInstance(){
        if(!self::$_instance instanceof self){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function info($message = null){
        $this->logger->info($message);
    }

}