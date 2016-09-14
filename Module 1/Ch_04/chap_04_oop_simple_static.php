<?php
// demonstrates simple static usage

class Test
{
    public static $test = 'TEST';
    public static function getTest()
    {
        return self::$test;
    }
}

echo Test::$test;
echo PHP_EOL;

echo Test::getTest();
echo PHP_EOL;
