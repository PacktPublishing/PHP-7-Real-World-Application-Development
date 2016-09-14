<?php
// developing functions library -- type hints
// for more information see: 
// http://php.net/manual/en/functions.arguments.php#functions.arguments.type-declaration.strict
// if you wish to declare scalar type hints, it is *mandatory* to include the following:
declare(strict_types=1);

// PHP 5 and 7 type hints
function someTypeHint(Array $a, DateTime $t, Callable $c)
{
    $message = '';
    $message .= 'Array Count: ' . count($a) . PHP_EOL;
    $message .= 'Date: ' . $t->format('Y-m-d') . PHP_EOL;
    $message .= 'Callable Return: ' . $c() . PHP_EOL;
    $message .= PHP_EOL . PHP_EOL;
    return $message;
}

// scalar type hints (only in PHP 7)
function someScalarHint(bool $b, int $i, float $f, string $s)
{
    return sprintf("\n%20s : %5s\n%20s : %5d\n%20s : %5.2f\n%20s : %20s\n\n",
                    'Boolean', ($b ? 'TRUE' : 'FALSE'),
                    'Integer', $i,
                    'Float',   $f,
                    'String',  $s);
}

// boolean type hint doesn't thrown an error if any scalar type is passed
// however, the original value is lost and the param is converted to boolean
function someBoolHint(bool $b)
{
    return $b;
}
