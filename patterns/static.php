<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
class A {
    //public static $x=1;
    public static function who() {
        echo __CLASS__;
    }
    public function test() {
        $this->who();
        //echo self::x;
    }
}

class B extends A {
    static $x=1;
    public static function who() {
        //echo __CLASS__;
        echo "123<p>";
    }
    
    public static function zz() {
        //echo __CLASS__;
        echo "123<p>";
    }
    
    public function test2(){
        $this->zz();
        echo self::$x;
    }
}

$b = new B();
$b->test();
$b->test2();
?>