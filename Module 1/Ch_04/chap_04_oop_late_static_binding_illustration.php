<?php
// demonstrates late static binding issue

class Test2
{
    public static $test = 'TEST2';
    public static function getEarlyTest()
    {
        return self::$test;
    }
    public static function getLateTest()
    {
        return static::$test;
    }
}

class Child extends Test2
{
    public static $test = 'CHILD';
}

// ouputs 'TEST2'
echo Test2::$test;
echo PHP_EOL;

// outputs 'CHILD'
echo Child::$test;
echo PHP_EOL;

// ouputs 'TEST2'
echo Child::getEarlyTest();
echo PHP_EOL;

// outputs 'CHILD'
echo Child::getLateTest();
echo PHP_EOL;
