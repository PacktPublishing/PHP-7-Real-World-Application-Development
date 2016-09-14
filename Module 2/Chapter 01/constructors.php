<?php
/**
 * Created by PhpStorm.
 * User: altafhussain
 * Date: 1/25/16
 * Time: 10:43 AM
 */
class Packt
{
    public function packt()
    {
        echo "I am just a normal class method";
    }

    public function __construct()
    {
        echo "I am default constructor";
    }
}

$packt = new Packt();
$packt->packt();
