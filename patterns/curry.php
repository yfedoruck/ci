<?php

function say($x){
    return function ($y) use ($x){
        return $x ." " . $y . "\n";
    };
}

$hello = say('Hello');
echo $hello('foo');
echo $hello('you');

$hi = say('Hi');
echo $hi('foo');
echo $hi('you');

echo say('bye')('you');

class Main {
    public function say($greet):callable
    {
        return function ($separator) use($greet) {
            return function($name) use($greet, $separator) {
                echo $greet.$separator.$name."\n";
            };
        };
    }
}

$m = new Main();
$m->say('Hi')(',')('you');
$m->say('It')(' works')('!');

$tpl = $m->say('Hey')(', ');
$tpl('you');
$tpl('john');

