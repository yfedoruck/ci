<?php
namespace singleton2;

abstract class Singleton
{
    /**
     * @return Singleton
     */

    final public static function getInstance()
    {
        static $instance = null;
        
        if (null === $instance)
        {
            $instance = new static();
        }

        return $instance;
    }

    final protected function __clone() {}
    protected function __construct() {}
}

class Foo extends Singleton {

}

class Bar extends Singleton {

}

var_dump(Foo::getInstance()); // object(Foo)[1]
var_dump(Bar::getInstance()); // object(Bar)[2]
