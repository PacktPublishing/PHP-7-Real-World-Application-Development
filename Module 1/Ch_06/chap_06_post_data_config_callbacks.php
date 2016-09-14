<?php
// configures callbacks for chap_06_post_data_filtering.php

use Application\Filter\ { Result, Messages, CallbackInterface };

$countries = ['AE','AT','AU','BE','BG','BR','CA','CH','CN',
			  'DK','DE','FR','ES','HK','IE','IS','IT','JP',
			  'KR','MX','NG','NL','NO','NZ','PH','PL','RO',
			  'RU','SE','SG','TW','UA','US','UK','ZA'];
			  
$callbacks = [
	// validator callbacks
	'validators' => [
		// params: allowWhitespace = (bool)
		'alnum' => new class () implements CallbackInterface 
			{
				public function __invoke($item, $params) : Result
				{
					$error = array();
					$allow = $params['allowWhiteSpace'] ?? FALSE;
					if ($allow) {
						$item = str_replace(' ', '', $item);
					}
					$valid = ctype_alnum($item);
					if (!$valid) $error[] = Messages::$messages['alnum'];
					return new Result($valid, $error);
				}
			},
		'float' => new class () implements CallbackInterface 
			{
				public function __invoke($item, $params) : Result
				{
					$error = array();
					$valid = $item == (float) $item;
					if (!$valid) $error[] = Messages::$messages['float'];
					return new Result($valid, $error);
				}
			},
		'email' => new class () implements CallbackInterface  
			{
				public function __invoke($item, $params) : Result
				{
					$error = array();
					$valid = filter_var($item, FILTER_VALIDATE_EMAIL);
					if (!$valid) $error[] = Messages::$messages['email'];
					return new Result($valid, $error);
				}
			},
		'in_array' => new class () implements CallbackInterface 
			{
				public function __invoke($item, $params) : Result
				{
					$error = array();
					$valid = in_array($item, $params);
					if (!$valid) $error[] = Messages::$messages['in_array'];
					return new Result($valid, $error);
				}
			},
		// $params['min'] == minimum; $params['max'] == maximum
		'length' => new class () implements CallbackInterface 
			{
				public function __invoke($item, $params) : Result
				{
					$valid = 0;
					$count = 0;
					$error = array();
					if (isset($params['min'])) {
						$count++;
						if (strlen($item) >= $params['min']) { $valid++; }
						else { $error[] = sprintf(Messages::$messages['length_too_short'], $params['min']); }
					}
					if (isset($params['max'])) {
						$count++;
						if (strlen($item) <= $params['max']) { $valid++; }
						else { $error[] = sprintf(Messages::$messages['length_too_long'], $params['max']); }
					}
					return new Result(($valid == $count), $error);
				}
			},
		'phone' => new class () implements CallbackInterface 
			{
				public function __invoke($item, $params) : Result
				{
					$error = array();
					$valid = (bool) preg_match('/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/', $item);
					if (!$valid) $error[] = Messages::$messages['phone'];
					return new Result($valid, $error);
				}
			},
		'required' => new class () implements CallbackInterface 
			{
				public function __invoke($item, $params) : Result
				{
					$error = array();
					$valid = boolval($item);
					if (!$valid) $error[] = Messages::$messages['required'];
					return new Result($valid, $error);
				}
			}
	],
	// filter callbacks
	'filters' => [
		// params: none
		'test' => new class () implements CallbackInterface 
			{
				public function __invoke($item, $params) : Result
				{
					return new Result($filtered, Messages::$messages['test']);
				}
			},
		// params: none
		'trim' => new class () implements CallbackInterface 
			{
				public function __invoke($item, $params) : Result
				{
					$changed  = array();
					$filtered = trim($item);
					if ($filtered !== $item) $changed = Messages::$messages['trim'];
					return new Result($filtered, $changed);
				}
			},
		// params: none
		'strip_tags' => new class () implements CallbackInterface 
			{
				public function __invoke($item, $params) : Result
				{
					$changed  = array();
					$filtered = strip_tags($item);
					if ($filtered !== $item) $changed = Messages::$messages['strip_tags'];
					return new Result($filtered, $changed);
				}
			},
		// params: (int) length
		'length' => new class () implements CallbackInterface 
			{
				public function __invoke($item, $params) : Result
				{
					$changed  = array();
					$filtered = substr($item, 0, $params['length']);
					if ($filtered !== $item) $changed = Messages::$messages['filter_length'];
					return new Result($filtered, $changed);
				}
			},
		// params: none
		'filter_float' => new class () implements CallbackInterface 
			{
				public function __invoke($item, $params) : Result
				{
					$changed  = array();
					$filtered = (float) $item;
					if ($filtered !== $item) $changed = Messages::$messages['filter_float'];
					return new Result($filtered, $changed);
				}
			}
	]
];
