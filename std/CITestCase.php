<?php

/**
 * Base class for unit and integration tests for CodeIgniter
 *
 * This class wraps $CI reference for communicating with CodeIgniter,
 * as well as initializing database connection for assertions
 *
 * @author		Fernando Piancastelli
 * @link		https://github.com/fmalk/codeigniter-phpunit
 * @link		http://www.phpunit.de/manual/3.7/en/database.html
 *
 * @property-read resource	$db		Reference to database
 * @property CI_Controller	$CI	
 */
class CITestCase extends PHPUnit_Framework_TestCase //PHPUnit_Extensions_Database_TestCase
{
    /**
     * Reference to CodeIgniter
     *
     * @var resource
     */
    protected $CI;

    /**
     * Call parent constructor and initialize reference to CodeIgniter
     */
    public function __construct()
    {
        parent::__construct();
        $this->CI =& get_instance();
    }
}