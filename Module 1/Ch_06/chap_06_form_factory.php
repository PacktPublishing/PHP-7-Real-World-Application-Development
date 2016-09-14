<?php
// uses Application\Form\Factory

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// anchor Generic and Factory classes
use Application\Form\Generic;
use Application\Form\Factory;

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

// get status from $_POST if any
$email    = $_POST['email']   ?? '';
$checked0 = $_POST['status0'] ?? 'U';
$checked1 = $_POST['status1'] ?? 'U';
$checked2 = $_POST['status2'] ?? ['U'];
$checked3 = $_POST['status3'] ?? ['U'];

// overall form config
$formConfig = [ 
	'name'		   => 'status_form',
	'attributes'   => ['id'=>'statusForm','method'=>'post','action'=>'chap_06_form_factory.php'],
	'row_wrapper'  => ['type' => 'tr', 'class' => 'row'],
	'form_wrapper' => ['type'=>'table','class'=>'table','id'=>'statusTable',
					   'class'=>'display','cellspacing'=>'0'],
	'form_tag_inside_wrapper' => FALSE,
];

// define elements
$config = [
	'email' => [	
		'class'     => 'Application\Form\Generic',
		'type' 		=> Generic::TYPE_EMAIL, 
		'label' 	=> 'Email', 
		'wrappers' 	=> $wrappers,
		'attributes'=> ['id'=>'email','maxLength'=>128,'title'=>'Enter address',
					    'required'=>'','value'=>strip_tags($email)]
	],
	'password' => [
		'class' 	=> 'Application\Form\Generic',
		'type' 		=> Generic::TYPE_PASSWORD,
		'label' 	=> 'Password',
		'wrappers' 	=> $wrappers,
		'attributes'=> ['id'=>'password','title' => 'Enter your password','required' => '']
	],
	'status0' => [
		'class'		=> 'Application\Form\Element\Radio',
		'type' 		=> Generic::TYPE_RADIO, 
		'label'		=> 'Status 0',
		'wrappers'	=> $wrappers,
		'attributes'=> ['id'=>'status0','value'=>$checked0],
		'options'   => [$statusList, $checked0, '<br>', TRUE],	
	],
	'status1' => [
		'class'		=> 'Application\Form\Element\Select',
		'type' 		=> Generic::TYPE_SELECT, 
		'label'		=> 'Status 1',
		'wrappers'	=> $wrappers,
		'attributes'=> ['id' =>'status1','value'=>$checked1],
		'options'   => [$statusList, $checked1],
	],
	'status2' => [
		'class'		=> 'Application\Form\Element\Select',
		'type' 		=> Generic::TYPE_SELECT, 
		'label'		=> 'Status 2',
		'wrappers'	=> $wrappers,
		'attributes'=> ['id'=>'status2','multiple'=>'','size'=>'4','value'=>$checked2],
		'options'   => [$statusList, $checked2],
	],
	'status3' => [
		'class'		=> 'Application\Form\Element\CheckBox',
		'type' 		=> Generic::TYPE_CHECKBOX, 
		'label'		=> 'Status 3',
		'wrappers'	=> $wrappers,
		'attributes'=> ['id'=>'status3','value'=>$checked3],
		'options'   => [$statusList, $checked3, '<br>', FALSE],	
	],		
	'submit' => [
		'class'		=> 'Application\Form\Generic',
		'type' 		=> Generic::TYPE_SUBMIT,
		'label'		=> 'Process',
		'wrappers'	=> $wrappers,
		'attributes'=> ['id'=>'submit','title'=>'Click to Process','value'=>'Click Here'],
	]
];

$form = Factory::generate($config);
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
	<pre><?= var_dump($_POST); ?></pre>
</div>
</body>
</html>

