<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="php7cookbook_html_table.css">
</head>
<body>

<div class="container">
	
	<form method="get" name="directions">
	<table>
		<tr>
		<th style="background-color: yellow;">Start</th>
		<td><input type="text" name="start" ></td>
		<th style="background-color: yellow;">End</th>
		<td><input type="text" name="end" ></td>
		<th style="background-color: yellow;">&nbsp;</th>
		<td><input type="submit" value="OK"></td>
		</tr>
	</table>
	</form>
	<?php foreach ($routes->legs as $item) : ?>
		<!-- Trip Info -->
		<div class="row">
			<div class="left">Distance</div>
			<div class="right"><?= $item->distance->text; ?></div>
		</div>
		<div class="row">
			<div class="left">Duration</div>
			<div class="right"><?= $item->duration->text; ?></div>
		</div>
		<div class="row">
			<div class="left">Start</div>
			<div class="right"><?= $item->start_address; ?></div>
		</div>
		<div class="row">
			<div class="left">End</div>
			<div class="right"><?= $item->end_address; ?></div>
		</div>
		<!-- Driving Directions -->
		<div class="row">
			<table>
				<tr>
					<th>Distance</th><th>Duration</th><th>Directions</th>
				</tr>
				<?php foreach ($item->steps as $step) : ?>
				<?php $class = ($count++ & 01) ? 'color1' : 'color2'; ?>
				<tr>
					<td class="<?= $class ?>"><?= $step->distance->text ?></td>
					<td class="<?= $class ?>"><?= $step->duration->text ?></td>
					<td class="<?= $class ?>"><?= $step->html_instructions ?></td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<!-- End Purchases Info -->
		<div class="row color3">&nbsp;</div>
	</div>

	<?php endforeach; ?>
	<div class="container">
		<?= $routes->bounds->copyrights; ?>
	</div>
	<div class="clearRow"></div>

</div>
</body>
</html>

