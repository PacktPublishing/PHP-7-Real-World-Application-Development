<?php
// demonstrates the use of "abstract" to force developers to define specified methods

abstract class Base
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
    abstract public function validate();
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
    // NOTE: if this is not defined, an error is generated
    public function validate()
    {
        $valid = 0;
        $count = count(get_object_vars($this));
        if (!empty($this->id) && is_int($this->id)) $valid++;
        if (!empty($this->name) && preg_match('/[a-z0-9 ]/i', $this->name)) $valid++;
        return ($valid == $count);
    }
}

$customer = new Customer();

$customer->setId(100);
$customer->setName('Fred');
echo "Customer [id]: {$customer->getName()} [{$customer->getId()}]\n";
echo ($customer->validate()) ? 'VALID' : 'NOT VALID';
echo PHP_EOL;

$customer->setId('XXX');
$customer->setName('$%£&*()');
echo "Customer [id]: {$customer->getName()} [{$customer->getId()}]\n";
echo ($customer->validate()) ? 'VALID' : 'NOT VALID';
echo PHP_EOL;
