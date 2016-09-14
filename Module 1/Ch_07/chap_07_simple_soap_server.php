<?php
// disable WSDL cache (until you get it running!)
//ini_set('soap.wsdl_cache_enabled', 0); 
//ini_set('always_populate_raw_post_data', -1);

// simple SOAP server
define('DB_CONFIG_FILE', '/../config/db.config.php');
define('WSDL_FILENAME', __DIR__ . '/chap_07_wsdl.xml');

if (isset($_GET['wsdl'])) {
	readfile(WSDL_FILENAME);
	exit;
}

$apiKey = include __DIR__ . '/api_key.php';

// include required classes
require __DIR__ . '/../Application/Web/Soap/ProspectsApi.php';
require __DIR__ . '/../Application/Database/Connection.php';

// classes to use
use Application\Database\Connection;
use Application\Web\Soap\ProspectsApi;

$connection = new Application\Database\Connection(include __DIR__ . DB_CONFIG_FILE);
$api = new Application\Web\Soap\ProspectsApi($connection->pdo, [$apiKey]);

$server = new SoapServer(WSDL_FILENAME);
$server->setObject($api);
echo $server->handle();
