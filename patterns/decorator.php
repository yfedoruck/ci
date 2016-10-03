<?php

interface IText {
    function show();
}

class Text implements IText{
    public function show(){
        echo 'hello'."<br>";
    }
}

/**
 * must implement interface for the sake of Liskov principle
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
        echo '<b>';
        $this->inst->show();
        echo '</b>';
    }
}

$t = new Text();
$t->show();

$d = new Decorator($t);
$d->show();