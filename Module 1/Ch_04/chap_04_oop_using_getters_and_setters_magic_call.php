<?php
/**
 * This is a demonstration class which demonstrates magic getters and setters via __call()
 * 
 */
class LotsProps
{
    protected $firstName  = NULL;
    protected $lastName   = NULL;
    protected $addr1      = NULL;
    protected $addr2      = NULL;
    protected $city       = NULL;
    protected $state      = NULL;
    protected $province   = NULL;
    protected $postalCode = NULL;
    protected $country    = NULL;
    protected $values     = array();
    
    /**
     * Intercepts calls to non-existent getters / setters
     * Looks at the beginning of $method to see if it's "get" or "set"
     * Uses preg_match() to extract the 2nd part of the match, which should produce the property name
     * 
     * @param string $method
     * @param mixed $params
     * @return mixed if $prefix == filter, returns transformed value; otherwise returns (bool)
     */
    public function __call($method, $params)
    {
        preg_match('/^(get|set)(.*?)$/i', $method, $matches);
        $prefix = $matches[1] ?? '';
        $key    = $matches[2] ?? '';
        $key    = strtolower($key);
        if ($prefix == 'get') {
            return $this->values[$key] ?? '---';
        } else {
            $this->values[$key] = $params[0];
        }
    }
}

// set some values
$a = new LotsProps();
$a->setFirstName('Li\'l Abner');
$a->setLastName('Yokum');
$a->setAddr1('1 Dirt Street');
$a->setCity('Dogpatch');
$a->setState('Kentucky');
$a->setPostalCode('12345');
$a->setCountry('USA');
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <style>
        .left {
            float: left;
            font-weight: bold;
            width: 200px;
        }
        .blue1   { background-color: #6BCDEC; }
        .blue2   { background-color: #ADD8E6  }
        .yellow1 { background-color: #FFFF00; }
        .yellow2 { background-color: #F8F88A; }
        .right {
            float: left;
            width: 400px;
        }
        .container {
            float: left;
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container">
<div class="left blue1">Name</div>
<div class="right yellow1"><?= $a->getFirstName() . ' ' . $a->getLastName() ?></div>   
</div>
<div class="left blue2">Address</div>
<div class="right yellow2">
    <?= $a->getAddr1() ?>
    <br><?= $a->getAddr2() ?>
    <br><?= $a->getCity() ?>
    <br><?= $a->getState() ?>
    <br><?= $a->getProvince() ?>
    <br><?= $a->getPostalCode() ?>
    <br><?= $a->getCountry() ?>
</div>   
</div>
</body>
</html>

