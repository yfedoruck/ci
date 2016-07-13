<?php

function change_key_case($input, $case = CASE_LOWER)
{
    $output = new stdClass();
    foreach ($input as $key => $value) {
        if ($case === CASE_LOWER) {
            $output->{strtolower($key)} = $value;
        } else {
            $output->{strtoupper($key)} = $value;
        }
    }
    return $output;
}

function change_key_case2($input, $case = CASE_LOWER)
{
    $arrOutput = array_change_key_case((array)$input, $case);
    return (object)$arrOutput;
}


$a = [];
for ($i = 0; $i < 100000; $i++) {
    $a[] = 'AAAAAABBBBBBBBBBBBBBBBBBBBBBCCCCCCCCCCCCCC';
}
$o = (object)$a;

$start1 = microtime(true);
change_key_case($o);

$time1 = microtime(true) - $start1;

/*************************************/

$start2 = microtime(true);
change_key_case2($o);

$time2 = microtime(true) - $start2;

/*************************************/
$start3 = microtime(true);
array_change_key_case($a);
$time3 = microtime(true) - $start3;

/*************************************/
$start4 = microtime(true);
(object)$a;
$time4 = microtime(true) - $start4;


echo $time1 . "\n";
echo $time2 . "\n";
echo $time3 . "\n";
echo $time4 . "\n";

//$y = new stdClass();
//$y->asdfqwer = '3';
//var_dump(array_change_key_case($y));
