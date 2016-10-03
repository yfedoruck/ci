<?php
namespace memento3;

interface IMemento {
    function getState();
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

class Originator
{
    public $state;

    public function restoreState(IMemento $memento){
        $this->state = $memento->getState();
    }
}

/**
 * I think, this case has advantage: the Originator class does not depend on Memento class.
 * Drawback is that must always create memento class.
 */
$o = new Originator();
$o->state = 'On';
echo $o->state . "\n";

$m1 = new Memento($o);  // instead of $m1 = $o->saveState();

$o->state = 'Off';
echo $o->state . "\n";

$o->restoreState($m1);
echo $o->state . "\n";