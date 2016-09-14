<?php

require 'vendor/autoload.php';

use DebugBar\StandardDebugBar;
$debugbar = new StandardDebugBar();

$dsn = "mysql:dbname=test;host=localhost;port=3306";
$username = "root";
$password = "";

try {
    $db = new PDO($dsn, $username, $password);
    $pdo = new \DebugBar\DataCollector\PDO\TraceablePDO($db);
    $debugbar->addCollector(new \DebugBar\DataCollector\PDO\PDOCollector($pdo));
} catch(PDOException $e) {
    die("Connection Error: ".$e->getMessage());
}

$users = $db->query("SELECT * FROM users");
foreach($users as $user)
{
    echo $user['id'];
}


$debugbarRenderer = $debugbar->getJavascriptRenderer("http://localhost/tests/php7/debug/debugbar/src/DebugBar/Resources");

$debugbar['messages']->addMessage("PHP 7 by Packt!");
$debugbar['messages']->addMessage('Written by Altaf Hussain');
?>
<html>
<head>
    <?php echo $debugbarRenderer->renderHead() ?>
</head>
<body>
 <h1>Welcome to PHP Debug Bar</h1>
<?php echo $debugbarRenderer->render() ?>
</body>
</html>