<?php 

$redisObject = new Redis();
if( !$redisObject->connect(‘127.0.0.1’, 6379) )
	die(“Can’t connect to Redis Server”);

/* This $array can come from anywhere, either it is coming from database or user entered form data or an array defined in code */

$array = [‘PHP 5.4’, PHP 5.5, ‘PHP 5.6’, PHP 7.0];

//Json encode the array
$encoded = json_encode($array);

//Select redis database 1
$redisObj->select(1);

//store it in redis database 1
$redisObject->set(‘my_array’, $encoded);

//Now lets fetch it
$data = $redisObject->get(‘my_array’);

//Decode it to array
$decoded = json_decode($data, true);

print_r($decoded);