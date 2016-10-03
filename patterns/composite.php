<?php

abstract class Component {
    protected $name;

    public function __construct($name){
        $this->name = $name;
    }

    abstract public function add( Component $c );
    abstract public function remove( Component $c );
    abstract public function display();
}

class Tree extends Component {
    private $children;

    public function add( Component $c ){
        $this->children[$c->name] = $c;
    }
    public function remove( Component $c ){
        unset($this->children[$c->name]);
    }
    public function display(){
        echo $this->name . "<br>";
        foreach ( $this->children as $child) {
            $child->display();
        }
    }
}

class Leaf extends Component {

    public function add( Component $c ){
    }
    public function remove( Component $c ){
    }
    public function display(){
        echo $this->name."<br>";
    }
}

$root = new Tree('root');
$root->add(new Leaf('leaf1'));
$root->add(new Leaf('leaf2'));

$tree = new Tree('subtree');
$tree->add( new Leaf('A') );
$tree->add( new Leaf('B') );

$root->add($tree);

$root->display();
