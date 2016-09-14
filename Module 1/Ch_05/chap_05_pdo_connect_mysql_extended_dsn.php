<?php
// example of PDO MySQL connection showing extra DSN param "unix_socket" + "charset"

$params = [
	'host' => 'localhost',
	'user' => 'test',
	'pwd'  => 'password',
	'db'   => 'php7cookbook',
	'sock' => '/var/run/mysqld/mysqld.sock'
];

try {
	$dsn  = sprintf('mysql:charset=UTF8;host=%s;dbname=%s;unix_socket=%s', 
					$params['host'], $params['db'], $params['sock']);
	$opts = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
	$pdo  = new PDO($dsn, $params['user'], $params['pwd'], $opts);
	$stmt = $pdo->query('SELECT * FROM customer ORDER BY id LIMIT 20');
	printf('%4s | %20s | %5s' . PHP_EOL, 'ID', 'NAME', 'LEVEL');
	printf('%4s | %20s | %5s' . PHP_EOL, '----', str_repeat('-', 20), '-----');
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		printf('%4d | %20s | %5s' . PHP_EOL, $row['id'], $row['name'], $row['level']);
	}
} catch (PDOException $e) {
	echo $e->getMessage();
} catch (Throwable $e) {
	echo $e->getMessage();
}
