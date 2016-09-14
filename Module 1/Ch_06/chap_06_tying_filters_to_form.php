<?php
// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

include __DIR__ . '/chap_06_post_data_config_messages.php';
include __DIR__ . '/chap_06_post_data_config_callbacks.php';
include __DIR__ . '/chap_06_tying_filters_to_form_definitions.php';

// anchor classes
use Application\Form\Factory;
use Application\Filter\ { Validator, Filter };

// assign filter and validator to form
$form = Factory::generate($elements);
$form->setFilter(new Filter($callbacks['filters'], $assignments['filters']));
$form->setValidator(new Validator($callbacks['validators'], $assignments['validators']));

// check to see if any $_POST data
$message = '';
if (isset($_POST['submit'])) {
	$form->setData($_POST);
	if ($form->validate()) {
		$message = VALIDATE_SUCCESS;
	} else {
		$message = VALIDATE_FAILURE;
	}
	$form->filter();
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
	<!-- Get Status -->
	<h1>Status</h1>
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
</div>
</body>
</html>

