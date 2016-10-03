<?php

namespace state;

interface IState {
    function parse($string);
    function valid();
}

class EvenState implements IState {
    public function parse ($string){
        if($string == 1)
            return new OddState();
        else
            return $this;
    }
    public function valid(){
        return true;
    }
}
class OddState implements IState {
    public function parse ($string){
        if($string == 1)
            return new EvenState();
        else
            return $this;
    }
    public function valid(){
        return false;
    }
}

class BitValidator {

    private $_state;

    public function __construct(IState $state){
        $this->_state = $state;
    }

    public function isValid($string){
        $length = strlen($string);
        for( $i=0; $i< $length; $i++){
            $this->_state = $this->_state->parse($string[$i]);
        }
        return $this->_state->valid();
    }
}
$validator = new BitValidator(new EvenState());
var_dump($validator->isValid('10101001101'));
var_dump($validator->isValid('10101001101001'));