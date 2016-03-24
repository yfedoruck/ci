<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Api {
    public $ci;
    public function __construct()
    {
        $this->ci = & get_instance();
    }
    
    public function foo(){

        echo "<br><b>".$this->ci->config->item('log_file_permissions')."</b><br>";
        echo "<br>foo method<br>";
        var_dump(is_https());
        $this->ci->load->driver('cache');
        var_dump($this->ci->cache->dummy);
        var_dump($this->ci->cache->dummy->get_metadata(1));
    }
}