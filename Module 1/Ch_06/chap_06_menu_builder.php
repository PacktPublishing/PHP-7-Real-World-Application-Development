<?php
// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// bootstrap and jquery config
$bootstrap = [
	'css' => [
		'bootstrap.min.css' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css',
		'boostrap-theme.min.css' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css',
	],
	'js' => [
		'jquery.min.js' => 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',
		'bootstrap.min.js' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js',
	],
];

// define base menu config
$menu = [
	'home' => [
		'label'  => 'Home',
		'url'    => '/',
		'dropDown' => [ 
			'about' => ['label' => 'About Us', 'url' => '/about'],
			'find'  => ['label' => 'Find Us',  'url' => '/find'],
		],
	],
	'products' => [
		'label'    => 'Products',
		'url'    => '/products',
		'dropDown' => [
			'software'   => ['label' => 'Software',  'url' => '/software'],
			'consulting' => ['label' => 'Consulting','url' => '/consulting'],
			'hardware'   => ['label' => 'Hardware',  'url' => '/hardware'],
		],
	],
	'services' => [
		'label' => 'Services',
		'url'   => '/services',
		'li'    => ['style' => 'list-style-type: none;'],
	],
	'pricing' => [
		'label' => 'Pricing',
		'url'   => '/pricing',
		'li'    => ['style' => 'list-style-type: none;'],
	],
	'contact' => [
		'label'  => 'Contact Us',
		'url'    => '/contact',
		'dropDown' => [
			'americas' => ['label' => 'Americas', 'url' => '/america'],
			'europe'   => ['label' => 'Europe',   'url' => '/europe'],
			'asia'     => ['label' => 'Asia',     'url' => '/asia'],
			'blank1'   => ['label' => '', 'url' => '#', 'li' => ['class' => 'divider']],
			'other'    => ['label' => 'Other',    'url' => '/other'],
		],
	],
];

$p = (isset($_GET['p'])) ? (int) $_GET['p'] : 0;
if ($p) {
	include __DIR__ . '/chap_06_menu_builder_' . $p . '.php';
	exit;
}
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="php7cookbook.css">
</head>
<body>

<div class="container">	
	<h1>Bootstrap Menu</h1>
	<ul>
		<li><a href="?p=1">Simple</a></li>
		<li><a href="?p=2">Nav-Pills</a></li>
		<li><a href="?p=3">Buttons</a></li>
	</ul>
</div>
</body>
</html>

