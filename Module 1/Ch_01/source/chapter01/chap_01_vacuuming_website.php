<?php
// hoovering a website

// setup class autoloading
require __DIR__ . '/../../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/../..');

// get "vacuum" class
$vac = new Application\Web\Hoover();

// modify as needed
define('DEFAULT_URL', 'http://oreilly.com/');
define('DEFAULT_TAG', 'a');

// get URL and tag to search
// NOTE: the PHP 7 null coalesce operator is used
//       doesn't matter of the param is missing or not: no notices are generated
$url = strip_tags($_GET['url'] ?? DEFAULT_URL);
$tag = strip_tags($_GET['tag'] ?? DEFAULT_TAG);

echo 'Dump of Tags: ' . PHP_EOL;
var_dump($vac->getTags($url, $tag));
