<?php

class State
{
    private $check = true;

    public function check($func, $arg)
    {
        if ($this->check === true) {
//            $this->check = call_user_func("{$this->rulesClass}::{$func}", $arg); // $rules = $this->rules; $this->check = $rules::$func($arg);
            $this->check = call_user_func($func, $arg);
        }
        return $this;
    }

    public function reset()
    {
        $this->check = true;
    }

    public function getState()
    {
        return $this->check;
    }
}

class Validation2
{
    /**
     * @var State
     */
    private $state;
    private $rules;
    private $rulesClass;

    public function __construct(State $state, $rulesClass)
    {
        $this->state = $state;
        $this->rulesClass = $rulesClass;
        $this->rules = get_class_methods($rulesClass);
    }

    /**
     * @param $sXml
     * @return bool
     */
    public function validate($sXml)
    {
        $this->state->reset();
        foreach ($this->rules as $rule) {
            $this->state->check("{$this->rulesClass}::{$rule}", $sXml);
        }

        return $this->state->getState();
    }
}

class StdRules
{
    public static function is_empty($sXml)
    {
        var_dump('11');
        return (!isset($sXml->test)) ? false : true;
    }

    public static function check_name($sXml)
    {
        var_dump('22');
        return in_array($sXml->name, ['foo', 'bar']);
    }

    public static function check_user($sXml)
    {
        var_dump('33');
        return ($sXml->user === 'www');
    }
}

//function StdRules()
//{
//    return [
//        'is_empty' => function ($sXml) {
//            var_dump('11');
//            return (!isset($sXml->test)) ? false : true;
//        },
//
//        'check_name' => function ($sXml) {
//            var_dump('22');
//            return in_array($sXml->name, ['foo', 'bar']);
//        },
//
//        'check_user' => function ($sXml) {
//            var_dump('33');
//            return ($sXml->user === 'www');
//        },
//    ];
//}