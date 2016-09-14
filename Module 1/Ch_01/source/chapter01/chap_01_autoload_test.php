<?php
// test class autoloading

// setup class autoloading
require __DIR__ . '/../../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/../..');

// get "test" class
$test = new Application\Test\TestClass();
echo $test->getTest();

// get "fake" class (which doesn't exist)
// uncomment the 2 lines below to see results
//$fake = new Application\Test\FakeClass();
//echo $fake->getTest();
