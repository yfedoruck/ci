<?php

namespace mediator4;

interface IMediator
{
    function display(User $user, $message);
}

abstract class User
{
    private $name;

    /**
     * @var IMediator
     */
    private $mediator;

    public function __construct($name, IMediator $mediator)
    {
        $this->name = $name;
        $this->mediator = $mediator;
    }

    public function getName()
    {
        return $this->name;
    }

    public function send($message)
    {
        $this->mediator->display($this, $message);
    }

    abstract function getType();
}


class SkypeUser extends User
{
    function getType() {
        return 'skype';
    }
    function callPhone(){}
}

class JabberUser extends User
{
    function getType() {
        return 'jabber';
    }
    function startOwnServer(){}
}

class ChatRoom implements IMediator
{
    public function display(User $user, $message)
    {
        echo "User {$user->getName()} from `{$user->getType()}` write: '{$message}'\n";
    }

}

$room = new ChatRoom();

$user1 = new SkypeUser('John', $room);
$user2 = new JabberUser('Mary', $room);

$user1->send('Hello here!');
$user2->send('Hi!');