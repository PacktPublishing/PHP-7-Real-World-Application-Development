<?php
// demonstrates the new PHP 7 "call()" 

define('LOG_FILES', '/var/www/php_sec/exploits/joomla_godaddy/*.log');

// setup class autoloading
require __DIR__ . '/../../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/../..');

// define functions
$freq = function ($line) {
    $ip = $this->getIp($line);
    if ($ip) {
        echo '.';
        $this->frequency[$ip] = (isset($this->frequency[$ip])) ? $this->frequency[$ip] + 1 : 1;
    }
};

// loop through log files in a directory
foreach (glob(LOG_FILES) as $filename) {
    echo PHP_EOL . $filename . PHP_EOL;
    // access class
    $access = new Application\Web\Access($filename);
    foreach ($access->fileIteratorByLine() as $line) {
        // calls the anonymous function, binds $access to $this, and accepts param $line
        $freq->call($access, $line);
        // To do the same thing in PHP 5 you would need these 2 lines:
        // $func = $freq->bindTo($access);  $func($line);
    }
}

// reverse sort to make most frequent IPs appear first
arsort($access->frequency);

// output results
echo PHP_EOL;
foreach ($access->frequency as $key => $value) {
    printf('%16s : %6d' . PHP_EOL, $key, $value);
}
