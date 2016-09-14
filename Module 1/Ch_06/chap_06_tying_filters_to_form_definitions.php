<?php
// anchor Generic element class
use Application\Form\Generic;

define('VALIDATE_SUCCESS', 'SUCCESS: form submitted ok!');
define('VALIDATE_FAILURE', 'ERROR: validation errors detected');

// define "wrappers"
$wrappers = [
	Generic::INPUT => ['type' => 'td', 'class' => 'content'],
	Generic::LABEL => ['type' => 'th', 'class' => 'label'],
	Generic::ERRORS => ['type' => 'td', 'class' => 'error']
];

// define elements
$elements = [
	'first_name' => [	
		'class'     => 'Application\Form\Generic',
		'type' 		=> Generic::TYPE_TEXT, 
		'label' 	=> 'First Name', 
		'wrappers' 	=> $wrappers,
		'attributes'=> ['maxLength'=>128,'required'=>'']
	],
	'last_name' => [	
		'class'     => 'Application\Form\Generic',
		'type' 		=> Generic::TYPE_TEXT, 
		'label' 	=> 'Last Name', 
		'wrappers' 	=> $wrappers,
		'attributes'=> ['maxLength'=>128,'required'=>'']
	],
	'address' => [	
		'class'     => 'Application\Form\Generic',
		'type' 		=> Generic::TYPE_TEXT, 
		'label' 	=> 'Address', 
		'wrappers' 	=> $wrappers,
		'attributes'=> ['maxLength'=>255]
	],
	'city' => [	
		'class'     => 'Application\Form\Generic',
		'type' 		=> Generic::TYPE_TEXT, 
		'label' 	=> 'City', 
		'wrappers' 	=> $wrappers,
		'attributes'=> ['maxLength'=>128]
	],
	'state_province' => [	
		'class'     => 'Application\Form\Generic',
		'type' 		=> Generic::TYPE_TEXT, 
		'label' 	=> 'State/Province', 
		'wrappers' 	=> $wrappers,
		'attributes'=> ['maxLength'=>32]
	],
	'postal_code' => [	
		'class'     => 'Application\Form\Generic',
		'type' 		=> Generic::TYPE_TEXT, 
		'label' 	=> 'Postal Code', 
		'wrappers' 	=> $wrappers,
		'attributes'=> ['maxLength'=>16,'required'=>'']
	],
	'phone' => [	
		'class'     => 'Application\Form\Generic',
		'type' 		=> Generic::TYPE_TEXT, 
		'label' 	=> 'Phone', 
		'wrappers' 	=> $wrappers,
		'attributes'=> ['maxLength'=>16,'required'=>'']
	],
	'country' => [
		'class'		=> 'Application\Form\Element\Select',
		'type' 		=> Generic::TYPE_SELECT, 
		'label'		=> 'Country',
		'wrappers'	=> $wrappers,
		'attributes'=> [],
		'options'   => [array_combine($countries,$countries)],
	],
	'email' => [	
		'class'     => 'Application\Form\Generic',
		'type' 		=> Generic::TYPE_EMAIL, 
		'label' 	=> 'Email', 
		'wrappers' 	=> $wrappers,
		'attributes'=> ['maxLength'=>128,'required'=>'']
	],
	'budget' => [	
		'class'     => 'Application\Form\Generic',
		'type' 		=> Generic::TYPE_TEXT, 
		'label' 	=> 'Budget', 
		'wrappers' 	=> $wrappers,
		'attributes'=> ['size' => 16, 'maxLength'=>16,'required'=>'']
	],
	'submit' => [
		'class'		=> 'Application\Form\Generic',
		'type' 		=> Generic::TYPE_SUBMIT,
		'label'		=> 'Process',
		'wrappers'	=> $wrappers,
		'attributes'=> ['title'=>'Click to Process','value'=>'Click Here'],
	]
];

// overall form config
$formConfig = [ 
	'name'		   => 'prospectsForm',
	'attributes'   => ['method'=>'post','action'=>'chap_06_tying_filters_to_form.php'],
	'row_wrapper'  => ['type' => 'tr', 'class' => 'row'],
	'form_wrapper' => ['type'=>'table','class'=>'table','id'=>'prospectsTable',
					   'class'=>'display','cellspacing'=>'0'],
	'form_tag_inside_wrapper' => FALSE,
];

$assignments = [
	'validators' => [
		'first_name' 	=> [ ['key' => 'length',  'params' => ['min' => 1, 'max' => 128]], 
							 ['key' => 'alnum',   'params' => ['allowWhiteSpace' => TRUE]],
							 ['key' => 'required','params' => []] ],
		'last_name' 	=> [ ['key' => 'length',  'params' => ['min' => 1, 'max' => 128]],
							 ['key' => 'alnum',   'params' => ['allowWhiteSpace' => TRUE]],
							 ['key' => 'required','params' => []] ],
		'address' 		=> [ ['key' => 'length',  'params' => ['max' => 256]] ],
		'city' 			=> [ ['key' => 'length',  'params' => ['min' => 1, 'max' => 64]] ], 
		'state_province'=> [ ['key' => 'length',  'params' => ['min' => 1, 'max' => 32]] ], 
		'postal_code' 	=> [ ['key' => 'length',  'params' => ['min' => 1, 'max' => 16] ], 
							 ['key' => 'alnum',   'params' => ['allowWhiteSpace' => TRUE]],
							 ['key' => 'required','params' => []] ],
		'phone' 		=> [ ['key' => 'phone',   'params' => []] ],
		'country' 		=> [ ['key' => 'in_array','params' => $countries ], 
							 ['key' => 'required','params' => []] ],
		'email' 		=> [ ['key' => 'email',   'params' => [] ],
							 ['key' => 'length',  'params' => ['max' => 250] ], 
							 ['key' => 'required','params' => [] ] ],
		'budget' 		=> [ ['key' => 'float',   'params' => []] ]
	],
	'filters' => [
		'*'				=> [ ['key' => 'trim', 'params' => []], 
							 ['key' => 'strip_tags', 'params' => []] ],
		'first_name'	=> [ ['key' => 'length', 'params' => ['length' => 128]] ],
		'last_name'		=> [ ['key' => 'length', 'params' => ['length' => 128]] ],
		'city'	        => [ ['key' => 'length', 'params' => ['length' => 64]] ],
		'budget' 		=> [ ['key' => 'filter_float', 'params' => []] ],
	]
];
