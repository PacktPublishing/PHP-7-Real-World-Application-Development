<?php
// understanding the abstract syntax tree

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
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
</body>
</html>
