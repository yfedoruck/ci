<?php

require_once $_SERVER['DOCUMENT_ROOT'] . 'std.php';

class PopTest extends PHPUnit_Framework_TestCase
{
    private $std;
    
    public function tearDown()
    {
//        $x = xhprof_disable();
//        print_r($x);
    }

    public function setUp()
    {
//        $keys = array('foo', 5, 10, 'bar' => 'zzz');
//        $a = array_fill_keys($keys, 'banana');
//        print_r($keys);
//        print_r($a);
//        die('qwe');


        $std = new stdClass();
        $std->a = 'aa';
        $std->b = 'bb';
        $std->c = 'cc';
        $this->std = $std;
    }

//    function testEnd()
//    {
//        $end = std_end($this->std);
//        $this->assertEquals($end, $this->std->c);
//    }

//    function testCurrent()
//    {
//        $end = std_current($this->std);
//        $this->assertEquals($end, $this->std->a);
//    }

//    function testInObject()
//    {
//        $result = std_in_object($this->std->a, $this->std);
//        $this->assertTrue($result);
//    }

//    public function testPop()
//    {
//        $popped = object_pop($this->std);
//        $popped2 = object_pop($this->std);
//        object_pop($this->std);
//        
//        var_dump($this->std);
//
//        $this->assertEquals($popped, 'cc');
//        $this->assertEquals($popped2, 'bb');
//        $this->assertEquals(count($this->std), 1);
//    }
    
    function test_change_key_case()
    {
        $obj = std::object_change_key_case($this->std, CASE_UPPER);
        $this->assertEquals('cc', $obj->C);
    }

    function test_object_count_values()
    {
        $data = (object)[1, "hello", 1, "world", "hello"];

        $obj = std::object_count_values($data);
        $this->assertEquals(2, $obj->hello);
    }

    function test_object_fill_keys()
    {
        $keys = (object)['foo', 5, 10, 'bar'];
        var_dump($keys);
        $obj = std::object_fill_keys($keys, 'banana');
        var_dump($obj);
        $this->assertEquals('banana', $obj->{10});
        $this->assertEquals('banana', $obj->bar);
    }

    function test_object_fill()
    {
        $obj1 = std::object_fill(5, 6, 'banana');
        $obj2 = std::object_fill(-2, 4, 'pear');
        $this->assertEquals('banana', $obj1->{5});
        $this->assertEquals('pear', $obj2->{-2});
    }

    function test_object_filter()
    {
		$odd = function($var)
		{
			return($var & 1);
		};
		$even = function($var)
		{
			return(!($var & 1));
		};
		$array1 = array("a" => 1, "b" => 2, "c" => 3, "d" => 4, "e" => 5);
		$array2 = array(6, 7, 8, 9, 10, 11, 12);
        $obj1 = std::object_filter((object)$array1, $odd);
        $obj2 = std::object_filter((object)$array2, $even);
        $this->assertEquals(3, $obj1->c);
        $this->assertEquals(6, $obj2->{0});
    }
}