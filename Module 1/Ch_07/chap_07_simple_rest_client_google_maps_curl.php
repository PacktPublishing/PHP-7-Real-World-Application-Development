<?php
// public APIs: https://market.mashape.com/
// google maps driving directions
// API key:
// see: https://developers.google.com/maps/documentation/directions/get-api-key
// see: https://developers.google.com/maps/documentation/directions/intro#Introduction
// example:
// https://maps.googleapis.com/maps/api/directions/json?origin=Toronto&destination=Montreal&key=YOUR_API_KEY

define('DEFAULT_ORIGIN', 'New York City');
define('DEFAULT_DESTINATION', 'Redondo Beach');
define('DEFAULT_FORMAT', 'json');
$apiKey = include __DIR__ . '/google_api_key.php';

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// anchor classes
use Application\Web\Request;
use Application\Web\Client\Curl;

// get start and end
$start = $_GET['start'] ?? DEFAULT_ORIGIN;
$end   = $_GET['end'] ?? DEFAULT_DESTINATION;
$start = strip_tags($start);
$end   = strip_tags($end);

// https://maps.googleapis.com/maps/api/directions/%s?origin=%s&destination=%s&key=%s
$request = new Request(
	'https://maps.googleapis.com/maps/api/directions/json',
	Request::METHOD_GET,
	NULL,
	['origin' => $start, 'destination' => $end, 'key' => $apiKey],
	NULL
);

$received = Curl::send($request);
$routes   = $received->getData()->routes[0];
//echo '<pre>', var_dump($routes), '</pre>'; exit;
include __DIR__ . '/chap_07_simple_rest_client_google_maps_template.php';
