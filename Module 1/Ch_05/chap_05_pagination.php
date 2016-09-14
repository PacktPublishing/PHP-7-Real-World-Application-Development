<?php
// pagination example

define('DB_CONFIG_FILE', '/../config/db.config.php');
define('LINES_PER_PAGE', 10);
define('DEFAULT_BALANCE', 1000);

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// classes to use
use Application\Database\ { Finder, Connection, Paginate};

// get connection
$conn = new Connection(include __DIR__ . DB_CONFIG_FILE);

// generate SQL
$sql = Finder::select('customer')->where('balance < :bal');

// get current page number + balance
$page = (int) ($_GET['page'] ?? 0);
$bal  = (float) ($_GET['balance'] ?? DEFAULT_BALANCE);

// create pagination object
$paginate = new Paginate($sql::getSql(), $page, LINES_PER_PAGE);
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<h3><?= $paginate->getSql(); ?></h3>	
<hr>
<pre>
<?php
printf('%4s | %20s | %5s | %7s' . PHP_EOL, 'ID', 'NAME', 'LEVEL', 'BALANCE');
printf('%4s | %20s | %5s | %7s' . PHP_EOL, '----', str_repeat('-', 20), '-----', '-------');
foreach ($paginate->paginate($conn, PDO::FETCH_ASSOC, ['bal' => $bal]) as $row) {
	printf('%4d | %20s | %5s | %7.2f' . PHP_EOL, 
			$row['id'], $row['name'], $row['level'], $row['balance']);
}
printf('%4s | %20s | %5s | %7s' . PHP_EOL, '----', str_repeat('-', 20), '-----', '-------');
?>
<a href="?page=<?= $page - 1; ?>&balance=<?= $bal ?>"><< Prev </a>                              <a href="?page=<?= $page + 1; ?>&balance=<?= $bal ?>">Next >></a>
</pre>
</body>
</html>
