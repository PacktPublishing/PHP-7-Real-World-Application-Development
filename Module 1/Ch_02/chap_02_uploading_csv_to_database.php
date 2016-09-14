<?php
// this file uploads a CSV file to a database

define('DB_CONFIG_FILE', '/../../data/config/db.config.php');
define('CSV_FILE', '/../../data/files/prospects.csv');

// setup class autoloading
require __DIR__ . '/../../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/../..');

try {
    
    // set up database connection
    $connection = new Application\Database\Connection(include __DIR__ . DB_CONFIG_FILE);

    // get iterator
    $iterator  = (new Application\Iterator\LargeFile(__DIR__ . CSV_FILE))->getIterator('Csv');

    // prepare insert statement
    $sql = 'INSERT INTO `prospects` '
         . '(`id`,`first_name`,`last_name`,`address`,`city`,`state_province`,'
         . '`postal_code`,`phone`,`country`,`email`,`status`,`budget`,`last_updated`) '
         . ' VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)';
    $statement = $connection->pdo->prepare($sql);
    
    // execute in loop
    foreach ($iterator as $row) {
        echo implode(',', $row) . PHP_EOL;
        $statement->execute($row);
    }
    echo PHP_EOL;
    echo 'Last Insert ID: ' . $connection->pdo->lastInsertId();
        
  // NOTE: Throwable catches *both* Exceptions and Errors
} catch (Throwable $e) {
    echo $e->getMessage();
}
