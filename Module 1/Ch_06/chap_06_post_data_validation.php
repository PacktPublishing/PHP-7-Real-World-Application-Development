<?php
// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

include __DIR__ . '/chap_06_post_data_config_messages.php';
include __DIR__ . '/chap_06_post_data_config_callbacks.php';

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

$assignments = [
	'first_name' 	=> [ ['key' => 'length',  'params' => ['min' => 1, 'max' => 128]], 
						 ['key' => 'alnum',   'params' => ['allowWhiteSpace' => TRUE]],
						 ['key' => 'required','params' => []] ],
	'last_name' 	=> [ ['key' => 'length',  'params' => ['min' => 1, 'max' => 128]],
						 ['key' => 'alnum',   'params' => ['allowWhiteSpace' => TRUE]],
						 ['key' => 'required','params' => []] ],
	'address' 		=> [ ['key' => 'length',  'params' => ['max' => 256]] ],
	'city' 			=> [ ['key' => 'length',  'params' => ['min' => 1, 'max' => 64]] ], 
	'state_province'=> [ ['key' => 'length',  'params' => ['min' => 1, 'max' => 32]] ], 
	'postal_code' 	=> [ ['key' => 'length',  'params' => ['min' => 1, 'max' => 16] ], 
						 ['key' => 'alnum',   'params' => ['allowWhiteSpace' => TRUE]],
						 ['key' => 'required','params' => []] ],
	'phone' 		=> [ ['key' => 'phone',   'params' => []] ],
	'country' 		=> [ ['key' => 'in_array','params' => $countries ], 
						 ['key' => 'required','params' => []] ],
	'email' 		=> [ ['key' => 'email',   'params' => [] ],
						 ['key' => 'length',  'params' => ['max' => 250] ], 
						 ['key' => 'required','params' => [] ] ],
	'budget' 		=> [ ['key' => 'float',   'params' => []] ]
];

// test data
$goodData = [
	'first_name' 	=> 'Douglas Alan',
	'last_name' 	=> 'Bierer',
	'address' 		=> '123 Main Street',
	'city' 			=> 'San Francisco',
	'state_province'=> 'California',
	'postal_code' 	=> '94101',
	'phone' 		=> '+1 415-555-1212',
	'country' 		=> 'US',
	'email' 		=> 'doug@unlikelysource.com',
	'budget' 		=> '123.45',
];
$badData = [
	'first_name' 	=> 'This+Name<script>bad tag</script>Valid!',
	'last_name' 	=> 'ThisLastNameIsWayTooLongAbcdefghijklmnopqrstuvwxyz0123456789Abcdefghijklmnopqrstuvwxyz0123456789Abcdefghijklmnopqrstuvwxyz0123456789Abcdefghijklmnopqrstuvwxyz0123456789',
	//'address' 		=> '',		// missing
	'city' 			=> '  ThisCityNameIsTooLong012345678901234567890123456789012345678901234567890123456789  ',
	//'state_province'=> '',		// missing
	'postal_code' 	=> '!"£$%^Non Alpha Chars',
	'phone' 		=> ' 12345 ',
	'country' 		=> 'XX',
	'email' 		=> 'this.is@not@an.email',
	'budget' 		=> 'XXX',
];

$validator = new Application\Filter\Validator($callbacks['validators'], $assignments);
$validator->setSeparator(PHP_EOL);

echo "\nGood Data:\n";
$validator->process($goodData);
echo $validator->getMessageString(40, '%14s : %-26s' . PHP_EOL);
echo PHP_EOL;
var_dump($validator->getItemsAsArray());

echo "\nBad Data:\n";
$validator->process($badData);
echo $validator->getMessageString(40, '%14s : %-26s' . PHP_EOL);
echo PHP_EOL;
var_dump($validator->getItemsAsArray());


