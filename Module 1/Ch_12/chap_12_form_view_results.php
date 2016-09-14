<?php
// form which is unprotected from CSRF attacks

session_start();
define('DB_CONFIG_FILE', '/../config/db.config.php');

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\Database\Connection;
$conn = new Connection(include __DIR__ . DB_CONFIG_FILE);

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

// query visitors table
$stmt = $conn->pdo->query('SELECT * FROM visitors');
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="php7cookbook.css">
</head>
<body>

<div class="container">

	<h1>CSRF Protection</h1>

	<!-- display contents of "visitors" table -->
	<h3>Visitors Table</h3>

	<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
	<pre><?php     echo implode(':', $row); ?></pre>
	<?php endwhile; ?>

	<?php if ($message) : ?>
	<b><?= $message; ?></b>
	<?php endif; ?>

	<hr>
	<br><a href="/chap_12_form_protected_index.php">INDEX</a>

</div>

</body>
</html>


