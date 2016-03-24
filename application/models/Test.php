<?php

class Test extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    public function getTitle()
    {
        $this->load->helper(['array', 'custom']);
        my_helper();
        return 'Title from model';
    }
}