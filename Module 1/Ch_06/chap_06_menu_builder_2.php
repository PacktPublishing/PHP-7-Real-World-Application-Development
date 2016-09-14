<?php
// TARGET:
/*
<ul class="nav nav-pills">
	<li class="active"><a href="#">Home</a></li>
	<li><a href="#">Profile</a></li>
	<li class="dropdown">
		<a href="#" data-toggle="dropdown" class="dropdown-toggle">Messages <b class="caret"></b></a>
		<ul class="dropdown-menu">
			<li><a href="#">Inbox</a></li>
			<li><a href="#">Drafts</a></li>
			<li><a href="#">Sent Items</a></li>
			<li class="divider"></li>
			<li><a href="#">Trash</a></li>
		</ul>
	</li>
</ul>
*/

$factory = new Application\Web\Menu\Factory($menu, $bootstrap);
$factory->setDropdownWrapper('<li class="dropdown menuItem">');
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
	<h1>Nav-Pills Bootstrap Menu</h1>
	<ul class="nav nav-pills">
		<?= $factory->render(); ?>
	</ul>
</div>
</body>
</html>

