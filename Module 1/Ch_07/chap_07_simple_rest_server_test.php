<?php
// using Application\Web\Client\Curl to test Application\Web\Rest\Server

$apiKey = include __DIR__ . '/api_key.php';

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// anchor classes
use Application\Web\Request;
use Application\Web\Client\Curl;
use Application\Web\Rest\CustomerApi;

//echo CustomerApi::generateToken();

// sample data for insert:
// {"name":"Test 2","balance":"0","email":"test2@unlikelysource.com","password":"password","status":"0","security_question":"Where do yo live","confirm_code":"","level":"BEG"}

// 	public function __construct($uri = NULL, $method = NULL, array $headers = NULL, array $data = NULL, array $cookies = NULL)
$request = new Request(
	'http://localhost:8080/',
	Request::METHOD_GET,
	NULL,
	[
		CustomerApi::ID_FIELD     => rand(1,79),
		CustomerApi::TOKEN_FIELD  => $apiKey,
		CustomerApi::LIMIT_FIELD  => $limit,
		CustomerApi::OFFSET_FIELD => $offset,
	],
	NULL
);

$received = Curl::send($request);
$data     = $received->getData();
var_dump($data);

