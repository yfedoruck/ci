<?php

$x = new stdClass();
$x->{0} = 1;
$x->{"1"} = 2;
//$x->{'2'} = '3';
//$x->asdfqwer = '3';


/*var_dump(end($x));
var_dump(key($x));
var_dump(reset($x));*/

var_dump($x);
//var_dump($x->{0});

//var_dump(in_array('a', ['a','b'])); //var_dump(in_array(1, $x)); //var_dump(array_pop($x));

$obj = (object)array("0" => 'foo', 'bee', '4' => 'bar');
var_dump($obj); // outputs 'int(1)'
var_dump(isset($obj->{0})); // outputs 'bool(false)'

$std = new stdClass();
foreach ($obj as $key => $item) {
    $std->{$key} = $item;
}
//var_dump($std);

var_dump($obj->{'0'});


//$multiArray = ['55' => '55', 'a' => 123, 'b' => ['bb' => 22, 'cc' => 33]];
//$multiArray = ["0" => '55', 'a' => 123];
//$js = json_encode($multiArray);
//$ob2 = (object)$multiArray;
//var_dump($ob2);
//$i='0';
//var_dump($ob2->{$i});


//            set_error_handler(function($errno, $errstr, $errfile, $errline, array $errcontext) {
//                throw new ErrorException($errstr);
//            });
//            try{
//                array_change_key_case($input);
//            }catch( ErrorException $e){
//                var_dump($e);
//                $msg = str_replace('array', 'object', $e->getMessage());
//                echo $msg;
//            }
//            restore_error_handler();
