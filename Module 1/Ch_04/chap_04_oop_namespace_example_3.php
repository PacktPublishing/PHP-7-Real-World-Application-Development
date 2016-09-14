<?php
// primitive autoloader
function __autoload($class)
{
    echo "Argument Passed to Autoloader = $class\n";
    include __DIR__ . '/../' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
}

// illustrates using only the namespace, not the classname(s)
use Application\Entity\ {
    Name,
    Address,
    Profile
};

$name = new Name();
$addr = new Address();
$prof = new Profile();

var_dump($name);
var_dump($addr);
var_dump($prof);

