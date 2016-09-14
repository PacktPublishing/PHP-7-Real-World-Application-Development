<?php
// developing functions -- namespace

include (__DIR__ . DIRECTORY_SEPARATOR . 'chap_03_developing_functions_namespace_alpha.php');
include (__DIR__ . DIRECTORY_SEPARATOR . 'chap_03_developing_functions_namespace_beta.php');

// executes someTypeHint()
try {
    echo Alpha\someFunction();
    echo Beta\someFunction();
} catch (TypeError $e) {
    echo $e->getMessage();
    echo PHP_EOL;
}

