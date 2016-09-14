<?php
// produces JSON data in response to AJAX request

define('DB_CONFIG_FILE', '/../config/db.config.php');
include __DIR__ . '/../Application/Database/Connection.php';

use Application\Database\Connection;
$conn = new Connection(include __DIR__ . DB_CONFIG_FILE);

$id  = $_GET['id'] ?? 0;
$sql = 'SELECT u.transaction,u.date,u.quantity,u.sale_price,r.title '
	 . 'FROM purchases AS u '
	 . 'JOIN products AS r '
	 . 'ON u.product_id = r.id '
	 . 'WHERE u.customer_id = :id';
$stmt = $conn->pdo->prepare($sql);
$stmt->execute(['id' => (int) $id]);
$results = array();
while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
	$results[] = $row;
}
echo json_encode(['data' => $results]);
