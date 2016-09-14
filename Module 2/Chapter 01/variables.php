<?php
/**
 * Created by PhpStorm.
 * User: altafhussain
 * Date: 1/17/16
 * Time: 12:02 PM
 */

class Packt
{
    public $title = 'PHP 7';
    public $publisher = 'Packt Publishers';

    public function geTitle() : string
    {
        return $this->title;
    }

    public function getPublisher() : string
    {
        return $this->publisher;
    }
}

$methods = ['title' => 'geTitle', 'publisher' => 'getPublisher'];
$object = new Packt();

echo 'Book '.$object->$methods['title']().' is published by '.$object->{$methods['publisher']}();