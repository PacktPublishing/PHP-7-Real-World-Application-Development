<?php
// trait methods override inherited methods

trait Test
{
    public function setId($id)
    {
        $obj = new stdClass();
        $obj->id = $id;
        $this->id = $obj;
    }
}

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
    use Test;
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

$customer = new Customer();
$customer->setId(100);
$customer->setName('Fred');
var_dump($customer);
