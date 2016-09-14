<?php
// database lookup AST example
// pulls up a database record with secondary lookups

define('DB_CONFIG_FILE', '/../../data/config/db.config.php');

// setup class autoloading
require __DIR__ . '/../../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/../..');

try {
    
    // set up database connection
    $connection = new Application\Database\Connection(include __DIR__ . DB_CONFIG_FILE);

    // pull up a customer at random
    $custId = rand(1, 79);
    $sql    = 'SELECT * FROM customer AS c WHERE c.id = ?';
    $stmt   = $connection->pdo->prepare($sql);
    $stmt->execute([$custId]);
    
    // retrieve customer info
    $customer = new Application\Entity\Customer($stmt->fetch(PDO::FETCH_ASSOC), $connection);

} catch (Throwable $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <style>
        td {
            text-align: left;
            border: thin solid black;
        }
        th {
            text-align: right;
            border: thin solid black;
            margin-right: 20px;
            color: gray;
        }
    </style>
</head>
<body>
    <?= $customer->render($customer->values); ?>
</body>
</html>
