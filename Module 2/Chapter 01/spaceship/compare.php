<?php
/**
 * Created by PhpStorm.
 * User: altafhussain
 * Date: 1/15/16
 * Time: 1:42 PM
 */

$int1 = 1;
$int2 = 2;
$int3 = 1;

echo 'Comparing Integers<br>';
echo $int1 <=> $int3; //Returns 0
echo '<br>';
echo $int1 <=> $int2; //Returns -1
echo '<br>';
echo $int2 <=> $int3; //Returns 1

echo "<br>";

echo 'Comparing Strings<br>';
echo "PHP 7 by Packt" <=> "PHP 7 by Packt"; //0
echo "<br>";
echo "a" <=> "b"; // -1
echo "<br>";
echo "z" <=> "x"; //1

echo "<br>";

echo 'Comparing Arrays<br>';
echo [1,2,3] <=> [1,2,3]; // -1
echo "<br>";
echo [1,2,3] <=> [3,2,1]; // -1
echo "<br>";
echo [3,2,1] <=> [1,2,3]; // -1