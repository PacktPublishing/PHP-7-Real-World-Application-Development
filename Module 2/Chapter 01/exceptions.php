<?php
/**
 * Created by PhpStorm.
 * User: altafhussain
 * Date: 1/26/16
 * Time: 7:11 AM
 */


function iHaveError($object)
{
    return $object->iDontExist();
}

try {
    iHaveError(null);
} catch(Error $e) {
    echo $e->getMessage();
}

echo "I am still running";