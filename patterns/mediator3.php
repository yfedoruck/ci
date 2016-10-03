<?php

namespace mediator3;

interface IMediator {
    function showMessage(User $user, $message);
}

class User {
    private $name;
    private $mediator;
    public function __construct($name, IMediator $mediator){
        $this->name = $name;
        $this->mediator = $mediator;
    }
    public function send($message){
        $this->mediator->showMessage($this, $message);
    }
    public function getName(){
        return $this->name;
    }
}

class ChatRoom implements IMediator{
    public function showMessage(User $user, $message){
        echo "user {$user->getName()} write: $message";
        echo "<br>";
    }
}

$chat = new ChatRoom();
$user1 = new User('Alex', $chat);
$user2 = new User('Vetal', $chat);

$user1->send("You a' faggot");
$user2->send("Fuck you!");