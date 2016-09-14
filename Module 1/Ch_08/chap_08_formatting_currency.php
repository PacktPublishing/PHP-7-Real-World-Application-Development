<?php
define('DB_CONFIG_FILE', __DIR__ . '/../config/db.config.php');
define('CURRENCY_CSV', __DIR__ . '/../data/files/iso_country_codes.csv');

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// classes to use
use Application\I18n\Locale;
use Application\I18n\IsoCodesDb;
use Application\I18n\IsoCodesCsv;
use Application\Database\Connection;

// using the database adapter
$connection = new Connection(include DB_CONFIG_FILE);
$isoLookup = new IsoCodesDb($connection, 'iso_country_codes', 'iso2');

// using the CSV adapter
//$isoLookup = new IsoCodesCsv(CURRENCY_CSV, 1);

$localeFr = new Locale('fr-FR', $isoLookup);
$localeUk = new Locale('en_GB', $isoLookup);
$number   = 1234567.89;
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="php7cookbook_html_table.css">
</head>
<body>
<table>
	<tr>
		<th>Number</th>
		<td>1234567.89</td></tr>
	<tr>
		<th>French Format</th>
		<td><?= $localeFr->formatCurrency($number); ?></td>
	</tr>
	<tr>
		<th>UK Format</th>
		<td><?= $localeUk->formatCurrency($number); ?></td>
	</tr>
	<tr>
		<th>UK Parse French Currency: <?= $localeFr->formatCurrency($number) ?></th>
		<td><?= $localeUk->parseCurrency($localeFr->formatCurrency($number)); ?></td>
	</tr>
	<tr>
		<th>UK Parse UK Currency: <?= $localeUk->formatCurrency($number) ?></th>
		<td><?= $localeUk->parseCurrency($localeUk->formatCurrency($number)); ?></td>
	</tr>
	<tr>
		<th>FR Parse FR Currency: <?= $localeFr->formatCurrency($number) ?></th>
		<td><?= $localeFr->parseCurrency($localeFr->formatCurrency($number)); ?></td>
	</tr>
	<tr>
		<th>FR Parse UK Currency: <?= $localeUk->formatCurrency($number) ?></th>
		<td><?= $localeFr->parseCurrency($localeUk->formatCurrency($number)); ?></td>
	</tr>
</table>
</body>
</html>
