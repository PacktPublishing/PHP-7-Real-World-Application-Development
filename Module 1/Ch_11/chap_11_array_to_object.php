<?php
// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\Entity\Person;
use Application\Generic\Hydrator\GetSet;

$a['firstName'] = 'Li\'l Abner';
$a['lastName'] 	= 'Yokum';
$a['address'] 	= '1 Dirt Street';
$a['city'] 		= 'Dogpatch';
$a['stateProv']	= 'Kentucky';
$a['postalCode']= '12345';
$a['country'] 	= 'USA';

$b = GetSet::hydrate($a, new Person());
var_dump($b);
