<?php
// example of PDO MySQL connection using PDO::FETCH_OBJ

$params = [
	'host' => 'localhost',
	'user' => 'test',
	'pwd'  => 'password',
	'db'   => 'php7cookbook'
];

try {
	$dsn  = sprintf('mysql:host=%s;dbname=%s', $params['host'], $params['db']);
	$opts = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
	$pdo  = new PDO($dsn, $params['user'], $params['pwd'], $opts);
	$stmt = $pdo->query('SELECT * FROM customer ORDER BY id LIMIT 20');
	printf('%4s | %20s | %5s' . PHP_EOL, 'ID', 'NAME', 'LEVEL');
	printf('%4s | %20s | %5s' . PHP_EOL, '----', str_repeat('-', 20), '-----');
	// NOTE: uses stdClass
	while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
		printf('%4d | %20s | %5s' . PHP_EOL, $row->id, $row->name, $row->level);
	}
} catch (PDOException $e) {
	echo $e->getMessage();
} catch (Throwable $e) {
	echo $e->getMessage();
}
