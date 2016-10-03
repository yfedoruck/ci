<?php
namespace mediator;

interface IMediator
{
    function send($message, Colleague $colleague);
}

abstract class Colleague
{

    /**
     * @var IMediator
     */
    private $mediator;

    public function __construct(IMediator $mediator)
    {
        $this->mediator = $mediator;
    }

    public function send($message)
    {
        $this->mediator->send($message, $this);
    }

    public abstract function notify($message);
}

class Mediator implements IMediator
{
    /**
     * @var Colleague
     */
    private $colleague1;
    /**
     * @var Colleague
     */
    private $colleague2;

    public function setColleague1(Colleague $colleague)
    {
        $this->colleague1 = $colleague;
    }

    public function setColleague2(Colleague $colleague)
    {
        $this->colleague2 = $colleague;
    }

    public function send($message, Colleague $colleague)
    {
        if ($colleague == $this->colleague1) {
            $this->colleague2->notify($message);
        } else {
            $this->colleague1->notify($message);
        }
    }
}

class Colleague1 extends Colleague
{
    public function notify($message)
    {
        echo "Colleague1 gets message: " . $message . "<br>";
    }
}

class Colleague2 extends Colleague
{
    public function notify($message)
    {
        echo "Colleague2 gets message: " . $message . "<br>";
    }
}

$mediator = new Mediator();
$colleague1 = new Colleague1($mediator);
$colleague2 = new Colleague2($mediator);
$mediator->setColleague1($colleague1);
$mediator->setColleague2($colleague2);

$colleague1->send('Hello, how are you?');
$colleague2->send('Hi! I"m fine!');
