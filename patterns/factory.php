<?php

class Auto {

}

class AutoFactory {

    public function create(){
        return new Auto();
    }
}

$x = new AutoFactory();
$a1 = $x->create();

//....

$a2 = $x->create();