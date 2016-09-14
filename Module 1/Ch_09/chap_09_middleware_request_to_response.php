<?php
// to test this, open another terminal window and run:
// php -S localhost:8080
// you can then run this program from the command line,
// or from a browser: http://localhost:8080/chap_09_middleware_server_with_response.php?id=3

define('TEST_SERVER', 'http://localhost:8080');

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\MiddleWare\ { Request, Stream, Constants, Uri };

$uri = new Uri();
$uri->withScheme('http')
    ->withHost('localhost')
    ->withPort('8080')
    ->withQuery('id=3')
    ->withPath('chap_09_middleware_server_with_response.php');

$ch = curl_init();

echo $uri . PHP_EOL;

// run cURL request
curl_setopt($ch, CURLOPT_URL, $uri->getUriString());
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
