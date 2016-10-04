<?php
//namespace validation3;

class State
{
    private $state;

    public function __construct($state = true)
    {
        $this->state = $state;
    }

    public function check($func, $arg)
    {
        if ($this->state === true) {
            $this->state = call_user_func($func, $arg);
            return new self($this->state);
        }
        return new self(false);
    }

    public function reset()
    {
        return new self();
    }

    public function getState()
    {
        return $this->state;
    }
}

class Validation3
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
        $state = $this->state->reset();
        foreach ($this->rules as $rule) {
            $state = $state->check("{$this->rulesClass}::{$rule}", $sXml);
        }

        return $state->getState();
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