<?php
// developing functions -- using iterators

// pulls up a database record with secondary lookups
define('DB_CONFIG_FILE', '/../config/db.config.php');
define('level', ['BEG','INT','ADV']);

// include function library + database connection class
include (__DIR__ . '/chap_03_developing_functions_iterators_library.php');
include (__DIR__ . '/../Application/Database/Connection.php');

// get page number + items per page
$limit  = (int) ($_GET['limit'] ?? 10);
$page   = (int) ($_GET['page']  ?? 0);
$offset = $page * $limit;
$prev   = $page - 1;
$next   = $page + 1;

try {
    
    // set up database connection
    $connection = new Application\Database\Connection(include __DIR__ . DB_CONFIG_FILE);

    // pull up a customer list
    $sql    = 'SELECT * FROM iso_country_codes';

    // set up pagination
    $pagination = new LimitIterator(fetchCountryName($sql, $connection), $offset, $limit);
    
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
    <h1>Paginated Results</h1>
    <form>
        Items Per Page: <input type="text" name="limit" value="<?= $limit ?>"/>
        <input type="submit" />
     </form>
     <br>
     <a href="?limit=<?= $limit ?>&page=<?= $prev ?>"><< PREV</a> | <a href="?limit=<?= $limit ?>&page=<?= $next ?>">NEXT >></a>
     <hr>
    <?= htmlList($pagination); ?>
    <hr>
</body>
</html>
