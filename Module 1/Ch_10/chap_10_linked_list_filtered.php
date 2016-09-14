<?php
define('CUSTOMER_FILE', __DIR__ . '/../data/files/customer.csv');
define('LEVEL_FILTER', 'INT');

include __DIR__ . '/chap_10_linked_list_include.php';

// get customer data
$headers = array();
$customer = readCsv(CUSTOMER_FILE, $headers);

// callback to produce link
$makeLink = function ($row) {
	list($first, $last) = explode(' ', $row[1]);
	return trim($last) . trim($first);
};

// produce linked list
$filterCol = 9;
$filterVal = LEVEL_FILTER;
$linked = buildLinkedList($customer, $makeLink, $filterCol, $filterVal);
//var_dump($linked);

// produce output based on linked list
echo printCustomer($headers, $linked, $customer);
