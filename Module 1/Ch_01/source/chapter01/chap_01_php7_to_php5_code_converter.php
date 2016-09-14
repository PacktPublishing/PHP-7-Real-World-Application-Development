<?php
// converts code from PHP 5 to PHP 7

// get filename to scan from command line
$filename = $argv[1] ?? '';

if (!$filename) {
    echo 'No filename provided' . PHP_EOL;
    echo 'Usage: ' . PHP_EOL;
    echo __FILE__ . ' <filename>' . PHP_EOL;
    exit;
}

// setup class autoloading
require __DIR__ . '/../../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/../..');

// get "deep scan" class
$convert = new Application\Parse\Convert();
echo $convert->scan($filename);
echo PHP_EOL;
