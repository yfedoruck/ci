<?php
namespace proxy2;

interface IImage {
    function __construct($path);
    function display();
}

class Image implements IImage {
    public $content;

    public function __construct($path){
        $this->content = file_get_contents($path);
    }

    public function display(){
        header('Content-Type: image/jpeg');
        echo $this->content;
    }
}

class ProxyImage implements IImage {
    public $path;
    /**
     * @var IImage
     */
    public $inst;

    public function __construct($path){
        $this->path = $path;
    }

    public function display(){
        // lazy load
        if(!$this->inst){
            $this->inst = new Image($this->path);
        }
        $this->inst->display();
    }
}

//echo time() ."<br>";
$img = new Image("/home/slava/Music/m&m/Act1.mp3");
//echo time()."<br>";;
//$img->display();
//echo time() ."<br>";
$proxy = new ProxyImage("/home/slava/Music/m&m/Act1.mp3");
//echo time()."<br>";;
//$proxy->display();
