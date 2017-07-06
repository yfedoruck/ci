<?php
namespace mediator5;

class User
{
    public $name;

    /**
     * @var ChatRoom
     */
    public $chat;

    public function say($message)
    {
        $this->chat->say($this->name, $message);
    }
}

class FbUser extends User
{
}

class VkUser extends User
{
}

class ChatRoom
{
    /** provide the same behaviour for different users  */
    public function say($name, $message)
    {
        echo "User {$name} say: {$message}\n";
    }
}

//
$chat = new ChatRoom();

$fb = new FbUser();
$fb->name = 'FB';
$fb->chat = $chat;

$vk = new VkUser();
$vk->name = 'VK';
$vk->chat = $chat;

$fb->say('hello here');
$vk->say('hi there');
