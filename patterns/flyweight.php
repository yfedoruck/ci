<?php

class File {
    private $_data;

    public function __construct($path){
        $this->_data = file_get_contents($path);
    }
    public function getBytes(){
        return $this->_data;
    }
}

class FileFactory {
    private $_flyweights;

    public function getFile($path){
        if( !$this->_flyweights[$path] ) {
            $this->_flyweights[$path] = new File($path);
        }
        return $this->_flyweights[$path];
    }
}
$ff = new FileFactory();
$f1 = $ff->getFile('/home/slava/www/000.txt');
$f2 = $ff->getFile('/home/slava/www/000.txt');
//var_dump($f1->getBytes());
//var_dump($f2->getBytes());

var_dump($f1 === $f2);