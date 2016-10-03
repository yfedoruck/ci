<?php

class Memory {
    public function load(){}
}

class Hard {
    public function read(){}
}

class Processor {
    public function start(){}
}

class ComputerFacade {

    public function on()
    {
        $memory = new Memory();
        $memory->load();

        $hard = new Hard();
        $hard->read();

        $proc = new Processor();
        $proc->start();
    }
}

$computer = new ComputerFacade();
$computer->on();