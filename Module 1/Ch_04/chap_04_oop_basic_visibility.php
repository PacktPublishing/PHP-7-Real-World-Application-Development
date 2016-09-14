<?php
// demonstrates basic visibility

ini_set('display_errors', 0);

class Base
{
    protected $id;
    private $key = 12345;
    public function getId()
    {
        return $this->id;
    }
    public function setId()
    {
        $this->id = $this->generateRandId();
    }
    protected function generateRandId()
    {
        // NOTE: makes use of the new PHP 7 function random_bytes()
        return unpack('H*', random_bytes(8))[1];
    }
}

class Customer extends Base
{
    protected $name;
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
}

$base     = new Base();
$customer = new Customer();

// these method calls work OK:
// access protected properties $id and $name through public get and set methods
$customer->setId();
$customer->setName('Test');
echo 'Welcome ' . $customer->getName() . PHP_EOL;
echo 'Your new ID number is: ' . $customer->getId() . PHP_EOL;

// the next few lines will not work

// can't access a private property outside of the class
echo PHP_EOL;
echo 'Key (does not work): ' . $base->key;

// private properties are not inherited: this will be undefined
echo PHP_EOL;
echo 'Key (does not work): ' . $customer->key;

// can't access a protected property outside of the class
echo PHP_EOL;
echo 'Name (does not work): ' . $customer->name;

// can't access a protected method outside of the class
echo PHP_EOL;
echo 'Random ID (does not work): ' . $customer->generateRandId();
