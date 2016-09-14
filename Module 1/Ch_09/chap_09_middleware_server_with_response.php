<?php
// to test this, open another terminal window and run:
// php -S localhost:8080 /path/to/source/chapter09/chap_09_middleware_server_with_response.php'

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\MiddleWare\ { Constants, ServerRequest, Response, Stream, TextStream };

$data = [
    1 => 'churchill.txt',
    2 => 'gettysburg.txt',
    3 => 'star_trek.txt'
];

$header[Constants::HEADER_CONTENT_TYPE] = 'application/json';
try {

    $body['text'] = 'Initial State';
    $request = new ServerRequest();
    $request->initialize();

    $code = 200;
    if ($request->getMethod() == Constants::METHOD_GET) {
        $id = $request->getQueryParams()['id'] ?? NULL;
        $id = (int) $id;
        if ($id && $id <= count($data)) {
            $header[Constants::HEADER_CONTENT_TYPE] = 'text/html';
            $body = new Stream(__DIR__ . '/' . $data[$id]);
        } else {
            $body = new TextStream(json_encode(['list' => $data]));
        }
    } elseif ($request->getMethod() == Constants::METHOD_POST) {
        $size = $request->getBody()->getSize();
        $body = new TextStream(json_encode(['success' => $size . ' bytes of data received']));
        if ($size) {
            $code = 201;
        } else {
            $code = 204;
        }
    }
} catch (Exception $e) {
    $code = 500;
    $body = new TextStream(json_encode(['error' => 'ERROR: ' . $e->getMessage()]));
}

$response = new Response($code, $body, $header);
$response->getHeaders();
echo $response->getBody()->getContents();
echo PHP_EOL;
var_dump($response);

