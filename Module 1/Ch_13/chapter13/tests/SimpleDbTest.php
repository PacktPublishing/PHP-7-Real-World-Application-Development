<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../VisitorOps.php';

/**
 * Example of a class which tests another class
 */
class SimpleDatabaseTest extends TestCase
{
    protected $visitorOps;
    protected $dbConfig = [
		'driver'   => 'mysql',
		'host'     => 'localhost',
		'dbname'   => 'php7cookbook_test',
		'user'     => 'cook',
		'password' => 'book',
		'errmode'  => PDO::ERRMODE_EXCEPTION,
	];
	protected $testData = [
		'id' => 1,
		'email' => 'test@unlikelysource.com',
		'visit_date' => '2000-01-01 00:00:00',
		'comments' => 'TEST',
		'name' => 'TEST'
	];
    public function setup()
    {
        $this->visitorOps = new VisitorOps($this->dbConfig);
        // add test data
        $result = $this->visitorOps->addVisitor($this->testData);
		$this->assertRegExp('/INSERT/', $this->visitorOps->getSql());
		$this->assertEquals(1, $result);
    }
    public function teardown()
    {
		// remove test data
		$result = $this->visitorOps->removeById(1);
		$result = $this->visitorOps->findById(1);
		$this->assertEquals(FALSE, $result);
        unset($this->visitorOps);
    }
	public function testFindAll()
	{
		$result = $this->visitorOps->findAll();
		$this->assertInstanceOf(Generator::class, $result);
		$top = $result->current();
		$this->assertCount(5, $top);
		$this->assertArrayHasKey('name', $top);
		$this->assertEquals($this->testData['name'], $top['name']);

	}
    public function testFindById()
    {
		$result = $this->visitorOps->findById(1);
		$this->assertCount(5, $result);
		$this->assertArrayHasKey('name', $result);
		$this->assertEquals($this->testData['name'], $result['name']);
	}
}
