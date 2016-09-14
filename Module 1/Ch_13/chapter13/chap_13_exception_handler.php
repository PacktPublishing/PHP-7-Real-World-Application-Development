<?php
define('DB_CONFIG_FILE', __DIR__ . '/../config/db.config.php');
$config = include DB_CONFIG_FILE;

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// classes to use
use Application\Error\ { Handler, ThrowsException };

$handler = new Handler(__DIR__ . '/logs');
try {
	$throws1 = new ThrowsException($config);
} catch (Exception $e) {
	echo 'Exception Caught: ' . get_class($e) . ':' . $e->getMessage() . PHP_EOL;
}
$throws1 = new ThrowsException($config);
echo 'Application Continues ...' . PHP_EOL;

// now have a look at log file /logs/YYYYmmdd.log
// where YYYYmmdd = Year month and day
