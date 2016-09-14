<?php
// prospects table:
/*
	COLUMN          TYPE          NULL  DEFAULT
	first_name 		varchar(128) 	No 	None 	NULL
	last_name 		varchar(128) 	No 	None 	NULL
	address 		varchar(256) 	Yes None 	NULL
	city 	        varchar(64) 	Yes None 	NULL
	state_province 	varchar(32) 	Yes None 	NULL
	postal_code 	char(16) 		No 	None 	NULL
	phone 			varchar(16) 	No 	None 	NULL
	country 		char(2) 		No 	None 	NULL
	email 			varchar(250) 	No 	None 	NULL
	status 			char(8) 		Yes None 	NULL
	budget 			decimal(10,2) 	Yes None 	NULL
	last_updated 	datetime 		Yes None 	NULL
*/

// test data
$testData = [
	'goodData' => [
		'first_name' 	=> 'Doug',
		'last_name' 	=> 'Bierer',
		'address' 		=> '123 Main Street',
		'city' 			=> 'San Francisco',
		'state_province'=> 'California',
		'postal_code' 	=> '94101',
		'phone' 		=> '+1 415-555-1212',
		'country' 		=> 'US',
		'email' 		=> 'doug@unlikelysource.com',
		'budget' 		=> '123.45',
	],
	'badData' => [
		'first_name' 	=> 'This+Name<script>bad tag</script>Valid!',
		'last_name' 	=> 'ThisLastNameIsWayTooLongAbcdefghijklmnopqrstuvwxyz0123456789Abcdefghijklmnopqrstuvwxyz0123456789Abcdefghijklmnopqrstuvwxyz0123456789Abcdefghijklmnopqrstuvwxyz0123456789',
		//'address' 		=> '',		// missing
		'city' 			=> '  ThisCityNameIsTooLong012345678901234567890123456789012345678901234567890123456789  ',
		//'state_province'=> '',		// missing
		'postal_code' 	=> '!"£$%^Non Alpha Chars',
		'phone' 		=> '(123) 456-XXXX',
		'country' 		=> '12345',
		'email' 		=> 'this.is@not@an.email',
		'budget' 		=> 'XXX',
	]
];

$validator = [
	'email' => [
		'callback' => function ($item) {
			return filter_var($item, FILTER_VALIDATE_EMAIL); },
		'message'  => 'Invalid email address'],
	// we allow whitespace by stripping it out 1st
	'alpha' => [
		'callback' => function ($item) {
			return ctype_alpha(str_replace(' ', '', $item)); },
		'message'  => 'Data contains non-alpha characters'],
	// we allow whitespace by stripping it out 1st
	'alnum' => [
		'callback' => function ($item) {
			return ctype_alnum(str_replace(' ', '', $item)); },
		'message'  => 'Data contains characters which are not letters or numbers'],
	'digits' => [
		'callback' => function ($item) {
			return preg_match('/[^0-9.]/', $item); },
		'message'  => 'Data contains characters which are not numbers'],
	'length' => [
		'callback' => function ($item, $length) {
			return strlen($item) <= $length; },
		'message'  => 'Item has too many characters'],
	'upper' => [
		'callback' => function ($item) {
			return $item == strtoupper($item); },
		'message'  => 'Item is not upper case'],
	'phone' => ['callback' => function ($item) { return preg_match('/[^0-9() -+]/', $item); },
				'message'  => 'Item is not a valid phone number'],
];

$assignments = [
	'first_name' 	=> ['length' => 32, 'alpha' => NULL],
	'last_name' 	=> ['length' => 32, 'alpha' => NULL],
	'address' 		=> ['length' => 64, 'alnum' => NULL],
	'city' 			=> ['length' => 32, 'alnum' => NULL],
	'state_province'=> ['length' => 20, 'alpha' => NULL],
	'postal_code' 	=> ['length' => 12, 'alnum' => NULL],
	'phone' 		=> ['length' => 12, 'phone' => NULL],
	'country' 		=> ['length' => 2, 'alpha' => NULL, 'upper' => NULL],
	'email' 		=> ['length' => 128, 'email' => NULL],
	'budget' 		=> ['digits' => NULL],
];

foreach ($testData as $data) {
	foreach ($data as $field => $item) {
		echo '-------------------------------------' . PHP_EOL;
		echo 'Processing: ' . $field . PHP_EOL;
		echo '-------------------------------------' . PHP_EOL;
		foreach ($assignments[$field] as $key => $option) {
			if ($validator[$key]['callback']($item, $option)) {
				$message = 'OK';
			} else {
				$message = $validator[$key]['message'];
			}
			printf('%8s : %s' . PHP_EOL, $key, $message);
		}
	}
}
