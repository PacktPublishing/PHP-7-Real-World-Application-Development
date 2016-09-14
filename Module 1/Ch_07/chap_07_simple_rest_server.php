<?php
// simple REST server
$dbParams = include __DIR__ .  '/../config/db.config.php';

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// classes to use
use Application\Web\Rest\Server;
use Application\Web\Rest\CustomerApi;

//echo Api::generateToken();
$apiKey = include __DIR__ . '/api_key.php';
$server = new Server(new CustomerApi([$apiKey], $dbParams, 'id'));
$server->listen();
