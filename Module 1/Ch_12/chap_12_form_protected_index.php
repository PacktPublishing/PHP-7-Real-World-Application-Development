<?php
define('DB_CONFIG_FILE', '/../config/db.config.php');

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\Database\Connection;
$conn = new Connection(include __DIR__ . DB_CONFIG_FILE);
$conn->pdo->query('DELETE FROM visitors');
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="php7cookbook.css">
</head>
<body onload="load()">

<div class="container">

	<h1>CSRF Form Protection</h1>

	<ul>
	<li><a href="/chap_12_form_csrf_test_unprotected.html">CSRF Test Against Un-protected Form</a></li>
	<li><a href="/chap_12_form_csrf_test_protected.html">CSRF Test Against Protected Form</a></li>
	<li><a href="/chap_12_form_protected.php">Form With Token</a></li>
	</ul>

</div>
</body>
</html>

