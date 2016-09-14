<?php
// developing functions -- using "stacked" iterators

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

    $iterator = fetchAllAssoc($sql, $connection);
    $shallow  = new RecursiveArrayIterator($iterator);
    $deep     = new RecursiveIteratorIterator($shallow);
    
} catch (Throwable $e) {
    echo $e->getMessage();
}
