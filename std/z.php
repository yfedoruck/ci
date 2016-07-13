<?php
include "std.php";

$f = std::object_chunk((object)[
    'aa' => 123,
    'aaa' => 123,
    'aaaa' => 123,
], 2, true);
var_dump($f);


$d = (object)['asdfsadf' => 2];
/**
 * Pure distinct transformation
 */
$a = ['8' => 3, 7, '^"^^\'^'];
$o = (object)$a;
//var_dump($a);
//var_dump($o);
//var_dump((array)$o);


//var_dump((object)['0' => '0', 1, '1' => 0, 7, '^"^^\'^']);
$a = [5, '6', 7];
//var_dump([5,'6',7]);
$x = (object)[5, '6', 7];
$x = std::object($a);
$f = std::object_chunk($x, 2);


$xx = (object)[
    'aa' => 123,
    'aaa' => 123,
    'aaaa' => 123,
];
print_r($xx); echo "\n";

$f = std::object_chunk((object)[
    'aa' => 123,
    'aaa' => 123,
    'aaaa' => 123,
], 2, true);
var_dump($f);

var_dump(array_chunk([
    'aa' => 123,
    'aaa' => 123,
    'aaaa' => 123,
], 2, false));


var_dump(array_column([
    'aa' => 123,
    ['aaa' => 1234444],
    'aaaa' => 123,
], 'aaa'));

$x = std::object_combine((object)['a','b'], (object)['c','d']);
$x = std::object_count_values((object)['a','b'], (object)['c','d']);
var_dump($x); 