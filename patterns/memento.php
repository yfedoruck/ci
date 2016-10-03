<?php

interface IMemento {
    function getState();
}

interface IOriginator {
    function createMemento();
    function setMemento(IMemento $m);
}
interface ICaretaker {
    function setMemento(IMemento $m);
    function getMemento();
}


class Originator implements IOriginator{

    private $state;

    public function setState($x){
        $this->state = $x;
    }

    public function getState(){
        return $this->state;
    }

    public function createMemento(){
        return new Memento($this);
    }

    public function setMemento(IMemento $memento){
        $this->state = $memento->getState();
    }
}

class Memento implements IMemento{
    private $state;

    public function __construct(Originator $state){
        $this->_setState($state->getState());
    }

    private function _setState($state){
        $this->state = $state;
    }
    public function getState(){
        return $this->state;
    }
}

class Caretaker implements ICaretaker{
    private $memento;

    public function setMemento(IMemento $memento){
        $this->memento = $memento;
    }

    public function getMemento(){
        return $this->memento;
    }
}

$o = new Originator();
$o->setState('On');
echo $o->getState()."\n";

$c = new Caretaker();
$c->setMemento($o->createMemento());

$o->setState('Off');
echo $o->getState()."\n";

$o->setMemento($c->getMemento());
echo $o->getState()."\n";