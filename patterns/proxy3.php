<?php
namespace proxy3;

interface IImage {
    function title();
    function dump();
}

abstract class AImage implements IImage {
    protected $title;
    protected $path;

    public function __construct($path){
        $this->title = basename($path);
        $this->path = $path;
    }

    public function title(){
        return $this->title;
    }
}

class Image extends AImage {
    protected $title;
    protected $content;

    public function __construct($path){
        parent::__construct($path);
        $this->content = file_get_contents($path);
    }

    public function dump(){
        return $this->content;
    }
}

class ImageProxy extends AImage {

    /**
     * @var Image
     */
    private $instance;

    public function dump(){
        $this->_lazyLoad();
        return $this->instance->content;
    }

    protected function _lazyLoad(){
        if( $this->instance == null )
            $this->instance = new Image($this->path);
    }
}

