<?php
// trait methods do not override class methods

trait Test
{
    public $id;
    public function setId($id)
    {
        $obj = new stdClass();
        $obj->id = $id;
        $this->id = $obj;
    }
    public function getId()
    {
        return $this->id;
    }
}

class Customer
{
    use Test;
    protected $name;
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
}

$customer = new Customer();
$customer->setId(100);
$customer->setName('Fred');
var_dump($customer);
