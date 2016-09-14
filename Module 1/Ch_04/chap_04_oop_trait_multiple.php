<?php
// multiple traits -- resolving naming conflicts
// see: http://php.net/manual/en/language.oop5.traits.php

trait IdTrait
{
    protected $id;
    public $key;
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setKey()
    {
        $this->key = date('YmdHis') . sprintf('%04d', rand(0,9999));
    }
}

trait NameTrait
{
    protected $name;
    public $key;
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setKey()
    {
        $this->key = unpack('H*', random_bytes(18))[1];
    }
}

// uses setKey() from NameTrait
class Test
{
    use IdTrait, NameTrait {
        NameTrait::setKey insteadof IdTrait;
        IdTrait::setKey as setKeyDate;
    }
}

$a = new Test();
$a->setId(100);
$a->setName('Fred');
$a->setKey();
var_dump($a);

$a->setKeyDate();
var_dump($a);
