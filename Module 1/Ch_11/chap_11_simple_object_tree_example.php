<?php
// simple object tree example

// setup class autoloading
require __DIR__ . '/../../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/../..');

use Application\Generic\Node as Node;

$tree = new Application\Generic\Tree();
$tree->grand  = new Node('GrandPa');
$tree->grand->father = new Node('Father');
$tree->grand->father->son = new Node('Son');
var_dump($tree->grand, $tree->grand->father, $tree->grand->father->son);
// TODO: build a var_dump() equivalent which can parse the tree structure
