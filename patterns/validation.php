<?php

class Validation
{

    private $check = true;

    private function check($func, $arg)
    {
        if ($this->check === true) {
            $this->{$func}($arg);
        }
        return $this;
    }

    /**
     * @see is_empty, check_name, check_user
     * @param stdClass $sXml
     * @return bool
     */
    public function validate(stdClass $sXml)
    {
        $this->check('is_empty', $sXml)
            ->check('check_name', $sXml)
            ->check('check_user', $sXml);

        return $this->check;
    }

    public function reset()
    {
        $this->check = true;
    }

    private function is_empty($sXml)
    {
        $this->check = (!isset($sXml->test)) ? false : true;
    }

    private function check_name($sXml)
    {
        $this->check = in_array($sXml->name, ['foo', 'bar']);
    }

    private function check_user($sXml)
    {
        $this->check = ($sXml->user === 'www');
    }
}