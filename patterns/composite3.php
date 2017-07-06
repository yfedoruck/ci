<?php
namespace composite3;

error_reporting(E_ALL);
ini_set('display_errors', 'On');

interface INode {
    function getName();
    function display();
}

interface ITree extends INode {
    function add(INode $x);
    function remove(INode $x);
}

class Node implements INode
{
    /** @var  string */
    private $name;
    private $level;

    public function __construct($x, $level = ''){
        $this->name = $x;
        $this->level = $level;
    }
    public function getName()
    {
        return $this->name;
    }
    public function display(){
        echo $this->level . $this->name."\n";
    }
}

class Tree implements ITree {
    /**
     * @var [] $elements of Nodes
     */
    private $nodes;

    /** @var  INode */
    private $root;

    public function __construct(INode $x){
        $this->root = $x;
        $this->nodes = [];
    }

    public function getName(){
        return $this->root->getName();
    }

    public function add(INode $n){
        $this->nodes[$n->getName()] = $n;
    }

    public function remove(INode $n){
        unset($this->nodes[$n->getName()]);
    }

    public function display(){
        $this->root->display();
        foreach ($this->nodes as $node) {
            $node->display();
        }
    }
}



$root = new Tree(new Node('root'));
$root->add(new Node('subroot', '-'));
$root->add(new Node('subroot2', '-'));
$subtree = new Tree(new Node('tree', '-'));
$subtree->add(new Node('A', '--'));
$subtree->add(new Node('B', '--'));
$root->add($subtree);
//$root->display();
//$root->remove($subtree);
$subtree->remove(new Node('A'));
$root->display();
//echo "----<br>";
//$root->remove(new Node('A'));
