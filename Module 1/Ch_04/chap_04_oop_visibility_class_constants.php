<?php
// NOTE: only works in PHP 7.1 and above!

class Test
{
    public const TEST_WHOLE_WORLD  = 'visible.everywhere';
    protected const TEST_INHERITED = 'this.can.be.seen.in.child.classes';
    private const TEST_LOCAL       = 'local.to.class.Test.only';
    public static function getTestInherited()
    {
        return static::TEST_INHERITED;
    }
    public static function getTestLocal()
    {
        return static::TEST_LOCAL;
    }
}

class Child extends Test
{
    // some other code
}

echo Test::TEST_WHOLE_WORLD;    // returns 'visible.everywhere';
echo Test::getTestInherited();  // returns 'this.can.be.seen.in.child.classes';
echo Test::getTestLocal();      // returns 'local.to.class.Test.only'
echo Child::TEST_WHOLE_WORLD;   // returns 'visible.everywhere';
echo Child::getTestInherited(); // returns 'this.can.be.seen.in.child.classes';

// all of the following generate errors
echo Test::TEST_INHERITED;  // error: can't access protected property outside of class definition
echo Test::TEST_LOCAL;      // error: can't access private property outside of class definition
echo Child::TEST_INHERITED; // error: can't access protected property outside of class definition
echo Child::TEST_LOCAL;     // error: unknown constant
echo Child::getTestLocal(); // error: unknown constant
