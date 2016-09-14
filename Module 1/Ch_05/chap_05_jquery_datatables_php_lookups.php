<?php
// does initial customer lookup; implements secondary lookup via jQuery DataTables

define('DB_CONFIG_FILE', '/../config/db.config.php');
include __DIR__ . '/../Application/Database/Connection.php';

use Application\Database\Connection;
$conn = new Connection(include __DIR__ . DB_CONFIG_FILE);

function findCustomerById($id, Connection $conn)
{
	$stmt = $conn->pdo->query('SELECT * FROM customer WHERE id = ' . (int) $id);
	$results = $stmt->fetch(PDO::FETCH_ASSOC);
	return $results;
}

// pick ID at random
$id     = rand(1,79);
$result = findCustomerById($id, $conn);
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<script src="https://code.jquery.com/jquery-1.12.0.min.js">
	</script>
    <script type="text/javascript" 
			charset="utf8" 
			src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js">
    </script>
	<link rel="stylesheet" 
			type="text/css" 
			href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
    <script>
	$(document).ready(function() {
		$('#customerTable').DataTable(
			{ "ajax": '/chap_05_jquery_datatables_php_lookups_ajax.php?id=<?= $id ?>' }
 		);
	} );
    </script>
	<style>
		.container {
			width: 800px;
			float: left;
		}
		.row {
			width: 800px;
			float: left;
		}
		.left {
			width: 300px;
			font-weight: bold;
			font-family: helvetica;
			float: left;
		}
		.right {
			font-family: helvetica;
			width: 500px;
			float: left;
		}
		h1 {
			background-color: #FFFF6F;
		}
		table {
			width: 800px; 
			float:left;		
		}
		th {
			background-color: #84BCF2;
			font-family: helvetica;
			border: thin solid black; 
		}
		td {
			background-color: #FDFD9F;
			font-family: helvetica;
			border: thin solid black; 
		}
	</style>
</head>
<body>

<div class="container">
	
	<!-- Customer Info -->
	<h1><?= $result['name'] ?></h1>	
	<div class="row">
		<div class="left">Balance</div><div class="right"><?= $result['balance']; ?></div>
	</div>
	<div class="row">
		<div class="left">Email</div><div class="right"><?= $result['email']; ?></div>
	</div>
	<div class="row">
		<div class="left">Status</div><div class="right"><?= $result['status']; ?></div>
	</div>
	<div class="row">
		<div class="left">Level</div><div class="right"><?= $result['level']; ?></div>
	</div>

	<!-- Purchases Info -->
	<!-- the secondary lookup is performed by an AJAX query -->
	<table id="customerTable" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Transaction</th>
				<th>Date</th>
				<th>Qty</th>
				<th>Price</th>
				<th>Product</th>
			</tr>
		</thead>
	</table>

</div>

</body>
</html>

