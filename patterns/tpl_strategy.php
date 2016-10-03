<?php
namespace strategy_to_tpl;

abstract class Archive
{
    public function exec(File $file) {
        return $this->createCommand($file->path);
    }
    abstract function createCommand($path);
}

// zip strategy
class Zip extends Archive {
    public function createCommand($path){
        return "zip {$path} ".basename($path).".zip";
    }
}

// tgz strategy
class TarGz extends Archive {
    public function createCommand($path){
        return "tar zc {$path} ".basename($path).".tar.gz";
    }
}

class File
{
    public $path;

    public function __construct($path)
    {
        $this->path = $path;
    }
}


if($_GET['server'] === 'win'){
    $archiver = new Zip();
}else{
    $archiver = new TarGz();
}

$archiver->exec(new File('~/cookie.txt'));
$archiver->exec(new File(__FILE__));