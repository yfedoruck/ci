<?php

interface Drive{
    public function connect();
}


class GoogleDrive implements Drive{
    public function connect(){}
}

class Dropbox implements Drive{
    public function connect(){}
}

abstract class Create {
    abstract public function createDrive();
}

class DropboxFactory extends Create{
    public function createDrive(){
        return new Dropbox();
    }
}

class GoogleFactory extends Create{
    public function createDrive(){
        return new GoogleDrive();
    }
}

$gf = new GoogleFactory();
$gd = $gf->createDrive();

$df = new DropboxFactory();
$dd = $df->createDrive();
