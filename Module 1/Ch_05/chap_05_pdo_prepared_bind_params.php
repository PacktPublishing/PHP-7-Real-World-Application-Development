<?php
// example of PDO prepared statement using bound parameters

$params = [
	'host' => 'localhost',
	'user' => 'test',
	'pwd'  => 'password',
	'db'   => 'php7cookbook'
];

function showResults($stmt, $min, $max, $level)
{
	echo "Results for $min to $max at level $level\n";
	echo "----------------------------------------------\n";
	printf('%4s | %20s | %5s | %8s' . PHP_EOL, 'ID', 'NAME', 'LEVEL', 'BAL');
	printf('%4s | %20s | %5s | %8s' . PHP_EOL, '----', str_repeat('-', 20), '-----', '-----');
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		printf('%4d | %20s | %5s | %8.2f' . PHP_EOL, 
			$row['id'], $row['name'], $row['level'], $row['balance']);
	}
}

// init vars
$min   = 0;
$max   = 0;
$level = '';

try {
	$dsn  = sprintf('mysql:charset=UTF8;host=%s;dbname=%s', $params['host'], $params['db']);
	$opts = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
	$pdo  = new PDO($dsn, $params['user'], $params['pwd'], $opts);
	$sql  = 'SELECT * FROM customer '
		  . 'WHERE balance > :min AND balance < :max AND level = :level '
		  . 'ORDER BY id LIMIT 20';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam('min',   $min);
	$stmt->bindParam('max',   $max);
	$stmt->bindParam('level', $level);
	
	$min   =  5000;
	$max   = 10000;
	$level = 'ADV';
	$stmt->execute();
	showResults($stmt, $min, $max, $level);
	echo PHP_EOL;
	
	$min   = 0;
	$max   = 100;
	$level = 'BEG';
	$stmt->execute();
	showResults($stmt, $min, $max, $level);
	
} catch (PDOException $e) {
	echo $e->getMessage();
} catch (Throwable $e) {
	echo $e->getMessage();
}
