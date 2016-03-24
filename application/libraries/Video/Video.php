<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Video  extends CI_Driver_Library {
    public $ci;
    public function __construct()
    {
        $this->ci = & get_instance();
        $this->valid_drivers = ['avi'];
    }

    public function foo(){
        echo "<br><b>"."-- base driver --"."</b><br>";
    }
}