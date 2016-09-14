<?php
// example of PDO prepared statement using named placeholders
// NOTE: MySQL and SQLite *do not* support scrollable cursors!

$params = [
	'host' => 'localhost',
	'user' => 'test',
	'pwd'  => 'password',
	'db'   => 'php7cookbook'
];

// init vars
$min = 100;
$max = 1000;

// header output
echo "Results for $min to $max\n";
echo "----------------------------------------------\n";
printf('%4s | %20s | %5s | %8s' . PHP_EOL, 'ID', 'NAME', 'LEVEL', 'BAL');
printf('%4s | %20s | %5s | %8s' . PHP_EOL, '----', str_repeat('-', 20), '-----', '-----');

try {
	$dsn  = sprintf('pgsql:charset=UTF8;host=%s;dbname=%s', $params['host'], $params['db']);
	$opts = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]; 
	$pdo  = new PDO($dsn, $params['user'], $params['pwd'], $opts);
	$sql  = 'SELECT * FROM customer '
		  . 'WHERE balance > :min AND balance < :max '
		  . 'ORDER BY id LIMIT 20';
	$stmt = $pdo->prepare($sql, [PDO::ATTR_CURSOR  => PDO::CURSOR_SCROLL]);
	$stmt->execute(['min' => $min, 'max' => $max]);
	$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_LAST);
	do {
		printf('%4d | %20s | %5s | %8.2f' . PHP_EOL, 
			   $row['id'], 
			   $row['name'], 
			   $row['level'], 
			   $row['balance']);
	} while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_PRIOR));
} catch (PDOException $e) {
	echo $e->getMessage();
} catch (Throwable $e) {
	echo $e->getMessage();
}
