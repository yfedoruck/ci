<?php
namespace memento2;

interface IMemento {
    function getState();
}

interface IOriginator {
    function saveState();
    function restoreState(IMemento $m);
}

class Memento implements IMemento
{
    private $state;

    public function __construct($o){
        $this->state = $o->state;
    }

    public function getState(){
        return $this->state;
    }
}

class Originator implements IOriginator{

    public $state;

    public function saveState(){
        return new Memento($this);
    }

    public function restoreState(IMemento $memento){
        $this->state = $memento->getState();
    }
}

$o = new Originator();
$o->state = 'On';
echo $o->state . "\n";

$m1 = $o->saveState();

$o->state = 'Off';
echo $o->state . "\n";

$o->restoreState($m1);
echo $o->state . "\n";