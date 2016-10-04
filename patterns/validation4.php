<?php

//namespace validation3;

abstract class State
{
    private $state;

    public function __construct($state = null)
    {
        $this->state = $state;
    }

    final public function getState()
    {
        return $this->state;
    }

    public function factory($state)
    {
        return new static($state);
    }

    abstract function exec($func, $arg);
}

class Verify extends State
{
    public function __construct()
    {
        parent::__construct(true);
    }

    public function exec($func, $arg)
    {
        $state = $this->getState();
        if ($state === true) {
            $state = call_user_func($func, $arg);
            return ($state === true) ? new Success($state) : new Fail($state);
        }
        return new Fail($state);
    }

    public function factory()
    {
        return parent::factory(true);
    }
}

class Fail extends State
{
    public function exec($func, $arg)
    {
        return new static($this->getState());
    }
}

class Success extends State
{
    public function exec($func, $arg)
    {
        $state = $this->getState();
        if ($state === true) {
            $state = call_user_func($func, $arg);
        }
        return ($state === true) ? new Success($state) : new Fail($state);
    }
}


class Validation4
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
        $state = $this->state->factory(true);
        var_dump($state);
        foreach ($this->rules as $rule) {
            $state = $state->exec("{$this->rulesClass}::{$rule}", $sXml);
            var_dump($state);
        }

        return $state->getState();
    }
}

class StdRules
{
    const EMPTY_PARAM = 'empty parameter';
    const WRONG_NAME = 'wrong user name';
    const WRONG_USER = 'wrong user';
    public static function is_empty($sXml)
    {
//        var_dump('11');
        return (!isset($sXml->test)) ? self::EMPTY_PARAM : true;
    }

    public static function check_name($sXml)
    {
//        var_dump('22');
        return in_array($sXml->name, ['foo', 'bar']) ? true : self::WRONG_NAME;
    }

    public static function check_user($sXml)
    {
        var_dump($sXml->user);
        var_dump(($sXml->user === 'www') ? true : self::WRONG_USER);
        return ($sXml->user === 'www') ? true : self::WRONG_USER;
    }
}