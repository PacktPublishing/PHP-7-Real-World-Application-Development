<?php
// to test this, open another terminal window and run:
// php -S localhost:8080 /path/to/source/chapter09/chap_09_middleware_server.php'

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\MiddleWare\ServerRequest;

$request = new ServerRequest();
$request->initialize();
echo '<pre>', var_dump($request),'</pre>';
