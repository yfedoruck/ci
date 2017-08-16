<?php

namespace src;

class Letter
{
    public $name;
    public $weight;

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

    public function setInput($im)
    {
        array_map(function($i) use ($im){
            array_map(function($j) use ($i, $im){
                $rgb = imagecolorat($im, $i, $j);
                $pix = imagecolorsforindex($im, $rgb);
                $this->input[$i][$j] = round(($pix['red'] + $pix['green'] + $pix['blue']) / 3);
            }, range(0, 29));
        }, range(0, 29));
    }

    public function recognize()
    {
        array_map(function($i){
            array_map(function($j) use ($i){
                $input = $this->input[$i][$j];
                $memory = $this->memory[$i][$j];
                if (abs($input - $memory) < 120 && $input < 250) {
                    ++$this->weight;
                }
                if ($input !== 0){
                    if($input < 250){
                        $memory = round( ($memory + ($memory + $input)/2)/2);
                    }
                    $this->memory[$i][$j] = $memory;
                }elseif ($memory !==0){
                    if($input < 250){
                        $memory = round( ($memory + ($memory + $input)/2)/2);
                    }
                }
                $this->memory[$i][$j] = $memory;
            }, range(0, 29));
        }, range(0, 29));
    }

    public function save($name)
    {
        $im = imagecreatetruecolor(30, 30);
        array_map(function($i) use ($name, $im){
            array_map(function($j) use ($i, $name, $im){
                $color = imagecolorallocate ($im, $this->memory[$i][$j], $this->memory[$i][$j], $this->memory[$i][$j]);
                imagesetpixel($im, $i, $j, $color);
            }, range(0, 29));
        }, range(0, 29));
        imagepng($im, "./db/{$name}.png");
        imagedestroy($im);
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

    public function learnLetters()
    {
        array_map(function (Letter $letter) {
            $im             = imagecreatefrompng("./img/{$letter->name}.png");
            $letter->iteratePixels($im);
            imagedestroy($im);
        }, $this->letters);
    }

    public function work()
    {
        $im = imagecreatefrompng("./img/K.png");
        array_map(function (Letter $letter) use ($im) {
            $letter->setInput($im);
            $letter->recognize();
            $letter->save($letter->name);
        }, $this->letters);
        imagedestroy($im);
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
        $net->learnLetters();
        $net->work();
//        var_dump($net->letters[0]); die();
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

