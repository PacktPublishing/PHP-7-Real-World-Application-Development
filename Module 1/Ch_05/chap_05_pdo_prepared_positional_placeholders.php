<?php
// example of PDO prepared statement using positional placeholders

// connection params
$params = [
	'host' => 'localhost',
	'user' => 'test',
	'pwd'  => 'password',
	'db'   => 'php7cookbook'
];

// data to be inserted
$fields = ['name', 'balance', 'email', 'password', 'status', 'level'];
$data = [
	['Saleen',     0,'saleen@unlikelysource.com', 'password',0,'BEG'],
	['Lada',   55.55,'lada@unlikelysource.com',   'password',0,'INT'],
	['Tonsoi',999.99,'tongsoi@unlikelysource.com','password',1,'ADV'],
	['SQL Injection',0.00,'bad','bad',1,'BEG\';DELETE FROM customer;--'],
];

try {
	$dsn  = sprintf('mysql:charset=UTF8;host=%s;dbname=%s', $params['host'], $params['db']);
	$pdo  = new PDO($dsn, 
					$params['user'], 
					$params['pwd'], 
					[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	$sql  = "INSERT INTO customer "
		  . "(`" . implode("`,`", $fields) . "`) "
		  . "VALUES (?,?,?,?,?,?)";
	echo $sql . PHP_EOL;
	$stmt = $pdo->prepare($sql);
	foreach ($data as $row) $stmt->execute($row);
} catch (PDOException $e) {
	echo $e->getMessage();
} catch (Throwable $e) {
	echo $e->getMessage();
}
