<?php
// developing functions -- return type

// it's a best practice to place all functions definitions 
// in a separate file which is then included
include (__DIR__ . DIRECTORY_SEPARATOR . 'chap_03_developing_functions_return_types_library.php');

// executes returnsString()
echo "\nreturnsString()\n";
$date   = new DateTime();
$format = 'l, d M Y';
$now    = returnsString($date, $format);
echo $now . PHP_EOL;
var_dump($now);
// executes convertsToString()
echo "\nconvertsToString()\n";
var_dump(convertsToString(2, 3, 4));

// executes makesDateTime()
echo "\nmakesDateTime()\n";
$d = makesDateTime(2015, 11, 21);
var_dump($d);

// executes wrongDateTime()
echo "\nwrongDateTime()\n";
try {
    $e = wrongDateTime(2015, 11, 21);
    var_dump($e);
} catch (TypeError $e) {
    echo $e->getMessage();
}

