<?php
/**
 * Created by PhpStorm.
 * User: altafhussain
 * Date: 1/26/16
 * Time: 10:49 AM
 */

$a = 10;
$b = 0;

switch(true)
{
    default:
        $b += 1;
        break;

    default:
        $b += 2;
}

echo "b is ".$b;