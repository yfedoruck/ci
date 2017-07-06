<?php


class A {
    protected $a;
    public function __construct()
    {
        $this->a = 123;
    }
}

class B extends A {
    public $a;

    public function __construct()
    {
        parent::__construct();
    }
}

$b = new B;
var_dump($b->a);