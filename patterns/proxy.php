<?php

interface IMath {
    function add($x, $y);
    function mul($x, $y);
}

class Math implements IMath {
    public function add($a,$b){
        return $a + $b;
    }

    public function mul($x, $y) {
        return $x*$y;
    }
}

class MathProxy implements IMath {
    private $instance;

    public function __construct(){
        $this->instance = null;
    }

    public function add($a,$b){
        return $a + $b;
    }

    public function mul($x, $y) {
        if( $this->instance == null ){
            $this->instance = new Math();
        }
        return $this->instance->mul($x, $y);
    }
}

$p = new MathProxy();
echo $p->add(1, 2);
echo $p->mul(20, 30);