<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/chap_13_unit_test_simple.php';

/**
 * Example of a class which tests functions defined in
 * chap_13_unit_test_simple.php
 */
class SimpleTest extends TestCase
{
    public function testAdd()
    {
        $this->assertEquals(2, add(1,1));
        $this->assertNotEquals(3, add(1,1));
        $this->assertEquals(0, add());
    }
    public function testSub()
    {
        $this->assertEquals(0, sub(1,1));
	}
    public function testMult()
    {
        $this->assertEquals(4, mult(2,2));
	}
	public function testDiv()
	{
		$this->assertEquals(2, div(4, 2));
		$this->assertEquals(0, div(4, 0));
	}
	public function testTable()
	{
		$a = [range('A', 'C'),range('D', 'F'),range('G','I')];
		$table = table($a);
		$this->assertRegExp('!^<table>.+</table>$!', $table);
		$this->assertRegExp('!<td>B</td>!', $table);
	}
}
