<?php
// this file uploads a CSV file to a database

define('EXAMPLE_PATH', realpath(__DIR__ . '/../../'));

// setup class autoloading
require __DIR__ . '/../../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/../..');

// get instance of Directory class
$directory = new Application\Iterator\Directory(EXAMPLE_PATH);

try {
    echo 'Mimics "ls -l -R" ' . PHP_EOL;
    foreach ($directory->ls('*.php') as $info) {
        echo $info;
    }

    echo 'Mimics "dir /s" ' . PHP_EOL;
    foreach ($directory->dir('*.php') as $info) {
        echo $info;
    }
        
} catch (Throwable $e) {
    echo $e->getMessage();
}
