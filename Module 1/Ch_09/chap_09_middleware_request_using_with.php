<?php
// to test this, open another terminal window and run:
// php -S localhost:8080 /path/to/source/chapter09/chap_09_middleware_server.php'

define('READ_FILE', __DIR__ . '/gettysburg.txt');
define('TEST_SERVER', 'http://localhost:8080');

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\MiddleWare\ { Request, Stream, Constants, Uri };

$body = new Stream(READ_FILE);
$uriObj = new Uri(TEST_SERVER);
$request = new Request();
$request->withRequestTarget(TEST_SERVER)
        ->withMethod(Constants::METHOD_POST)
        ->withBody($body)
        ->withHeader(Constants::HEADER_CONTENT_TYPE, Constants::CONTENT_TYPE_FORM_ENCODED)
        ->withAddedHeader(Constants::HEADER_CONTENT_LENGTH, $body->getSize());

$data = http_build_query(['data' => $request->getBody()->getContents()]);

$defaults = array(
    CURLOPT_URL => $request->getUri()->getUriString(),
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $data,
);
$ch = curl_init();
curl_setopt_array($ch, $defaults);
$response = curl_exec($ch);
curl_close($ch);
echo $response;
