<?php
namespace bridge;

interface IDraw{
    function drawLine();
}

class BoldLine implements IDraw {
    public function drawLine(){
        echo "<b>draw line</b>\n";
    }
}

class ItalicLine implements IDraw {
    public function drawLine(){
        echo "<i>draw line</i>\n";
    }
}
class Shape {
    public $draw;

    public function __construct(IDraw $draw){
        $this->draw = $draw;
    }

    public function drawShape(){
        $this->draw->drawLine();
    }
}

$shapes = [
    new Shape(new BoldLine()),
    new Shape(new ItalicLine()),
];
foreach($shapes as $shape){
    $shape->drawShape();
}