<?php
// example of PDO MySQL connection using PDO::FETCH_INTO

class Customer
{
	// NOTE: properties must be public for fetch injection to work
	public $id;
	public $name;
	public $level;
}

$params = [
	'host' => 'localhost',
	'user' => 'test',
	'pwd'  => 'password',
	'db'   => 'php7cookbook'
];

try {
	$cust = new Customer();
	$dsn  = sprintf('mysql:charset=UTF8;host=%s;dbname=%s', $params['host'], $params['db']);
	$opts = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
	$pdo  = new PDO($dsn, $params['user'], $params['pwd'], $opts);
	$sql  = 'SELECT id,name,level FROM customer ORDER BY id LIMIT 20';
	$stmt = $pdo->query($sql, PDO::FETCH_INTO, $cust);
	printf('%4s | %20s | %5s' . PHP_EOL, 'ID', 'NAME', 'LEVEL');
	printf('%4s | %20s | %5s' . PHP_EOL, '----', str_repeat('-', 20), '-----');
	// NOTE: each iteration repopulates the same object instance
	while ($stmt->fetch(PDO::FETCH_INTO)) {
		printf('%4d | %20s | %5s' . PHP_EOL, $cust->id, $cust->name, $cust->level);
	}
} catch (PDOException $e) {
	echo $e->getMessage();
} catch (Throwable $e) {
	echo $e->getMessage();
}
