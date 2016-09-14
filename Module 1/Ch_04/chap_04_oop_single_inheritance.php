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

$member = new Member();
$member->setId(100);
$member->setName('Fred');
$member->setMembership('A299F322');
var_dump($member);
