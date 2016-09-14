<?php
// TARGET:
/*
    <div class="btn-group">
        <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Action <span class="caret"></span></button>
        <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
        </ul>
    </div>
*/

// move services + pricing under "also"
$menu['also'] = [
		'label'    => 'Also',
		'dropDown' => [$menu['services'],$menu['pricing']]
];
// move url for home + products into new menu item
$menu['home']['dropDown'][] = ['home' => ['label' => 'Home', 'url' => '/']];
$menu['products']['dropDown'][] = ['products' => ['label' => 'Products',  'url' => '/products']];
// remove url settings + services + pricing from main menu buttons
unset($menu['home']['url']);
unset($menu['products']['url']);
unset($menu['contact']['url']);
unset($menu['services']);
unset($menu['pricing']);

// anchor Menu
use Application\Web\Menu\Factory;

$factory = new Factory($menu, $bootstrap, Factory::TYPE_BUTTON);
$factory->setDropdownWrapper('<div class="btn-group">');
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="php7cookbook.css">
	<?= $factory->header(); ?>
</head>
<body>

<div class="container">	
	<h1>Button Groups Bootstrap Menu</h1>
	<hr>
	<?= $factory->render(); ?>
	<hr>
</div>
</body>
</html>

