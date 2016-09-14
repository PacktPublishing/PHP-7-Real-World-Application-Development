<?php
/**
 * Created by PhpStorm.
 * User: altafhussain
 * Date: 1/19/16
 * Time: 3:14 PM
 */

namespace publishers\packt;

class Presentation
{
    public function get() : string
    {
        return get_class();
    }
}