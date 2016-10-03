<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

interface Observer {
    function notify($object);
}

class Rate {
    static private $instance = null;
    private $observers = [];
    private $rate;

    static public function getInstance(){
        if( self::$instance == null ){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getRate(){
        return $this->rate;
    }

    public function setRate($newRate){
        $this->rate = $newRate;
        $this->notifyObservers();
    }

    public function registerObserver(Observer $o){
        $this->observers[] = $o;
    }
    public function notifyObservers(){
        foreach ($this->observers as $observer) {
            $observer->notify($this);
        }

    }
}

class Product implements Observer {

    public function __construct(){
        Rate::getInstance()->registerObserver($this);
    }

    public function notify($object){
        if($object instanceof Rate){
            echo 'I observe it!'."<br>";
        }
    }
}

$p1 = new Product();
$p2 = new Product();

Rate::getInstance()->setRate(123);

