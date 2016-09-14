<?php
// represent a series of HTML pages with links as a tree

// setup class autoloading
require __DIR__ . '/Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__);

// modify as needed
define('DEFAULT_URL', 'http://oreilly.com/');

// get URL and tag to search
// NOTE: the PHP 7 null coalesce operator is used
//       doesn't matter of the param is missing or not: no notices are generated
$url = strip_tags($_GET['url'] ?? DEFAULT_URL);

// get tree parse class
$tree = new Application\Parse\WebTree();
$tree->buildWebTree($url, 1);
echo '<pre>';
echo PHP_EOL;
echo $tree->renderTreeAscii();
echo '</pre>';
