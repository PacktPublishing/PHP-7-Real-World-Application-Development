<?php
/**
 * Created by PhpStorm.
 * User: altafhussain
 * Date: 1/17/16
 * Time: 2:51 PM
 */

declare(strict_types = 1);

class Person
{

    public function age(float $age) : float
    {
        return $age;
	}

    public function name(string $name) : string
    {
        return $name;
    }

    public function isAlive(bool $alive) : string
    {
        return ($alive) ? 'Yes' : 'No';
    }
}


$person = new Person();

echo $person->name('Altaf Hussain');
echo $person->age(30.5);
echo $person->isAlive(TRUE);