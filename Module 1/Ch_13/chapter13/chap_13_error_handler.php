<?php
// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// classes to use
use Application\Error\ { Handler, GeneratesError };

// sets up "universal" error handler
$handler = new Handler(__DIR__ . '/logs');

// if you use try / catch, the "universal" exception handler is overridden
try {
	$error1 = new GeneratesError();
} catch (Error $e) {
	// NOTE: this construct does not catch *all* errors"
	echo 'Error Caught: ' . get_class($e) . ':' . $e->getMessage() . PHP_EOL;
}

// $handler catches exceptions not otherwise caught
$error2 = new GeneratesError();

// now have a look at log file /logs/YYYYmmdd.log
// where YYYYmmdd = Year month and day
