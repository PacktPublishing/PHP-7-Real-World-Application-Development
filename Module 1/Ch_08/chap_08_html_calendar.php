<?php
// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// classes to use
use Application\I18n\Locale;
use Application\I18n\Calendar;

$localeFr = new Locale('fr-FR');
$localeUs = new Locale('en_US');
$localeTh = new Locale('th_TH');
$calendarFr = new Calendar($localeFr);
$calendarUs = new Calendar($localeUs);
$calendarTh = new Calendar($localeTh);
$year = 2016;
$month = 1;
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="php7cookbook_html_table.css">
</head>
<body>
<h3>Year: <?= $year ?></h3>
<?= $calendarFr->calendarForMonth($year, $month, NULL, Calendar::DAY_FULL); ?>
<?= $calendarUs->calendarForMonth($year, $month, NULL, Calendar::DAY_FULL); ?>
<?= $calendarTh->calendarForMonth($year, $month, NULL, Calendar::DAY_FULL); ?>
</body>
</html>
