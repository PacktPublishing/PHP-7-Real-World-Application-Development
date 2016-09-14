<?php
// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// anchor classes
use Application\Web\Request;
$incoming = new Request();
echo '<pre>';
var_dump($incoming);
echo '</pre>';
