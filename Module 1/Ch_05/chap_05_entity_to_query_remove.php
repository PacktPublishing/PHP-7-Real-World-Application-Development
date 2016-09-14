<?php
// ties RDBMS query to Application\Entity\Customer

define('DB_CONFIG_FILE', '/../config/db.config.php');

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// classes to use
use Application\Entity\Customer;
use Application\Database\Connection;
use Application\Database\CustomerService;

// get service instance
$service = new CustomerService(new Connection(include __DIR__ . DB_CONFIG_FILE));

// sample data
$data = [
	'name'              => 'Doug Bierer',
	'balance'           => 326.33,
	'email'             => 'doug' . rand(0,999) . '@unlikelysource.com',
	'password'          => 'password',
	'status'            => 1,
	'security_question' => 'Who\'s on first?',
	'confirm_code'      => 12345,
	'level'             => 'ADV'
];

// create new Customer
$cust1 = Customer::arrayToEntity($data, new Customer());
$cust2 = $service->save($cust1);

echo "\nCustomer ID AFTER Insert: {$cust2->getId()}\n";

// now remove this customer
echo ($service->remove($cust2)) ? "Customer {$cust2->getId()} REMOVED\n" : "Customer {$cust2->getId()} NOT REMOVED\n";

