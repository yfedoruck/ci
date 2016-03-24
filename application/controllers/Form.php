<?php
defined("BASEPATH") or exit("No direct script access allowed");

/**
 *
 * Class Form
 */
class Form extends CC_Controller
{
    public function index()
    {
        $this->load->helper(['form', 'url']);
        $this->load->library('form_validation');
//        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $this->form_validation->set_rules('username', 'lang:Username', ['required', 'callback_username_check', ['my_username_rule', function($s){
            if ($s == 'qwe') {
                $this->form_validation->set_message('my_username_rule', 'word "qwe" in {field} is not allowed');
                return false;
            } else {
                return true;
            }
        }],'trim']);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', ['You must provide a %s.']);
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]',
            ['required' => 'is required', 'matches' => 'Password must be the same.']);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email',
            ['valid_email' => 'set valid email, please']);

        if ($this->form_validation->run() == false) {
            $this->load->view('form/form');
        } else {
            $this->load->view('form/success');
        }
    }

    public function username_check($str)
    {
        if ($str == 'test') {
            $this->form_validation->set_message('username_check', 'The {field} field can not be the word "test"');
            return false;
        } else {
            return true;
        }
    }
}