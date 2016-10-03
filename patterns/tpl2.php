<?php
namespace tpl2;

abstract class ATemplate
{
    final public function showInfo(Book $book)
    {
        echo "@@@---- {$this->processTitle($book->title)} ----@@@\n";
    }

    abstract protected function processTitle($title);
}

class Book
{
    public $title;

    public function __construct($t)
    {
        $this->title = $t;
    }
}

class TemplateStars extends ATemplate
{
    protected function processTitle($title)
    {
        return str_replace(" ", "*", $title);
    }
}

class TemplatePlus extends ATemplate
{
    protected function processTitle($title)
    {
        return str_replace(" ", "+", $title);
    }
}


if ($_GET['server'] === 'win') {
    $t = new TemplateStars();
} else {
    $t = new TemplatePlus();
}

$t->showInfo(new Book("Php for kottans", "John Dou"));