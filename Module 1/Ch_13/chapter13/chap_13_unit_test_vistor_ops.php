<?php
require_once __DIR__ . '/VisitorOps.php';
require_once __DIR__ . '/VisitorService.php';
$dbConfig = [
	'driver'   => 'mysql',
	'host'     => 'localhost',
	'dbname'   => 'php7cookbook_test',
	'user'     => 'cook',
	'password' => 'book',
	'errmode'  => PDO::ERRMODE_EXCEPTION,
];
$testData = [
	'id' => 1,
	'email' => 'test@unlikelysource.com',
	'visit_date' => '2000-01-01 00:00:00',
	'comments' => 'TEST',
	'name' => 'TEST'
];
$visitorOps = new VisitorOps($dbConfig);
$visitorOps->addVisitor($testData);
echo $visitorOps->getSql() . PHP_EOL;
echo $visitorOps->getSql() . PHP_EOL;
var_dump($visitorOps->findAll());
$visitorOps->removeById(1);

$dbConfig['dbname'] = 'php7cookbook';
$visitorService = new VisitorService($dbConfig);
echo $visitorService->showAllVisitors();
