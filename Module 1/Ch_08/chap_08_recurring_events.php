<?php
// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// classes to use
use Application\I18n\ { Locale, Calendar, Event };

//	public function __construct($name, $startDate, $interval, $value, $occurrences = NULL, $endDate = NULL, $flag = NULL)
try {
	$year = 2016;
	$localeEs = new Locale('es_ES');
	$calendarEs = new Calendar($localeEs);
	
	// add event: 3 days
	$title = 'Conf';
	$description = 'Special 3 day symposium on eco-waste';
	$startDate = '2016-01-08';
	$event = new Event($title, $description, $startDate, Event::INTERVAL_DAY, 1, 2);
	$calendarEs->addEvent($event);

	// add event: every other week for 11 events
	$title = 'Online Forum';
	$description = 'Monthly online forum for all unlikelysource.com partners and customers';
	$startDate = new DateTime('2016-01-01');
	$event = new Event($title, $description, $startDate, Event::INTERVAL_WEEK, 2, 11);
	$calendarEs->addEvent($event);

	// add event: 1st of every month until September 2017
	$title = 'Pay Rent';
	$description = 'Sent rent check to landlord';
	$startDate = new DateTime('2016-02-01');
	$event = new Event($title, $description, $startDate, Event::INTERVAL_MONTH, 1, '2017-09-01', NULL, Event::FLAG_FIRST);
	$calendarEs->addEvent($event);

	// add event: every week for 40 weeks
	$title = 'Call Mom';
	$description = 'Check up on Mom';
	$startDate = '2016-01-05';
	$event = new Event($title, $description, $startDate, Event::INTERVAL_WEEK, 1, 52);
	$calendarEs->addEvent($event);

	//echo '<pre>', var_dump($eventArray, $calendarEs->getYearArray()), '</pre>'; exit;
} catch (Throwable $e) {
	$message = $e->getMessage();
}
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="php7cookbook_html_table.css">
</head>
<body>
<h3>Year: <?= $year ?></h3>
<?= $message ?? ''; ?>
<!-- 	public function calendarForYear($year, 
									$timeZone = NULL, 
									$dayType = self::DAY_1, 
									$monthType = self::MONTH_3, 
									$across = self::DEFAULT_ACROSS)
-->
<?= $calendarEs->calendarForYear($year, 'Europe/Berlin', Calendar::DAY_3, Calendar::MONTH_FULL, 2); ?>
<?= $calendarEs->calendarForMonth($year, 1	, 'Europe/Berlin', Calendar::DAY_FULL); ?>
<pre>
<?php //var_dump($calendarEs->getYearArray()); ?>
</pre>
</body>
</html>
