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
	'*'				=> [ ['key' => 'trim', 'params' => []], 
						 ['key' => 'strip_tags', 'params' => []] ],
	'first_name'	=> [ ['key' => 'length', 'params' => ['length' => 128]] ],
	'last_name'		=> [ ['key' => 'length', 'params' => ['length' => 128]] ],
	'city'	        => [ ['key' => 'length', 'params' => ['length' => 64]] ],
	'budget' 		=> [ ['key' => 'filter_float', 'params' => []] ],
];

// test data
$goodData = [
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

$filter = new Application\Filter\Filter($callbacks['filters'], $assignments);
$filter->setSeparator(PHP_EOL);

echo "\nGood Data:\n";
$filter->process($goodData);
echo $filter->getMessageString(40, '%14s : %-26s' . PHP_EOL);
echo PHP_EOL;
var_dump($filter->getItemsAsArray());

echo "\nBad Data:\n";
$filter->process($badData);
echo $filter->getMessageString(40, '%14s : %-26s' . PHP_EOL);
echo PHP_EOL;
var_dump($filter->getItemsAsArray());

