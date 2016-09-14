<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/Demo.php';

/**
 * Example of a class which tests another class
 */
class SimpleClassTest extends TestCase
{
    protected $demo;
    public function setup()
    {
        $this->demo = new Demo();
    }
    public function teardown()
    {
        unset($this->demo);
    }
    public function testAdd()
    {
        $this->assertEquals(2, $this->demo->add(1,1));
    }
    public function testSub()
    {
        $this->assertEquals(0, $this->demo->sub(1,1));
    }
    public function testDiv()
    {
        $this->assertEquals(2, $this->demo->div(4, 2));
        $this->assertEquals(0, $this->demo->div(4, 0));
	}
	public function testTable()
	{
		$a = [range('A', 'C'),range('D', 'F'),range('G','I')];
		$table = $this->demo->table($a);
		$this->assertRegExp('!^<table>.+</table>$!', $table);
		$this->assertRegExp('!<td>B</td>!', $table);
	}
}
