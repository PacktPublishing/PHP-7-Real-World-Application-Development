<?php
// demonstrates simple class usage

require __DIR__ . '/Test.php';

$test = new Test();
echo $test->getTest();
echo PHP_EOL;

$test->setTest('ABC');
echo $test->getTest();
echo PHP_EOL;
