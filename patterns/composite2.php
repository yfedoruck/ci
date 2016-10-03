<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

interface INode {
    function add(Node $x);
    function remove(Node $x);
    function getNode();
    function display();
}

abstract class Node implements INode {
    /**
     * @var string
     */
    protected $leaf;
    public function __construct($x){
        $this->leaf = $x;
    }
    public function getNode(){
        return $this->leaf;
    }

}

class Leaf extends Node {
    public function add(Node $x){}
    public function remove(Node $x){}
    public function display(){
        echo $this->leaf."<br>";
    }
}

class Tree extends Node {
    /**
     * @var [] $elements of Nodes
     */
    private $nodes;
    public function __construct($x){
        parent::__construct($x);
        $this->nodes = [];
    }

    public function add(Node $n){
        $this->nodes[$n->getNode()] = $n;
    }
    public function remove(Node $n){
        unset($this->nodes[$n->getNode()]);
    }
    public function display(){
        (new Leaf($this->leaf))->display();
        foreach ($this->nodes as $node) {
            $node->display();
        }
    }
}



$root = new Tree('root');
$root->add(new Leaf('subroot'));
$root->add(new Leaf('subroot2'));
$subtree = new Tree('subtree');
$subtree->add(new Leaf('A'));
$root->add($subtree);
$root->display();
echo "----<br>";
//$subtree->remove(new Leaf('A'));
//$root->remove($subtree);
$root->display();
