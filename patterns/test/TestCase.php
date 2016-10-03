<?php

/**
 * Base class for unit and integration tests for CodeIgniter
 *
 * This class wraps $CI reference for communicating with CodeIgniter,
 * as well as initializing database connection for assertions
 *
 * @author        Fernando Piancastelli
 * @link        https://github.com/fmalk/codeigniter-phpunit
 * @link        http://www.phpunit.de/manual/3.7/en/database.html
 *
 * @property-read resource $db        Reference to database
 */
class TestCase extends PHPUnit_Framework_TestCase //PHPUnit_Extensions_Database_TestCase
{
    /**
     * Reference to CodeIgniter
     *
     * @var resource
     */
    protected $debug = false;

    /**
     * Call parent constructor and initialize reference to CodeIgniter
     */
    public function __construct()
    {
        parent::__construct();
        $this->debug = $this->is_debug();
    }

    public static function backup_func($class, $func)
    {
        static $backup_func = [];
        if (!isset($backup_func[$func])) {
            $backup_func[$func] = self::getFunctionString($class, $func);
        }
        return $backup_func[$func];
    }

    private static function getFunctionString($class, $function)
    {
        $func = new \ReflectionMethod($class, $function);
        $filename = $func->getFileName();
        $start_line = $func->getStartLine() + 1;
        $end_line = $func->getEndLine() - 1;
        $length = $end_line - $start_line;
        $source = file($filename);
        $body = trim(implode("", array_slice($source, $start_line, $length)));
        return $body;
    }

    private function is_debug()
    {
        global $argv;
        return end($argv) == 'd';
    }
}