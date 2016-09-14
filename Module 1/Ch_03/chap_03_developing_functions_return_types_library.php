<?php
// developing functions library -- return type
// for more information see: 
// http://php.net/manual/en/functions.arguments.php#functions.arguments.type-declaration.strict
// https://wiki.php.net/rfc/return_types
// NOTE: no need to declare strict_types!

// shows basic syntax for return type
function returnsString(DateTime $date, $format) : string
{
    return $date->format($format);
}

// converts value to return type of string
function convertsToString($a, $b, $c) : string
{
    return $a + $b + $c;
}

// returns DateTime
// NOTE: this would be a great place for scalar type hints
//       if $year, $month or $day are not type int, a warning is generated
function makesDateTime($year, $month, $day) : DateTime
{
    $date = new DateTime();
    $date->setDate($year, $month, $day);
    return $date;
}

// this will throw a TypeError at runtime
function wrongDateTime($year, $month, $day) : DateTime
{
    return date($year . '-' . $month . '-' . $day);
}
