<?php

/*
 *---------------------------------------------------------------
 * BOOTSTRAP
 *---------------------------------------------------------------
 *
 */

require_once dirname(__FILE__) . '/TestCase.php';
/*
 * This will autoload controllers inside subfolders
 */

spl_autoload_register(function ($class) {
    $class = strtolower($class);
    foreach (glob(dirname(__FILE__)."/../{$class}.php") as $file) {
        require_once $file;
    }
});