<?php
namespace state3;

interface IDoor {
    function open();
    function close();
    function lock();
    function unlock();
}

abstract class ADoor implements  IDoor {
    public function open(){
        throw new \Exception;
    }
    public function close(){
        throw new \Exception;
    }
    public function lock(){
        throw new \Exception;
    }
    public function unlock(){
        throw new \Exception;
    }
}

class OpenedDoor extends ADoor {
    public function close(){
        return new ClosedDoor();
    }
}

class ClosedDoor extends ADoor {
    public function open(){
        return new OpenedDoor();
    }
    public function lock(){
        return new LockedDoor();
    }
}

class LockedDoor extends ADoor {
    public function unlock(){
        return new ClosedDoor();
    }
}
class Door {
    /**
     * @var IDoor
     */
    private $_door;

    public function __construct(IDoor $door){
        $this->_door = $door;
    }
    public function open(){
        $this->_door = $this->_door->open();
    }

    public function lock(){
        $this->_door = $this->_door->lock();
    }
    public function close(){
        $this->_door = $this->_door->close();
    }
    public function unlock(){
        $this->_door = $this->_door->unlock();
    }

    public function isOpened(){
        return $this->_door instanceof OpenedDoor;
    }
    public function isClosed(){
        return $this->_door instanceof ClosedDoor;
    }
    public function isLocked(){
        return $this->_door instanceof LockedDoor;
    }
    public function show(){
        echo("Is opened: "); var_dump($this->isOpened()); echo "<br>";
        echo("Is closed: "); var_dump($this->isClosed()); echo "<br>";
        echo("Is locked: "); var_dump($this->isLocked()); echo "<br>";
    }
}

$door = new Door(new OpenedDoor());
$door->close();
$door->show();
$door->open();
$door->show();

