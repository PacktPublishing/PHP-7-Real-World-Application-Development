<?php
define('CUSTOMER_FILE', __DIR__ . '/../data/files/customer.csv');

include __DIR__ . '/chap_10_linked_list_include.php';

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// classes to use
use Application\Generic\Search;

// get customer data
$headers = array();
$customer = readCsv(CUSTOMER_FILE, $headers);
$search = new Search($customer);
$item = 'Todd Lindsey';
$cols = [1];

echo "Searching For: $item\n";
var_dump($search->binarySearch($cols, $item));


