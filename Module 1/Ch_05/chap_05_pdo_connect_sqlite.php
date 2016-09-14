<?php
// example of PDO MySQL connection

$params = [
	'user' => NULL,
	'pwd'  => NULL,
	'db'   => __DIR__ . '/../data/db/php7cookbook.db.sqlite'
];

try {
	$dsn  = sprintf('sqlite:' . $params['db']);
	$opts = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
	// no username or password for sqlite, thus NULL x 2
	$pdo  = new PDO($dsn, $params['user'], $params['pwd'], $opts);
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

