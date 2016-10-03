<?php
namespace validation;


class VTest extends \TestCase
{
    protected $obj;
    protected $egt_user;
    protected $egt_password;
    protected $sXml;

    public function test1()
    {
        $v = new \Validation2(new \State(), 'StdRules');
        $data = (object)['user' => 'www', 'name' => 'bar', 'test'=>1];
        $this->assertTrue($v->validate($data));

        unset($data->test);
        $this->assertFalse($v->validate($data));

        $data->test=1;
        $data->user = 'qwer';
        $this->assertFalse($v->validate($data));

        $data->user = 'www';
        $this->assertTrue($v->validate($data));

        $data->name = '123';
        $this->assertFalse($v->validate($data));
    }

    public function test2()
    {
//        $v = new \Validation2();
    }
}