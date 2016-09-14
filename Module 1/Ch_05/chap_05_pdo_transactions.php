<?php
// example of PDO transaction support

define('CSV_FILE', __DIR__ . '/../data/files/customer.csv');

// db params
$params = [
	'host' => 'localhost',
	'user' => 'test',
	'pwd'  => 'password',
	'db'   => 'php7cookbook'
];

// open access to csv file
$csv = new SplFileObject(CSV_FILE, 'r');

// get list of fields (1st row)
$fields = $csv->fgetcsv();

// init headers
printf('%4s | %20s | %5s | %4.2f' . PHP_EOL, 'ID', 'NAME', 'LEVEL');
printf('%4s | %20s | %5s | %4s'   . PHP_EOL, '----', str_repeat('-', 20), '-----', '----');

try {
	$dsn  = sprintf('pgsql:host=%s;dbname=%s;user=%s;password=%s', 
					$params['host'], 
					$params['db'],
					$params['user'],
					$params['pwd']);
	$pdo  = new PDO($dsn);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql  = "INSERT INTO customer "
		  . "(" . implode(",", $fields) . ") "
		  . "VALUES (" . substr(str_repeat('?,', count($fields)), 0, -1) . ")";
	echo $sql . PHP_EOL;
	//$pdo->beginTransaction();
	//$stmt = $pdo->prepare($sql);
	while (!$csv->eof()) {
		if ($row = $csv->fgetcsv()) {
			printf('%4d | %20s | %5s | %4.2f' . PHP_EOL, $row['id'], $row['name'], $row['level'], $row['balance']);
			//$stmt->execute($row);
		}
	}
	//$pdo->commit();
} catch (PDOException $e) {
	echo $e->getMessage();
	$pdo->rollBack();
} catch (Throwable $e) {
	echo $e->getMessage();
	$pdo->rollBack();
}
