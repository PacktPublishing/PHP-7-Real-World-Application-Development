<?php
// example of PDO postgreSQL connection

$params = [
	'host' => 'localhost',
	'user' => 'test',
	'pwd'  => 'password',
	'db'   => 'php7cookbook'
];

try {
	$dsn  = sprintf('pgsql:host=%s;dbname=%s;user=%s;password=%s', 
					$params['host'], 
					$params['db'],
					$params['user'],
					$params['pwd']);
	$pdo  = new PDO($dsn);
	$stmt = $pdo->query('SELECT * FROM customer ORDER BY id LIMIT 20');
	printf('%4s | %20s | %5s | %7s' . PHP_EOL, 'ID', 'NAME', 'LEVEL', 'BALANCE');
	printf('%4s | %20s | %5s | %7s' . PHP_EOL, '----', str_repeat('-', 20), '-----', '-------');
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		printf('%4d | %20s | %5s | %7.2f' . PHP_EOL, 
				$row['id'], $row['name'], $row['level'], $row['balance']);
	}
} catch (PDOException $e) {
	echo $e->getMessage();
} catch (Throwable $e) {
	echo $e->getMessage();
}
