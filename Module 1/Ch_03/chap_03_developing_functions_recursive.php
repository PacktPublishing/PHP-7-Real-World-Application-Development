<?php
// developing functions -- using recursive iterators

// pulls up a database record with secondary lookups
define('DB_CONFIG_FILE', '/../config/db.config.php');

// include function library + database connection class
include (__DIR__ . '/chap_03_developing_functions_iterators_library.php');
include (__DIR__ . '/../Application/Database/Connection.php');

try {
    
    // set up database connection
    $connection = new Application\Database\Connection(include __DIR__ . DB_CONFIG_FILE);

    // pull up a country list
    $sql    = 'SELECT * FROM iso_country_codes';

    // ArrayIterator
    $iterator = fetchAllAssoc($sql, $connection);
        
    // RecursiveArrayIterator
    $shallow  = new RecursiveArrayIterator($iterator);
    echo "\nRecursiveArrayIterator\n";
    foreach ($shallow as $item) var_dump($item);
    echo PHP_EOL;
    
    // RecursiveIteratorIterator
    $deep     = new RecursiveIteratorIterator($shallow);
    echo "\nRecursiveIteratorIterator\n";
    foreach ($deep as $item) var_dump($item);
    echo PHP_EOL;
    
} catch (Throwable $e) {
    echo $e->getMessage();
}

