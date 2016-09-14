<?php

require_once __DIR__ . '/VisitorOps.php';
require_once __DIR__ . '/../Application/Database/Connection.php';

use Application\Database\Connection;
class VisitorService
{

	protected $visitorOps;
    public function __construct(array $config)
    {
        $this->visitorOps = new VisitorOps($config);
    }

	public function getVisitorOps()
	{
		return $this->visitorOps;
	}

	public function setVisitorOps(VisitorOps $visitorOps)
	{
		$this->visitorOps = $visitorOps;
	}

	public function showAllVisitors()
	{
		$table = '<table>';
		foreach ($this->visitorOps->findAll() as $row) {
			$table .= '<tr><td>';
			$table .= implode('</td><td>', $row);
			$table .= '</td></tr>';
		}
		$table .= '</table>';
		return $table;
	}
}
