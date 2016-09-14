<?php
// primitive autoloader
function __autoload($class)
{
    echo "Argument Passed to Autoloader = $class\n";
    include __DIR__ . '/../' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
}

$name = new Application\Entity\Name();
$addr = new Application\Entity\Address();
$prof = new Application\Entity\Profile();

