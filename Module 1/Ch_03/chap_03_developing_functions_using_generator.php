<?php
// developing functions -- using a generator

// it's a best practice to place all functions definitions 
// in a separate file which is then included
include (__DIR__ . DIRECTORY_SEPARATOR . 'chap_03_developing_functions_iterators_library.php');
include (__DIR__ . '/../Application/Web/Hoover.php');

// gather input from URI
$url    = trim(strip_tags($_GET['url'] ?? ''));
$filter = trim(strip_tags($_GET['filter'] ?? ''));
$limit  = (int) ($_GET['limit'] ?? 10);
$page   = (int) ($_GET['page']  ?? 0);

// define the page number used to move through the iteration
$next   = $page + 1;
$prev   = $page - 1;
$base   = '?url=' . htmlspecialchars($url) 
        . '&filter=' . htmlspecialchars($filter) 
        . '&limit=' . $limit 
        . '&page=';

// set up the code which will hoover a website looking for "href" attributes
$vac    = new Application\Web\Hoover();
$list   = $vac->getAttribute($url, 'href');

?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
    <h1>Filtered Results Using Generator</h1>
    <form>
    <table>
        <tr>
            <th>URL</th>
            <td><input type="text" name="url" value="<?= htmlspecialchars($url) ?>"/></td>
        </tr>
        <tr>
            <th>Filter</th>
            <td><input type="text" name="filter" value="<?= htmlspecialchars($filter) ?>"/></td>
        </tr>
        <tr>
            <th>Limit</th>
            <td><input type="text" name="limit" value="<?= $limit ?>"/></td>
        </tr>
        <tr>
            <th>&nbsp;</th><td><input type="submit" /></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <a href="<?= $base . $prev ?>"><-- PREV | 
                <a href="<?= $base . $next ?>">NEXT --></td>
        </tr>
    </table>
    </form>
    <hr>
    <?= htmlList(filteredResultsGenerator($list, $filter, $limit, $page)); ?>
</body>
</html>
