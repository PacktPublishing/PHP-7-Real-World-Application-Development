<?php
/**
 * Created by PhpStorm.
 * User: altafhussain
 * Date: 1/25/16
 * Time: 11:25 AM
 */

//Basic example

$name = new class('Altaf Hussain') {

    public function __construct(string $name)
    {
        echo $name;
    }
};

//Argument to constructor

class Packt
{
    protected $number;

    protected $name;

    protected $address;

    public function __construct()
    {
        echo "I am parent class constructor";
    }

    public function getNumber() : float
    {
        return $this->num;
    }
}

//Extending another class

$number = new class(5) extends Packt
{
    public function __construct(float $num)
    {
        parent::__construct();
       $this->num = $num;
    }
};

echo $number->getNumber();


//Implementing an interface
interface Publishers
{
    public function __construct(string $name, string $address);
    public function getName() : string;
    public function getAddress() : string;
}

$info = new class('Altaf Hussain', 'PAK') extends Packt implements Publishers
{
    public function __construct(string $name, string $address)
    {
        $this->name = $name;
        $this->address = $address;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getAddress() : string
    {
        return $this->address;
    }
};

echo $info->getName().' '.$info->getAddress();

//sub class in another class

class Math
{
    public $first_number = 10;

    public $second_number = 20;


    public function add() : float
    {
        return $this->first_number + $this->second_number;
    }

    public function multiply_sum()
    {
        return new class() extends Math
        {

            public function multiply($third_number) : float
            {
                return $this->add() * $third_number;
            }
        };
    }
}

$math = new Math();

echo $math->multiply_sum()->multiply(2);
