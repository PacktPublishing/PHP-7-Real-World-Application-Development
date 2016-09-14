<?php

require __DIR__ . '/../Application/Database/Connection.php';

use Application\Database\Connection;
class VisitorOps
{

	const TABLE_NAME = 'visitors';
    protected $connection;
	protected $sql;

    public function __construct(array $config)
    {
        $this->connection = new Connection($config);
    }

	public function getSql()
	{
		return $this->sql;
	}

    public function findAll()
    {
		$sql = 'SELECT * FROM ' . self::TABLE_NAME;
        $stmt = $this->runSql($sql);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			yield $row;
		}
    }

    public function findById($id)
    {
		$sql = 'SELECT * FROM ' . self::TABLE_NAME;
		$sql .= ' WHERE id = ?';
        $stmt = $this->runSql($sql, [$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function removeById($id)
    {
		$sql = 'DELETE FROM ' . self::TABLE_NAME;
		$sql .= ' WHERE id = ?';
        return $this->runSql($sql, [$id]);
    }

	public function addVisitor($data)
	{
		$sql = 'INSERT INTO ' . self::TABLE_NAME;
		$sql .= ' (' . implode(',',array_keys($data)) . ') ';
		$sql .= ' VALUES ';
		$sql .= ' ( :' . implode(',:',array_keys($data)) . ') ';
		$this->runSql($sql, $data);
		return $this->connection->pdo->lastInsertId();
	}

	public function runSql($sql, $params = NULL)
    {
		$this->sql = $sql;
        try {
            $stmt = $this->connection->pdo->prepare($sql);
            $result = $stmt->execute($params);
        } catch (Throwable $e) {
            error_log(__METHOD__ . ':' . $e->getMessage());
            return FALSE;
        }
        return $stmt;
    }
}
