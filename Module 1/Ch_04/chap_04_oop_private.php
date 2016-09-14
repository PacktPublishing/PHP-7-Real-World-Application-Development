<?php
// demonstrates using private to define singleton

include __DIR__ . '/../Application/Generic/Registry.php';
use Application\Generic\Registry;

// this works OK
$registry = Registry::getInstance();
$registry->param1 = 12345;
$registry->param2 = 'ABC';
var_dump($registry);

// the next few lines will not work
echo PHP_EOL;
try {
    $registry = new Registry();
    $registry->param1 = 12345;
    $registry->param2 = 'ABC';
    var_dump($registry);
} catch (Error $e) {
    echo $e->getMessage();
}

