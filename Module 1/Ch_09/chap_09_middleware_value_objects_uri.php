<?php
// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// classes to use
use Application\MiddleWare\ { Constants, Uri };

$uri = new Uri();
$uri->withScheme('https')
    ->withHost('localhost')
    ->withPort('8080')
    ->withPath('chap_09_middleware_value_objects.php')
    ->withQuery('param=TEST');

echo $uri;
