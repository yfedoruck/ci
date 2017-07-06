<?php
namespace strategy_to_tpl2;

interface Archive
{
    function exec(string $path);
}

// zip strategy
class Zip implements Archive {
    public function exec(string $path){
        return "zip {$path} ".basename($path).".zip";
    }
}

// tgz strategy
class TarGz implements Archive {
    public function exec(string $path){
        return "tar zc {$path} ".basename($path).".tar.gz";
    }
}


if($_GET['server'] === 'win'){
    $archiver = new Zip();
}else{
    $archiver = new TarGz();
}

$archiver->exec('~/cookie.txt');
$archiver->exec(__FILE__);
