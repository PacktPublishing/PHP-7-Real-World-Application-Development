<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/VisitorService.php';
require_once __DIR__ . '/VisitorOps.php';

/**
 * Example of a class which tests another class
 * using a PHP 7 anonymous class as a mock object
 */
class VisitorServiceTestAnonClass extends TestCase
{
    protected $visitorService;
    protected $dbConfig = [
		'driver'   => 'mysql',
		'host'     => 'localhost',
		'dbname'   => 'php7cookbook_test',
		'user'     => 'cook',
		'password' => 'book',
		'errmode'  => PDO::ERRMODE_EXCEPTION,
	];
	protected $testData;

    public function setup()
    {
		$data = array();
		for ($x = 1; $x <= 3; $x++) {
			$data[$x]['id'] = $x;
			$data[$x]['email'] = $x . 'test@unlikelysource.com';
			$data[$x]['visit_date'] = '2000-0' . $x . '-0' . $x . ' 00:00:00';
			$data[$x]['comments'] = 'TEST ' . $x;
			$data[$x]['name'] = 'TEST ' . $x;
		}
		$this->testData = $data;
        $this->visitorService = new VisitorService($this->dbConfig);
        // assign VisitorOps mock
        $opsMock = new class ($this->testData) extends VisitorOps {
			protected $testData;
			public function __construct($testData)
			{
				$this->testData = $testData;
			}
			public function findAll()
			{
				return $this->testData;
			}
		};
        $this->visitorService->setVisitorOps($opsMock);
    }
    public function teardown()
    {
        unset($this->visitorService);
    }
    public function testShowAllVisitors()
    {
		$result = $this->visitorService->showAllVisitors();
		$this->assertRegExp('!^<table>.+</table>$!', $result);
		foreach ($this->testData as $key => $value) {
			$dataWeWant = '!<td>' . $key . '</td>!';
			$this->assertRegExp($dataWeWant, $result);
		}
	}
}
