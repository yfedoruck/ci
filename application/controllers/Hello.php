<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hello extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->output->delete_cache();
//        echo 'hello world';
        $this->load->model('test');
        $title = $this->test->getTitle();
        echo "<b>$title</b>";
//        $this->load->helper(['array', 'custom']);
//        helper_test();
//        my_helper();
        $data = [
            'message' => 'SomeMessage',
            'title' => $title,
            'items' => ['one', 'another', 'third']
        ];
//        var_dump(element('items', $data));
        $data2 = ['one', 'another', 'third'];
        $saved = $this->load->view('hello', '', true);
//        var_dump($saved);
//        $this->load->view('sub/hello2', $data);
//        $this->load->library('api');
//        $this->api->foo();
        $this->load->driver('cache');
        var_dump( $this->cache->dummy->get(1) );
        $this->load->driver('video');
        $this->video->foo();
        $this->video->avi->play();
//        $this->load->view('welcome_message');
//        $this->output->cache(60);


    }

    public function test($name='Joe', $age=22){
        echo 'another method';
        echo $name;
        echo $age;
    }

    public function test2(){
        echo 'remap test';
    }

//    public function _remap($method, $params = array()){
//        if($method == 'test'){
//            $this->test2();
//        }
//    }

//    public function _output($output){
//        echo 'finalize';
//        var_dump($output);
//        echo 'finalize';
//        var_dump($this->output->cache_expiration);
//    }
}