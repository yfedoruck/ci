<?php

namespace chain;

abstract class Logger {
    const ERR = 1;
    const NOTICE = 2;
    const DEBUG = 3;
    protected $type;

    /**
     * @var Logger
     */
    protected $next;

    public function __construct($type){
        $this->type = $type;
    }
    public function setNext(Logger $logger){
        $this->next = $logger;
        return $logger;
    }

    public function message($message, $priority){
        if($priority <= $this->type){
            $this->writeMessage($message);
        }
        if( $this->next !== null ){
            $this->next->message($message, $priority);
        }
    }

    abstract protected function writeMessage($message);
}

class EmailLogger extends Logger {
    protected function writeMessage($message){
        echo "email message: " . $message . "<br>";
    }
}

class PrintLogger extends Logger {
    protected function writeMessage($message){
        echo "print message: " . $message . "<br>";
    }
}

class FileLogger extends Logger {
    protected function writeMessage($message){
        echo "save to log file message: " . $message . "<br>";
    }
}

class Chain {
    public function run(){

        $logger = new EmailLogger(Logger::DEBUG);
        $logger1 = $logger->setNext(new PrintLogger(Logger::NOTICE));
        $logger2 = $logger1->setNext(new FileLogger(Logger::ERR));

        $logger->message('** you receive this email, because of... **', Logger::NOTICE);
        $logger->message('Warning! Notice error', Logger::ERR);
        $logger->message('Fatal error! system is shutting down right now!', Logger::ERR);

    }
}

$chain = new Chain();
$chain->run();