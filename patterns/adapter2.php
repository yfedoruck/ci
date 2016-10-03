<?php

class Twitter {
    public function postTweet(){
        echo 'post to Twitter'."<br>";
    }
}

class Vk {
    public function postToVk(){
        echo "post to Vk"."<br>";
    }
}

$tw = new Twitter();
$tw->postTweet();

$vk = new Vk();
$vk->postToVk();

interface ISocial {
    function postMessage();
}

class ServiceFactory {
    public static function createService($type){
        switch($type){
            case 'vk' :
                $service = new Vk();
                break;
            case 'twitter' :
                $service = new Twitter();
                break;
            default :
                throw new Exception('error');
        }
        return $service;
    }
}

class VkAdapter implements ISocial {

    private $service;

    public function __construct(){
        $this->service = ServiceFactory::createService('vk');
    }
    public function postMessage(){
        $this->service->postToVk();
    }
}

class TwitterAdapter implements ISocial {
    private $service;

    public function __construct(){
        $this->service = ServiceFactory::createService('twitter');
    }

    public function postMessage(){
        $this->service->postTweet();
    }
}

$tw = new TwitterAdapter();
$tw->postMessage();

$vk = new VkAdapter();
$vk->postMessage();