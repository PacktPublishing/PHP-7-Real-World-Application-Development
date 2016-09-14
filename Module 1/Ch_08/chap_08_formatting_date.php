<?php
// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// classes to use
use Application\I18n\Locale;

$localeFr = new Locale('fr-FR');
$localeUs = new Locale('en_US');
$date     = '2016-02-29 17:23:58';
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="php7cookbook_html_table.css">
</head>
<body>
<h3>Date: <?= $date ?></h3>
<table>
	<tr><th>Locale</th><th>Full</th><th>Long</th><th>Medium</th><th>Short</th></tr>
	<tr>
		<th>French Format</th>
		<td><?= $localeFr->formatDate($date, Locale::DATE_TYPE_FULL); ?></td>
		<td><?= $localeFr->formatDate($date, Locale::DATE_TYPE_LONG); ?></td>
		<td><?= $localeFr->formatDate($date, Locale::DATE_TYPE_MEDIUM); ?></td>
		<td><?= $localeFr->formatDate($date, Locale::DATE_TYPE_SHORT); ?></td>
	</tr>
	<tr>
		<th>US Format</th>
		<td><?= $localeUs->formatDate($date, Locale::DATE_TYPE_FULL); ?></td>
		<td><?= $localeUs->formatDate($date, Locale::DATE_TYPE_LONG); ?></td>
		<td><?= $localeUs->formatDate($date, Locale::DATE_TYPE_MEDIUM); ?></td>
		<td><?= $localeUs->formatDate($date, Locale::DATE_TYPE_SHORT); ?></td>
	</tr>
</table>
<table>
	<tr><th>Locale</th><th>Try to Parse</th><th>Result</th></tr>
	<tr>
		<th><?= $localeFr->getLocaleCode(); ?></th>
		<td><?= $localeFr->formatDate($date, Locale::DATE_TYPE_MEDIUM); ?></td>
		<td><?= $localeFr->parseDate($localeFr->formatDate($date, Locale::DATE_TYPE_MEDIUM)); ?></td>
	</tr>
	<tr>
		<th><?= $localeFr->getLocaleCode(); ?></th>
		<td><?= $localeUs->formatDate($date, Locale::DATE_TYPE_MEDIUM); ?></td>
		<td><?= $localeFr->parseDate($localeUs->formatDate($date, Locale::DATE_TYPE_MEDIUM)); ?></td>
	</tr>
	<tr>
		<th><?= $localeUs->getLocaleCode(); ?></th>
		<td><?= $localeFr->formatDate($date, Locale::DATE_TYPE_MEDIUM); ?></td>
		<td><?= $localeUs->parseDate($localeFr->formatDate($date, Locale::DATE_TYPE_MEDIUM)); ?></td>
	</tr>
	<tr>
		<th><?= $localeUs->getLocaleCode(); ?></th>
		<td><?= $localeUs->formatDate($date, Locale::DATE_TYPE_MEDIUM); ?></td>
		<td><?= $localeUs->parseDate($localeUs->formatDate($date, Locale::DATE_TYPE_MEDIUM)); ?></td>
	</tr>
</table>
</body>
</html>
