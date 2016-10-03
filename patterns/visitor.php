<?php
namespace visitor;

interface Visitee {
    function accept(Visitor $visitor);
}

interface Visitor {
    function visitBook(BookVisitee $visitee);
    function visitSoft(SoftVisitee $visitee);
}


class BookVisitee implements Visitee {
    public $author;
    public $title;

    public function __construct($author, $title){
        $this->author = $author;
        $this->title = $title;
    }

    public function accept(Visitor $visitor){
        $visitor->visitBook($this);
    }
}

class SoftVisitee implements Visitee {
    public $company;
    public $title;

    public function __construct($company, $title){
        $this->company = $company;
        $this->title = $title;
    }

    public function accept(Visitor $visitor){
        $visitor->visitSoft($this);
    }
}

class SimpleVisitor implements Visitor {
    public $description;

    public function visitBook(BookVisitee $visitee){
        $this->description = $visitee->title . " by author " . $visitee->author;
    }

    public function visitSoft(SoftVisitee $visitee){
        $this->description = $visitee->title . " by company " . $visitee->company;
    }
}


class FunnyVisitor implements Visitor {
    public $description;

    public function visitBook(BookVisitee $visitee){
        $this->description = $visitee->title . " $$ by author $$ " . $visitee->author;
    }

    public function visitSoft(SoftVisitee $visitee){
        $this->description = $visitee->title . " %% by company %% " . $visitee->company;
    }
}


$simple = new SimpleVisitor();
$funny = new FunnyVisitor();


$book = new BookVisitee("Met Zandstra", "Php design patterns");
$soft = new SoftVisitee("Jet Brains", "PhpStorm");

$book->accept($simple);
p($simple->description);

$soft->accept($simple);
p($simple->description);

$book->accept($funny);
p($funny->description);

$soft->accept($funny);
p($funny->description);

function p($x){
    echo $x . "<br>";
}