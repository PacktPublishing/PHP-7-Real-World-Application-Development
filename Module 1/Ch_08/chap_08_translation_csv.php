<?php

define('TRANS_FILE_PATTERN', __DIR__ . '/../data/languages/%s/translation.csv');
define('TEXT_FILE_PATTERN', __DIR__ . '/../data/languages/%s/%s.txt');

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// classes to use
use Application\I18n\Locale;
use Application\I18n\Translate\ { Translation, Adapter\Csv };

$locale = new Locale('es_ES');
$adapter = new Csv($locale, TRANS_FILE_PATTERN);
$translate = new Translation($adapter, $locale->getLocaleCode(), TEXT_FILE_PATTERN);
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="php7cookbook_html_table.css">
	<style>
	th {
		width: 200px;
	}
	li {
		text-align: left;
	}
	p {
		margin: 20px;
	}
	</style>
</head>
<body>
<table>
<tr>
	<th><h1 style="color:white;"><?= $translate('Welcome') ?></h1></th>
	<td>
		<div style="float:left;width:50%;vertical-align:middle;"><h3 style="font-size:24pt;"><i>Some Company, Inc.</i></h3></div>
		<div style="float:right;width:50%;"><img src="jcartier-city.png" width="300px"/></div>
	</td>
</tr>
<tr>
	<th>
		<ul>
			<li><?= $translate('About Us') ?></li>
			<li><?= $translate('Contact Us') ?></li>
			<li><?= $translate('Find Us') ?></li>
		</ul>
	</th>
	<td>
		<p>
		<?= $translate->text('main_page'); ?>
		</p>
		<p>
		<a href="#"><?= $translate('click') ?></a>
		</p>
	</td>
</tr>
</table>
</body>
</html>
