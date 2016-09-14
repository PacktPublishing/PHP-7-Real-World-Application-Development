<?php
// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// classes to use
use Application\I18n\Locale;

$locale = [NULL, 'fr-FR', 'da, en-gb;q=0.8, en;q=0.7'];
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="php7cookbook_html_table.css">
</head>
<body>
<table style="width:60%">
<th>Accept-Language</th><th>Derived Locale</th></tr>
<?php
foreach ($locale as $code) {
	$locale = new Locale($code); 
	echo '<tr><td>' . htmlspecialchars($code) . '</td><td>' . $locale->getLocaleCode() . '</td></tr>';
}
?>
</table>
</body>
</html>
