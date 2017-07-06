<?php

namespace mediator6;

interface User
{
    function say($message);
}

interface Chat {
    function talk($message);
}

class FbUser implements User
{
    /** @var Chat */
    public $chat;

    public function say($message)
    {
        $this->chat->talk($message);
    }
}

class VkUser implements User
{
    /** @var  Chat */
    public $chat;

    public function say($message)
    {
        $this->chat->talk($message);
    }
}

class ChatRoom implements Chat
{
    // provide the same behaviour for different users
    public function talk($message)
    {
        echo "User say: '*** {$message} ****'\n";
    }
}

//
$chat = new ChatRoom();

$fb = new FbUser();
$fb->chat = $chat;

$vk = new VkUser();
$vk->chat = $chat;

$fb->say('hello here');
$vk->say('hi there');
