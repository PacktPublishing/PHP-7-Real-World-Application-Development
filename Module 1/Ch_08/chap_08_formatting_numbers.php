<?php

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// classes to use
use Application\I18n\Locale;

$localeFr = new Locale('fr_FR');
$localeUk = new Locale('en_GB');
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
		<td><?= $localeFr->formatNumber($number); ?></td>
	</tr>
	<tr>
		<th>UK Format</th>
		<td><?= $localeUk->formatNumber($number); ?></td>
	</tr>
	<tr>
		<th>UK Parse French Number: <?= $localeFr->formatNumber($number) ?></th>
		<td><?= $localeUk->parseNumber($localeFr->formatNumber($number)); ?></td>
	</tr>
	<tr>
		<th>UK Parse UK Number: <?= $localeUk->formatNumber($number) ?></th>
		<td><?= $localeUk->parseNumber($localeUk->formatNumber($number)); ?></td>
	</tr>
	<tr>
		<th>FR Parse FR Number: <?= $localeFr->formatNumber($number) ?></th>
		<td><?= $localeFr->parseNumber($localeFr->formatNumber($number)); ?></td>
	</tr>
	<tr>
		<th>FR Parse UK Number: <?= $localeUk->formatNumber($number) ?></th>
		<td><?= $localeFr->parseNumber($localeUk->formatNumber($number)); ?></td>
	</tr>
</table>
</body>
</html>
