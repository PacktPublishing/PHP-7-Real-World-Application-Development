<?php
// developing functions -- using iterators

// pulls up a database record with secondary lookups
define('DB_CONFIG_FILE', '/../config/db.config.php');
define('ITEMS_PER_PAGE', [5, 10, 15, 20]);

// include function library + database connection class
include (__DIR__ . '/chap_03_developing_functions_iterators_library.php');
include (__DIR__ . '/../Application/Database/Connection.php');

// get name
$name = strip_tags($_GET['name'] ?? '');

// get page number + items per page
$limit  = (int) ($_GET['limit'] ?? 10);
$page   = (int) ($_GET['page']  ?? 0);
$offset = $page * $limit;
$prev   = ($page > 0) ? $page - 1 : 0;
$next   = $page + 1;

try {
    
    // set up database connection
    $connection = new Application\Database\Connection(include __DIR__ . DB_CONFIG_FILE);

    // pull up a country list
    $sql    = 'SELECT * FROM iso_country_codes';

    // get ArrayIterator + FilteredIterator + LimitIterator
    $arrayIterator    = fetchCountryName($sql, $connection);
    $filteredIterator = nameFilterIterator($arrayIterator, $name);
    $limitIterator    = pagination($filteredIterator, $offset, $limit);
    
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
    <h1>Filtered and Paginated Results</h1>
    <form>
        Country Name: 
        <input type="text" name="name" value="<?= htmlspecialchars($name) ?>">
        Items Per Page: 
        <select name="limit">
            <?php foreach (ITEMS_PER_PAGE as $item) : ?>
                <option<?= ($item == $limit) ? ' selected' : '' ?>><?= $item ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" />
    </form>
     <a href="?name=<?= $name ?>&limit=<?= $limit ?>&page=<?= $prev ?>"><< PREV</a> 
     | <a href="?name=<?= $name ?>&limit=<?= $limit ?>&page=<?= $next ?>">NEXT >></a>
    <?= htmlList($limitIterator); ?>
</body>
</html>
