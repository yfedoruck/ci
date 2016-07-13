<?php

/*
 *---------------------------------------------------------------
 * OVERRIDE FUNCTIONS
 *---------------------------------------------------------------
 *
 * This will "override" later functions meant to be defined
 * in core\Common.php, so they throw errors instead of output strings
 */

function show_error($message, $status_code = 500, $heading = 'An Error Was Encountered')
{
    throw new PHPUnit_Framework_Exception($message, $status_code);
}

function show_404($page = '', $log_error = TRUE)
{
    throw new PHPUnit_Framework_Exception($page, 404);
}

/*
 *---------------------------------------------------------------
 * BOOTSTRAP
 *---------------------------------------------------------------
 *
 */

$webRoot = dirname(__FILE__) . '/';
$_SERVER['FRONTEND_NUM'] = 1;
$_SERVER['PARTNER_ID'] = 1;
$_SERVER['DOCUMENT_ROOT'] = $webRoot;
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
$_SERVER['SERVER_NAME'] = 'phpunit';
//require_once $webRoot .'index.php';
//require_once dirname(__FILE__) . '/CITestCase.php';
/*
 * This will autoload controllers inside subfolders
 */
//spl_autoload_register(function ($class) {
//    $webRoot = dirname(__FILE__) . '/../';
//    foreach (glob($webRoot.'std/'.strtolower($class).'.php') as $controller) {
//        require_once $controller;
//    }
//});