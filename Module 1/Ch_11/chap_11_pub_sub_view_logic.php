<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="php7cookbook.css">
</head>
<body>

<div class="container">
	<h1>Add/Update Prospect</h1>
	<form method="GET">
		<?= $select ?><input type="submit" name="find" value="Find" />
	</form>
	<?= $form->render($form, $formConfig); ?>
	<?php if (strpos($message, 'SUCCESS') === 0) : ?>
	<?php     $color = 'green'; ?>
	<?php elseif (strpos($message, 'FAILURE') === 0) : ?>
	<?php     $color = 'red'; ?>
	<?php else : ?>
	<?php     $color = 'white'; ?>
	<?php endif; ?>
	<span style="color:<?= $color ?>;"><?= $message ?></span>
</div>
<div class="container" style="margin-left: 20px;">
	<h1 style="background-color: #D897F6;">Data</h1>
	<pre style="margin-left: 20px;"><?= var_dump($_POST); ?></pre>
	<h1 style="background-color: #BFBFBF;">Access Log</h1>
	<pre style="margin-left: 20px;"><?= readfile(LOG_FILE); ?></pre>
	<h1 style="background-color: #D897F6;">Error File</h1>
	<pre style="margin-left: 20px;"><?= readfile(ERROR_FILE); ?></pre>
</div>
</body>
</html>

