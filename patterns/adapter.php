<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

class Twitter {
    public function postTweet($msg){
        echo 'post to Twitter: '."$msg<br>";
    }
}

class Facebook{
    public function postNote($msg){
        echo 'post to Facebook: '."$msg<br>";
    }
}

$t = new Twitter();
$t->postTweet('message body');

$f = new Facebook();
$f->postNote('message body');

// implement Adapter

interface Service {
    function post($msg);
}

class TwitterAdapter implements Service {
    private $service;

    public function __construct(){
        $this->service = new Twitter();
    }

    public function post($m){
        $this->service->postTweet($m);
    }
}

class FacebookAdapter implements Service {
    private $service;

    public function __construct(){
        $this->service = new Facebook();
    }
    public function post($m){
        $this->service->postNote($m);
    }
}

$t = new TwitterAdapter();
$t->post('post message to tw');

$f = new FacebookAdapter();
$f->post('mess to facebook');


