<?php
// target: localhost:8080 
// to run test: 
// #1 change to /path/to/cookbook/files/source/chapter07
// #2 php -S localhost:8080 chap_07_simple_soap_server.php
// #3 run this file from the command line
//    try some of the operations inside the try {} catch {} block

// disable WSDL cache (until you get it running!)
ini_set('soap.wsdl_cache_enabled', 0); 
ini_set('always_populate_raw_post_data', -1);

// here is the WSDL
define('WSDL_URL', 'http://localhost:8080?wsdl=1');
$clientKey = include __DIR__ . '/api_key.php';

// initialize data
$rand = rand(0,9999);
$alpha = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$email = 'test' . $rand . '@unlikelysource.com';
$prospect = [
	'first_name' => 'Test',
	'last_name' => 'Test' . $rand,
	'address' => $rand . ' Main Street',
	'city' => 'City ' . $rand,
	'state_province' => $alpha[rand(0,25)] . $alpha[rand(0,25)],
	'postal_code' => sprintf('%06X', rand(1,999999)),
	'phone' => sprintf('+%02d %03d-%03d-%04d', rand(1,99), rand(1,999), rand(1,999), rand(1,9999)),
	'email' => $email,
	'status' => sprintf('%08X', rand(1,99999999)),
	'budget' => $rand,
	'last_updated' => date('Y-m-d H:i:s')
];

// test the API:
try {
	// get client
	$client = new SoapClient(WSDL_URL);

	// initialize the "response"
	$response = [];

	/*
	// insert data
	echo "\nNew Prospect\n";
	$request = ['token' => $clientKey, 'data' => $prospect];
	$result = $client->put($request,$response);
	var_dump($result);
	
	// fetch all
	echo "\nFetch All\n";
	$request = ['token' => $clientKey];
	$result = $client->get($request,$response);
	var_dump($result);
	*/
	
	// retrieve data for single email
	$email = some_email_generated_by_test;
	$email = 'test5393@unlikelysource.com';
	echo "\nGet Prospect Info for Email: " . $email . "\n";
	$request = ['token' => $clientKey, 'email' => $email];
	$result = $client->get($request,$response);
	var_dump($result);
	
	/*
	// delete data
	echo "\nDelete Prospect\n";
	$id = some_ID_generated_by_test;
	$request = ['token' => $clientKey, 'id' => $id];
	$result = $client->delete($request,$response);
	var_dump($result);	
	*/
	
} catch (SoapFault $e) {
	echo 'ERROR' . PHP_EOL;
	echo $e->getMessage() . PHP_EOL;
} catch (Throwable $e) {
	echo 'ERROR' . PHP_EOL;
	echo $e->getMessage() . PHP_EOL;
} finally {
	echo $client->__getLastResponse() . PHP_EOL;
}
/*
echo "\nFetch All\n"
$request = [$client::TOKEN_FIELD => $clientKey, $client::LIMIT_FIELD => 3, $client::OFFSET_FIELD => 0];
$result = $client->get($request, $response);
var_dump($result);
echo "\nUpdate Budget to 888888.88\n";
$id = ???;
$request = ['token' => $clientKey, 'id' => 26, 'data' => ['budget' => 888888.88]];
$result = $client->post($request, $response);
var_dump($result);
echo "\nGet Prospect Info for ID: " . $id . "\n";
$request = ['token' => $clientKey, 'id' => $id];
var_dump($client->get($request, $response));
echo "\nDelete Prospect ID: " . $id . "\n";
$id = ???;
$request = ['token' => $clientKey, 'id' => $id];
var_dump($client->delete($request, $response));
*/
