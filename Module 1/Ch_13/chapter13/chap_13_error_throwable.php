<?php
// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// classes to use
use Application\Error\ { Handler, ThrowsError };

// set up error class
$error = new ThrowsError();

// throw errors
//$error->divideByZero();
//$error->willNotParse();

// if you use try / catch, the "universal" exception handler is overridden
try {
	$error->divideByZero();
} catch (Throwable $e) {
	// NOTE: this construct does not catch *all* errors"
	echo 'Error Caught: ' . get_class($e) . ':' . $e->getMessage() . PHP_EOL;
}
// if you use try / catch, the "universal" exception handler is overridden
try {
	$error->willNotParse();
} catch (Throwable $e) {
	// NOTE: this construct does not catch *all* errors"
	echo 'Error Caught: ' . get_class($e) . ':' . $e->getMessage() . PHP_EOL;
}

// sets up "universal" error handler
$handler = new Handler(__DIR__ . '/logs');

// $handler catches exceptions not otherwise caught
$error->divideByZero();
$error->willNotParse();

echo 'Application continues ... ' . PHP_EOL;

// now have a look at log file /logs/YYYYmmdd.log
// where YYYYmmdd = Year month and day
