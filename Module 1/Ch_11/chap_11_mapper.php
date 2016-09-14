<?php
define('DB_CONFIG_FILE', '/../config/db.config.php');
define('DEFAULT_PHOTO', 'person.gif');

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\Database\Mapper\ { FieldConfig, Mapping };
use Application\Database\Connection;

// set connection
$conn = new Connection(include __DIR__ . DB_CONFIG_FILE);

// truncate customer_11 and profile_11
$conn->pdo->query('DELETE FROM customer_11');
$conn->pdo->query('DELETE FROM profile_11');

// mapping config
$mapper = new Mapping('prospects_11', ['customer_11','profile_11']);
$mapper->addField(new FieldConfig('email','customer_11','email'))
->addField(new FieldConfig('first_name','customer_11','name',
		function ($row) { return trim(($row['first_name'] ?? '') . ' ' . ($row['last_name'] ?? ''));}))
// last name is only visible in source table; not used in destination
->addField(new FieldConfig('last_name'))
->addField(new FieldConfig('status','customer_11','status',
		function ($row) { return $row['status'] ?? 'Unknown'; }))
->addField(new FieldConfig(NULL,'customer_11','level','BEG'))
// use phone number as temporary password
->addField(new FieldConfig(NULL,'customer_11','password',function ($row) { return $row['phone']; }))
->addField(new FieldConfig('address','profile_11','address'))
->addField(new FieldConfig('city','profile_11','city'))
->addField(new FieldConfig('state_province','profile_11','state_province',
		function ($row) { return $row['state_province'] ?? 'Unknown'; }))
->addField(new FieldConfig('postal_code','profile_11','postal_code'))
->addField(new FieldConfig('phone','profile_11','phone'))
->addField(new FieldConfig('country','profile_11','country'))
// other destination fields which don't exist in the source table
->addField(new FieldConfig(NULL,'profile_11','photo',DEFAULT_PHOTO))
->addField(new FieldConfig(NULL,'profile_11','dob',date('Y-m-d')));

// deal with the IDs to ensure 1:1 relationships
$idCallback = function ($row) { return $row['id']; };
$mapper->addField(new FieldConfig('id','customer_11','id',$idCallback))
		// NOTE: assumes customer id == profile id
		->addField(new FieldConfig(NULL,'customer_11','profile_id',$idCallback))
		// profile_11 info, no defaults
		->addField(new FieldConfig('id','profile_11','id',$idCallback));

// generate SQL
$sourceSelect  = $mapper->getSourceSelect();
$custInsert    = $mapper->getDestInsert('customer_11');
$profileInsert = $mapper->getDestInsert('profile_11');

echo "SQL Statements:\n";
echo "$sourceSelect\n";
echo "$custInsert\n";
echo "$profileInsert\n";
echo PHP_EOL;

// prepare statements
$sourceStmt  = $conn->pdo->prepare($sourceSelect);
$custStmt    = $conn->pdo->prepare($custInsert);
$profileStmt = $conn->pdo->prepare($profileInsert);

// loop through source and insert into dest
$sourceStmt->execute();
while ($row = $sourceStmt->fetch(PDO::FETCH_ASSOC)) {
	$custData = $mapper->mapData($row, 'customer_11');
	$custStmt->execute($custData);
	$profileData = $mapper->mapData($row, 'profile_11');
	$profileStmt->execute($profileData);
	echo "Processing: {$custData['name']}\n";
}


// source table:
/*
CREATE TABLE `prospects_11` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `address` varchar(256) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `state_province` varchar(32) DEFAULT NULL,
  `postal_code` char(16) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `country` char(2) NOT NULL,
  `email` varchar(250) NOT NULL,
  `status` char(8) DEFAULT NULL,
  `budget` decimal(10,2) DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_35730C06E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/

// destination tables:
/*
CREATE TABLE `customer_11` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` char(16) NOT NULL,
  `status` int(10) unsigned NOT NULL DEFAULT '0',
  `security_question` varchar(250) DEFAULT NULL,
  `confirm_code` varchar(32) DEFAULT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `level` char(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_81398E09E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 COMMENT='Customers';
*/

/*
CREATE TABLE `profile_11` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(256) NOT NULL,
  `city` varchar(64) NOT NULL,
  `state_province` varchar(32) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `country` varchar(3) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `photo` varchar(128) NOT NULL,
  `dob` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 COMMENT='Customers';
*/


