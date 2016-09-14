<?php
// configures messages for chap_06_post_data_filtering.php

use Application\Filter\Messages;

// set messages
Messages::setMessages(
	[
		'length_too_short' => 'Length must be at least %d',
		'length_too_long'  => 'Length must be no more than %d',
		'required'         => 'Please be sure to enter a value',
		'alnum'            => 'Item must contain only letters and numbers',
		'float'            => 'Item must contain only numbers or decimal point',
		'email'            => 'Invalid email address',
		'in_array'		   => 'Item was not found in the list of valid values',
		'trim'             => 'Item was trimmed',
		'strip_tags'       => 'Tags were removed from this item',
		'filter_float'     => 'Item was converted to a decimal number',
		'phone'            => 'Phone number must be in a format [+n] nnn-nnn-nnnn',
		'test'             => 'TEST',
		'filter_length'    => 'Item was reduced to specified length',
	]
);
