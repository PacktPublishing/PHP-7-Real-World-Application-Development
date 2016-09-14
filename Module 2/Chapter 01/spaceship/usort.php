<?php
/**
 * Created by PhpStorm.
 * User: altafhussain
 * Date: 1/15/16
 * Time: 4:36 PM
 */

function normal_sort($a, $b) : int
{
    if($a == $b)
        return 0;
    if($a < $b)
        return -1;
    return 1;
}

function space_sort($a, $b) : int
{
    return $a <=> $b;
}

$normalArray = [1,34,56,67,98,45];

usort($array, 'normal_sort');

foreach($array as $k => $v)
{
    echo $k.' => '.$v.'<br>';
}

//SpaceShip example
$normalArray = [1,34,56,67,98,45];

usort($sarray, 'space_sort');
foreach($sarray as $key => $value)
{
    echo $key.' => '.$value.'<br>';
}