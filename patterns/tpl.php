<?php
namespace tpl1;
function p($x)
{
    echo "{$x}\n";
}

abstract class ATemplate
{
    final public function showInfo(Book $book)
    {
        $title = $book->getTitle();
        $author = $book->getAutor();
        $processedTitle = $this->processTitle($title);
        $processedAuthor = $this->processAuthor($author);
        if (!$processedAuthor) {
            $info = $processedTitle;
        } else {
            $info = $processedTitle . " by " . $processedAuthor;
        }
        return $info;
    }

    abstract function processTitle($title);

    function processAuthor($author)
    {
        return null;
    }
}

class Book
{
    private $author;
    private $title;

    public function __construct($t, $a)
    {
        $this->title = $t;
        $this->author = $a;
    }

    public function getAutor()
    {
        return $this->author;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function bookInfo()
    {
        return $this->getTitle() . " by " . $this->getAutor();
    }
}

class TemplateStars extends ATemplate
{
    public function processTitle($title)
    {
        return str_replace(" ", "*", $title);
    }
}

class TemplatePlus extends ATemplate
{
    public function processTitle($title)
    {
        return str_replace(" ", "+", $title);
    }

    public function processAuthor($author)
    {
        return str_replace(" ", "+", $author);
    }
}

$b = new Book("Php for kottans", "John Dou");

$s = new TemplateStars();
p($s->showInfo($b));

$p = new TemplatePlus();
p($p->showInfo($b));