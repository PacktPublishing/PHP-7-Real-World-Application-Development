<?php
define('DB_CONFIG_FILE', __DIR__ . '/../config/db.config.php');
define('FIRST_NAME_FILE', __DIR__ . '/../data/files/first_names.txt');
define('LAST_NAME_FILE', __DIR__ . '/../data/files/surnames.txt');

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\Test\FakeData;
use Application\Database\Connection;

// maps destination table columns (key) against source
$mapping = [
	'first_name' 	=> ['source' => FakeData::SOURCE_FILE,
						'name' => FIRST_NAME_FILE,
						'type' => FakeData::FILE_TYPE_TXT],
	'last_name'  	=> ['source' => FakeData::SOURCE_FILE,
						'name' => LAST_NAME_FILE,
						'type' => FakeData::FILE_TYPE_TXT],
	'address'    	=> ['source' => FakeData::SOURCE_METHOD,
						'name' => 'getAddress'],
	'city'       	=> ['source' => FakeData::SOURCE_TABLE,
						'name' => 'world_city_data',
						'idCol' => 'id',
						// mapping between source table and dest table
						'mapping' => ['city' => 'city', 'state_province' => 'state_province',
									  'postal_code_prefix' => 'postal_code', 'iso2' => 'country']],
	'state_province'=> [],
	'postal_code'	=> [],
	'phone'			=> ['source' => FakeData::SOURCE_CALLBACK,
						'name' => function () { return sprintf('%3d-%3d-%4d', random_int(101,999),
							random_int(101,999), random_int(0,9999)); }],
	'country'		=> [],
	'email'			=> ['source' => FakeData::SOURCE_METHOD,
						'name' => 'getEmail',
						'params' => ['first_name','last_name']],
	'status'		=> ['source' => FakeData::SOURCE_CALLBACK,
						'name' => function () { $status = ['BEG','INT','ADV']; return $status[rand(0,2)]; }],
	'budget'		=> ['source' => FakeData::SOURCE_CALLBACK,
						'name' => function() { return random_int(0, 99999) + (random_int(0, 99) * .01); }],
	'last_updated'  => ['source' => FakeData::SOURCE_METHOD,
						'name' => 'getDate',
						'params' => [date('Y-m-d'), 365*5]]
];
$destTableName = 'prospects';
$destTableCols = [
	'iso2',
	'postal_code_prefix',
	'city',
	'state_province',
	's_p_code',
	'county',
	'region_code_1',
	'region_code_2',
	'region_code_3',
	'latitude',
	'longitude',
	'code'
];

$conn = new Connection(include DB_CONFIG_FILE);
$fake = new FakeData($conn, $mapping, $destTableName, $destTableCols);
echo implode(':', array_keys($mapping)) . PHP_EOL;
foreach ($fake->generateData(10) as $row) {
	echo implode(':', $row) . PHP_EOL;
}
