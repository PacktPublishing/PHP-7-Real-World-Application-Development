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
		'phone' 		=> ' 12345 ',
		'country' 		=> '12345',
		'email' 		=> 'this.is@not@an.email',
		'budget' 		=> 'XXX',
	]
];

$filter = [
	'trim' => function ($item) { return trim($item); },
	'float' => function ($item) { return (float) $item; },
	'upper' => function ($item) { return strtoupper($item); },
	'email' => function ($item) { return filter_var($item, FILTER_SANITIZE_EMAIL); },
	'alpha' => function ($item) { return preg_replace('/[^A-Za-z]/', '', $item); },
	'alnum' => function ($item) { return preg_replace('/[^0-9A-Za-z ]/', '', $item); },
	'length' => function ($item, $length) { return substr($item, 0, $length); },
	'stripTags' => function ($item) { return strip_tags($item); },
];

$assignments = [
	'*'				=> ['trim' => NULL, 'stripTags' => NULL],
	'first_name' 	=> ['length' => 32, 'alnum' => NULL],
	'last_name' 	=> ['length' => 32, 'alnum' => NULL],
	'address' 		=> ['length' => 64, 'alnum' => NULL],
	'city' 			=> ['length' => 32],
	'state_province'=> ['length' => 20],
	'postal_code' 	=> ['length' => 12, 'alnum' => NULL],
	'phone' 		=> ['length' => 12],
	'country' 		=> ['length' => 2, 'alpha' => NULL, 'upper' => NULL],
	'email' 		=> ['length' => 128, 'email' => NULL],
	'budget' 		=> ['float' => NULL],
];

foreach ($testData as $data) {
	foreach ($data as $field => $item) {
		foreach ($assignments['*'] as $key => $option) {
			$item = $filter[$key]($item, $option);
		}
		foreach ($assignments[$field] as $key => $option) {
			$item = $filter[$key]($item, $option);
		}
		printf("%16s : %s\n", $field, $item);
	}
}
