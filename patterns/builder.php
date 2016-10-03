<?php
interface IPerson {
    function setGender();
    function setEmployed();
    function getResult();
}


class Person {
    public $employed;
    public $gender;
    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';
}

// Builder 1
class EmployedMan implements IPerson
{
    public $person;

    public function __construct()
    {
        $this->person = new Person();
    }

    public function setGender()
    {
        $this->person->gender = Person::GENDER_MALE;
    }

    public function setEmployed()
    {
        $this->person->employed = true;
    }
    public function getResult(){
        return $this->person;
    }
}

// Builder 2
class UnEmployedWoman implements IPerson {

    public $person;

    public function __construct()
    {
        $this->person = new Person();
    }

    public function setGender()
    {
        $this->person->gender = Person::GENDER_FEMALE;
    }

    public function setEmployed()
    {
        $this->person->employed = false;
    }

    public function getResult(){
        return $this->person;
    }
}

class Builder {
    public function build(IPerson $person){
        $person->setGender();
        $person->setEmployed();
        return $person->getResult();
    }
}

$d = new Builder();
$x = $d->build(new EmployedMan());

$y = $d->build(new UnEmployedWoman());

var_dump($x, $y);
