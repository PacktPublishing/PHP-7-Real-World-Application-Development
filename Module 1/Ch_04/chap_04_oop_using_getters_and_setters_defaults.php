<?php
/**
 * This is a demonstration class which demonstrates getters and setters
 * 
 */
class GetSet
{
    protected $intVal = NULL;
    protected $arrVal = NULL;
    // note the use of the null coalesce operator to return a default value
    public function getIntVal() : int
    {
        return $this->intVal ?? 0;
    }
    public function getArrVal() : array
    {
        return $this->arrVal ?? array();
    }
    public function setIntVal($val)
    {
        $this->intVal = (int) $val ?? 0; 
    }
    public function setArrVal(array $val)
    {
        $this->arrVal = $val ?? array();
    }
}

// create the instance
$a = new GetSet();

// set a "proper" value
$a->setIntVal(1234);
echo $a->getIntVal();
echo PHP_EOL;

// set a bogus value
$a->setIntVal('some bogus value');
echo $a->getIntVal();
echo PHP_EOL;

// NOTE: boolean TRUE == 1
$a->setIntVal(TRUE);
echo $a->getIntVal();
echo PHP_EOL;

// returns array() even though no value was set
var_dump($a->getArrVal());
echo PHP_EOL;

// sets a "proper" value
$a->setArrVal(['A','B','C']);
var_dump($a->getArrVal());
echo PHP_EOL;

try {
    $a->setArrVal('this is not an array');
    var_dump($a->getArrVal());
    echo PHP_EOL;
} catch (TypeError $e) {
    echo $e->getMessage();
}

echo PHP_EOL;
