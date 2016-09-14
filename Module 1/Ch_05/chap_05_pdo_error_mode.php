<?php
// example of PDO MySQL connection with different error modes

// db params
$params = [
	'host' => 'localhost',
	'user' => 'test',
	'pwd'  => 'password',
	'db'   => 'php7cookbook'
];

// configure DSN
$dsn  = sprintf('mysql:charset=UTF8;host=%s;dbname=%s', $params['host'], $params['db']);

// bad SQL statement
$sql  = 'THIS SQL STATEMENT WILL NOT WORK';

// do not set error mode ********************************
$pdo1  = new PDO($dsn, $params['user'], $params['pwd']);

// NOTE: doesn't generate an error
echo "No Error Mode\n";
echo "-------------\n";
$stmt = $pdo1->query($sql);
$row = ($stmt) ? $stmt->fetch(PDO::FETCH_ASSOC) : 'No Good';
var_dump($row);
echo PHP_EOL;


// error mode warning *********************************
// sets error mode params in PDO constructor
$pdo2 = new PDO(
	$dsn, 
	$params['user'], 
	$params['pwd'], 
	[PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);

// NOTE: generates warning
echo "Error Mode Warning\n";
echo "------------------\n";
$stmt = $pdo2->query($sql);
$row = ($stmt) ? $stmt->fetch(PDO::FETCH_ASSOC) : 'No Good';
var_dump($row);
echo PHP_EOL;


// error mode exception *********************************
$pdo3 = new PDO($dsn, $params['user'], $params['pwd']);
// sets error mode params using PDO::setAttribute()
$pdo3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// NOTE: throws exception
echo "Error Mode Exception\n";
echo "--------------------\n";
try {
	$stmt = $pdo3->query($sql);
	$row = ($stmt) ? $stmt->fetch(PDO::FETCH_ASSOC) : 'No Good';
	var_dump($row);
	echo PHP_EOL;
} catch (PDOException $e) {
	echo $e->getMessage() . PHP_EOL;
}
