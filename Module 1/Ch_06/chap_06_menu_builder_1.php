<?php
// TARGET:
/*
<div class="dropdown">
	<a href="#" data-toggle="dropdown" class="dropdown-toggle">Dropdown</b></a>
	<ul class="dropdown-menu">
		<li><a href="#">Action</a></li>
		<li><a href="#">Another action</a></li>
	</ul>
</div>
*/

$factory = new Application\Web\Menu\Factory($menu, $bootstrap);
$factory->setToggleTag('<a href="%s" data-toggle="dropdown" class="dropdown-toggle">%s</b></a>');
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
	<h1>Simple Bootstrap Menu</h1>
	<hr>
	<?= $factory->render(); ?>
	<hr>
</div>
</body>
</html>

