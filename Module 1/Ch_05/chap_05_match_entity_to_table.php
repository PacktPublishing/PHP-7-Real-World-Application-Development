<?php
// match entity to database table

define('DB_CONFIG_FILE', '/../config/db.config.php');

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// classes to use
use Application\Database\Connection;
use Application\Entity\Customer;

// get connection
$conn = new Connection(include __DIR__ . DB_CONFIG_FILE);

// get one customer at random
$id = rand(1,79);
$stmt = $conn->pdo->prepare('SELECT * FROM customer WHERE id = :id');
$stmt->execute(['id' => $id]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// create Customer entity from data
$cust = Customer::arrayToEntity($result, new Customer());
var_dump($cust);
