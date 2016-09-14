<?php
// uses Application\Form\Element\CheckBox

// prospects table:
/*
	COLUMN          TYPE          NULL  DEFAULT
  	first_name 		varchar(128) 	No 	None 	NULL 	
	last_name 		varchar(128) 	No 	None 	NULL 	
	address 		varchar(256) 	Yes None 	NULL 	
	city 	        varchar(64) 	Yes None 	NULL 	
	state_province 	varchar(32) 	Yes None 	NULL 	
	postal_code 	char(16) 		No 	None 	NULL 	
	phone 			varchar(16) 	No 	None 	NULL 	
	country 		char(2) 		No 	None 	NULL 	
	email 			varchar(250) 	No 	None 	NULL 	
	status 			char(8) 		Yes None 	NULL 	
	budget 			decimal(10,2) 	Yes None 	NULL 	
	last_updated 	datetime 		Yes None 	NULL
*/
// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// anchor Generic element class
use Application\Form\Generic;
use Application\Form\Element\CheckBox;

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


// define checkbox form element
$status = new CheckBox('status', 
					Generic::TYPE_CHECKBOX, 
					'Status',
					$wrappers,
					['id' => 'status']);

// get status from $_GET if any
$checked = $_GET['status'] ?? ['U'];

// set options
$status->setOptions($statusList, $checked, '<br>', TRUE);	
				
// submit button
$submit = new Generic('submit', 
					Generic::TYPE_SUBMIT,
					'Process',
					$wrappers,
					['id' => 'submit','title' => 'Click to process status','value' => 'Click Here']);
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
	<tr><?= $status->render(); ?></tr>
	<tr><?= $submit->render(); ?></tr>
	<tr>
		<td colspan=2>
			<br>
			<pre><?php var_dump($_GET); ?></pre>
		</td>
	</tr>
</table>
</form>
</div>
</body>
</html>

