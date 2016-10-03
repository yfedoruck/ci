<?php
namespace singleton1;

class Singleton {

    private static $instance;

    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __clone() {}
    private function __construct(){}

}

$x = Singleton::getInstance();
var_dump($x);

$y = Singleton::getInstance();

var_dump($x === $y);
//$y = new Singleton();
//$z = clone $x;