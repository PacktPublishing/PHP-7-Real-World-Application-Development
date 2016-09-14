<?php
// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\Entity\ { Person, PublicPerson, ProtectedPerson };
use Application\Generic\Hydrator\Any;
use Application\Generic\Hydrator\Strategy\ { GetSet, Extending, PublicProps };

$obj = new Person();
$obj->setFirstName('Li\'lAbner');
$obj->setLastName('Yokum');
$obj->setAddress('1 Dirt Street');
$obj->setCity('Dogpatch');
$obj->setStateProv('Kentucky');
$obj->setPostalCode('12345');
$obj->setCountry('USA');

$hydrator = new Any();
$b = $hydrator->extract($obj);
echo "\nChosen Strategy: " . $hydrator->chosen . "\n";
var_dump($b);

$a = [
	'firstName'	=> 'Li\'lAbner',
	'lastName' 	=> 'Yokum',
	'address' 	=> '1 Dirt Street',
	'city' 		=> 'Dogpatch',
	'stateProv' => 'Kentucky',
	'postalCode'=> '12345',
	'country' 	=> 'USA'
];

$p = $hydrator->hydrate($a, new PublicPerson());
echo "\nChosen Strategy: " . $hydrator->chosen . "\n";
var_dump($p);

$q = $hydrator->hydrate($a, new ProtectedPerson());
echo "\nChosen Strategy: " . $hydrator->chosen . "\n";
echo "Name: {$q->getFirstName()} {$q->getLastName()}\n";
echo "Name: {$q->firstName} {$q->lastName}\n";
var_dump($q);


