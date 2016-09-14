<?php
define('CACHE_DIR', __DIR__ . '/cache');

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\Security\PassGen;

$source = [
	'https://www.gutenberg.org/files/4300/4300-0.txt',
	'https://www.gutenberg.org/files/2600/2600-h/2600-h.htm',
	'https://www.gutenberg.org/files/1342/1342-h/1342-h.htm',
];

$passGen = new PassGen($source, 4, CACHE_DIR);

echo $passGen->generate() . PHP_EOL;
echo $passGen->generate() . PHP_EOL;
echo $passGen->generate() . PHP_EOL;
