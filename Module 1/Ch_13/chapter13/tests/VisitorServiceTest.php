<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../VisitorService.php';
require_once __DIR__ . '/../VisitorOpsMock.php';

/**
 * Example of a class which tests another class
 */
class VisitorServiceTest extends TestCase
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
    public function setup()
    {
        $this->visitorService = new VisitorService($this->dbConfig);
        // assign VisitorOps mock
        $this->visitorService->setVisitorOps(new VisitorOpsMock());
    }
    public function teardown()
    {
        unset($this->visitorService);
    }
    public function testShowAllVisitors()
    {
		$result = $this->visitorService->showAllVisitors();
		$this->assertRegExp('!^<table>.+</table>$!', $result);
		$testData = $this->visitorService->getVisitorOps()->getTestData();
		foreach ($testData as $key => $value) {
			$dataWeWant = '!<td>' . $key . '</td>!';
			$this->assertRegExp($dataWeWant, $result);
		}
	}
}
