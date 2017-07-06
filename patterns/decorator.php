<?php
namespace decorator;

interface IText {
    function show();
}

class Hello implements IText{
    public function show(){
        echo "hello!";
    }
}

class Bye implements IText{
    public function show(){
        echo "Bye!";
    }
}

/**
 * must implement interface for the sake of Liskov principle
 * Decorator is opposite to Mediator on realization the same functional
 */
class Decorator implements IText {

    /**
     * @var IText
     */
    private $inst;
    public function __construct(IText $t){
        $this->inst = $t;
    }

    public function show(){
        echo '*** ';
            $this->inst->show();
        echo ' ***';
    }
}

$helloDec = new Decorator(new Hello());
$helloDec->show();
echo "\n";

$byeDec = new Decorator(new Bye());
$byeDec->show();
echo "\n";