<?php
// developing functions -- using iterators

// pulls up a database record with secondary lookups
define('DB_CONFIG_FILE', '/../config/db.config.php');

// include function library + database connection class
include (__DIR__ . '/chap_03_developing_functions_iterators_library.php');
include (__DIR__ . '/../Application/Database/Connection.php');

// get name
$name = strip_tags($_GET['name'] ?? '');

try {
    
    // set up database connection
    $connection = new Application\Database\Connection(include __DIR__ . DB_CONFIG_FILE);

    // pull up a customer list
    $sql    = 'SELECT * FROM iso_country_codes';

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
    <h1>Filtered Results</h1>
    <form>
        Country Name: 
        <input type="text" name="name" value="<?= htmlspecialchars($name) ?>">
        <input type="submit" />
    </form>
    <?php nameFilterIterator(fetchCountryName($sql, $connection), $name); ?>
    <?= htmlList(nameFilterIterator(fetchCountryName($sql, $connection), $name)); ?>
</body>
</html>
