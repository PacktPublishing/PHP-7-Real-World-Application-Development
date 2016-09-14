<?php
define('CUSTOMER_FILE', __DIR__ . '/../data/files/customer.csv');

include __DIR__ . '/chap_10_linked_list_include.php';

// get customer data
$headers = array();
$customer = readCsv(CUSTOMER_FILE, $headers);


// produce linked list
$makeLink = function ($row) {
	return $row[0];
};
$linked = buildLinkedList($customer, $makeLink);

// do primary sort 1st
echo 'Iterations: ' . bubbleSort($linked, $customer, 2, 'A') . PHP_EOL;

// produce output based on linked list
echo printCustomer($headers, $linked, $customer);
