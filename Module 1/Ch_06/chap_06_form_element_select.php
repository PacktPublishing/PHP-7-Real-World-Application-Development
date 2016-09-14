<?php
// uses Application\Form\Element\Select

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// anchor Generic and Select element classes
use Application\Form\Generic;
use Application\Form\Element\Select;

// define "wrappers"
$wrappers = [
	Generic::INPUT => ['type' => 'td', 'class' => 'content'],
	Generic::LABEL => ['type' => 'th', 'class' => 'label'],
	Generic::ERRORS => ['type' => 'td', 'class' => 'error']
];

// define status array
$statusList = [
	'U' => 'Unconfirmed',
	'P' => 'Pending',
	'T' => 'Temporary Approval',
	'A' => 'Approved'
];

// define elements
$status1 = new Select('status1', 
					Generic::TYPE_SELECT, 
					'Status 1',
					$wrappers,
					['id' => 'status1']);
$status2 = new Select('status2', 
					Generic::TYPE_SELECT, 
					'Status 2',
					$wrappers,
					['id' => 'status2', 'multiple' => '', 'size' => '4']);
$submit = new Generic('submit', 
					Generic::TYPE_SUBMIT,
					'Process',
					$wrappers,
					['id' => 'submit','title' => 'Click to process status','value' => 'Click Here']);

// get status from $_GET if any
$checked1 = $_GET['status1'] ?? 'U';
$checked2 = $_GET['status2'] ?? ['U'];

// set options
$status1->setOptions($statusList, $checked1);
$status2->setOptions($statusList, $checked2);

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
	<form name="status" method="get">
	<table id="status" class="display" cellspacing="0" width="100%">
		<tr><?= $status1->render(); ?></tr>
		<tr><?= $status2->render(); ?></tr>
		<tr><?= $submit->render(); ?></tr>
		<tr>
			<td colspan=2>
				<br>
				<pre>
					<?php var_dump($_GET); ?>
				</pre>
			</td>
		</tr>
	</table>
	</form>
</div>
</body>
</html>

