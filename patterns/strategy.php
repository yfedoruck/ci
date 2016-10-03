<?php

interface IArchive {
    function create($file);
}

// zip strategy
class Zip implements IArchive {
    public function create($path){
        return "zip {$path} ".basename($path).".zip";
    }
}

// tgz strategy
class TarGz implements IArchive {
    public function create($path){
        return "tar zc {$path} ".basename($path).".tar.gz";
    }
}

class Archiver
{
    private $strategy;

    public function __construct(IArchive $strategy){
        $this->strategy = $strategy;
    }
    public function exec($file){
        return $this->strategy->create($file);
    }
}

if($_GET['server'] === 'win'){
    $strategy = new Zip();
}else{
    $strategy = new TarGz();
}

$context = new Archiver($strategy);
$context->exec('test.doc');