<?php
/**
 * Created by PhpStorm.
 * User: altafhussain
 * Date: 1/19/16
 * Time: 3:06 PM
 */
namespace publishers\packt;

class Book
{

    public function get() : string
    {
        return get_class();
    }
}