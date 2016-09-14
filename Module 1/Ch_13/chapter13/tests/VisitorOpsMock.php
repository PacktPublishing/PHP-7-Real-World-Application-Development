<?php
require_once __DIR__ . '/../VisitorOps.php';
/**
 * Mock test class which simulates functionality of VisitorOps
 * but does not require database access
 */
class VisitorOpsMock extends VisitorOps
{

	const TABLE_NAME = 'visitors';
	protected $sql;
	protected $testData = [
		'id' => 1,
		'email' => 'test@unlikelysource.com',
		'visit_date' => '2000-01-01 00:00:00',
		'comments' => 'TEST',
		'name' => 'TEST'
	];

	public function __construct()
	{
		$data = array();
		for ($x = 1; $x <= 3; $x++) {
			$data[$x]['id'] = $x;
			$data[$x]['email'] = $x . $this->testData['email'];
			$data[$x]['visit_date'] = '2000-0' . $x . '-0' . $x . ' 00:00:00';
			$data[$x]['comments'] = 'TEST ' . $x;
			$data[$x]['name'] = 'TEST ' . $x;
		}
		$this->testData = $data;
	}

	public function getTestData()
	{
		return $this->testData;
	}

    public function findAll()
    {
		$sql = 'SELECT * FROM ' . self::TABLE_NAME;
		foreach ($this->testData as $row) {
			yield $row;
		}
    }

    public function findById($id)
    {
		$sql = 'SELECT * FROM ' . self::TABLE_NAME;
		$sql .= ' WHERE id = ?';
        return $this->testData[$id] ?? FALSE;
    }

    public function removeById($id)
    {
		$sql = 'DELETE FROM ' . self::TABLE_NAME;
		$sql .= ' WHERE id = ?';
		if (empty($this->testData[$id])) {
			return 0;
		} else {
			unset($this->testData[$id]);
			return 1;
		}
		return TRUE;
    }

	public function addVisitor($data)
	{
		$sql = 'INSERT INTO ' . self::TABLE_NAME;
		$sql .= ' (' . implode(',',array_keys($data)) . ') ';
		$sql .= ' VALUES ';
		$sql .= ' ( :' . implode(',:',array_keys($data)) . ') ';
		if (!empty($data['id'])) {
			$id = $data['id'];
		} else {
			$keys = array_keys($this->testData);
			sort($keys);
			$id = end($keys) + 1;
			$data['id'] = $id;
		}
		$this->testData[$id] = $data;
		return TRUE;
	}

}
