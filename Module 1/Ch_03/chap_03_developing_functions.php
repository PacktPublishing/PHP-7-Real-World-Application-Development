<?php
// developing functions -- type hints

// it's a best practice to place all functions definitions 
// in a separate file which is then included
include (__DIR__ . DIRECTORY_SEPARATOR . 'chap_03_developing_functions_library.php');

echo "-------------------------------\n";
echo "OUTPUT FROM: someName()\n";
echo "-------------------------------\n";
echo someName('TEST');   // returns "INIT and also TEST"
echo PHP_EOL;
echo PHP_EOL;

echo "-------------------------------\n";
echo "OUTPUT FROM: someOtherName()\n";
echo "-------------------------------\n";
echo someOtherName(1);    // returns  1
echo PHP_EOL;
echo someOtherName(1, 1);   //  returns 2
echo PHP_EOL;
echo PHP_EOL;

echo "-------------------------------\n";
echo "OUTPUT FROM: someInfinite()\n";
echo "-------------------------------\n";
echo someInfinite(1, 2, 3);
echo PHP_EOL;
echo someInfinite(22.22, 'A', ['a' => 1, 'b' => 2]);
echo PHP_EOL;
echo PHP_EOL;

echo "-------------------------------\n";
echo "OUTPUT FROM: someDirScan()\n";
echo "-------------------------------\n";
foreach (someDirScan(__DIR__ . DIRECTORY_SEPARATOR . '..') as $item) {
    echo $item . PHP_EOL;
}
