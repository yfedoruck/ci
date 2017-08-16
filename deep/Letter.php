<?php

namespace src;

class Letter
{
    public $name;

    /** @var  array */
    public $input;

    /** @var  array */
    public $output;

    /** @var array  */
    public $memory;

    public function __construct($name)
    {
        $this->output = 0;
        $this->name = $name;

        $this->memory = [];
    }

    public function iteratePixels($im)
    {
        array_map(function($i) use ($im){
            array_map(function($j) use ($i, $im){
                $rgb = imagecolorat($im, $i, $j);
                $pix = imagecolorsforindex($im, $rgb);
                $data = round(($pix['red'] + $pix['green'] + $pix['blue']) / 3);
                $this->memory[$i][$j] = $data;
            }, range(0, 29));
        }, range(0, 29));
    }

}

class Net {

    /** @var array  */
    public $letters;

    public function __construct()
    {
        $this->letters = array_map(function($i){
            return new Letter(chr(ord('A') + $i));
        }, range(0, 2));
        $this->initBlank();
    }

    public function iterateLetters()
    {
        $this->letters = array_map(function ($letter) {
            $im        = imagecreatefrompng("./img/{$letter->name}.png");
            $letter->memory = $this->iteratePixels($im, $letter->memory);
            imagedestroy($im);

            return $letter;
        }, $this->letters);
    }

    public function iteratePixels($im, array $memory)
    {
        return array_map(function($i) use ($im, $memory){
            array_map(function($j) use ($i, $im, $memory){
                $rgb = imagecolorat($im, $i, $j);
                $pix = imagecolorsforindex($im, $rgb);

                $data = round(($pix['red'] + $pix['green'] + $pix['blue']) / 3);
                $memory[$i][$j] = $data;
                return $memory;
            }, range(0, 29));
            return $memory;
        }, range(0, 29));
    }


    public function initBlank()
    {
        $im = imagecreatefrompng("./img/blank.png");
        /** @var Letter $letter */
        foreach ($this->letters as $letter) {
            $letter->iteratePixels($im);
        }
    }
}

class Main
{
    public function __construct()
    {
        $net = new Net();
    }
}


class Factory {

    public function init()
    {
        $letters = array_map(function($i){
            return new Letter(chr(ord('A') + $i));
        }, range(0, 2));

        $im = imagecreatefrompng('./img/A.png');
        $rgb = imagecolorat($im, 6, 15);
        $pix = imagecolorsforindex($im, $rgb);

        var_dump($pix);
        imagedestroy($im);
    }
}

//var_dump(chr(ord('A') + 2));
//(new Factory())->init();
//$n = (new Net());
//$n->iterateLetters();
//var_dump($n->letters);
new Main();

