<?php
// demonstrates the use of "extends" to define single inheritance

class Base
{
    protected $id;
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
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

class Member extends Customer
{
    protected $membership;
    public function getMembership()
    {
        return $this->membership;
    }
    public function setMembership($memberId)
    {
        $this->membership = $memberId;
    }
}

class Orphan
{
    protected $id;
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
}

function test(Base $object)
{
    return $object->getId();
}

$base   = new Base();
$base->setId(100);

$customer = new Customer();
$customer->setId(101);

$member = new Member();
$member->setId(102);

// all 3 classes work in test()
echo test($base)     . PHP_EOL;
echo test($customer) . PHP_EOL;
echo test($member)   . PHP_EOL;

// instance of Orphan doesn't work: not in the line of inheritance
echo PHP_EOL;
try {
    $orphan = new Orphan();
    $orphan->setId(103);
    echo test($orphan) . PHP_EOL;
} catch (TypeError $e) {
    echo 'Does not work!' . PHP_EOL;
    echo $e->getMessage();
}

    
