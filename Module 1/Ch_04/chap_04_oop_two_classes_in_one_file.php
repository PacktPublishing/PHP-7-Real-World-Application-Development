<?php
// demonstrates defining two classes in one file

require __DIR__ . '/NameAddress.php';

$name = new Name();
$name->setName('TEST');
$addr = new Address();
$addr->setAddress('123 Main Street');

echo $name->getName() . ' lives at ' . $addr->getAddress();
