<?php
// implements object relational mapping via embedded objects

define('DB_CONFIG_FILE', '/../config/db.config.php');

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\Database\Connection;
use Application\Database\CustomerOrmService_2;
$service = new CustomerOrmService_2(new Connection(include __DIR__ . DB_CONFIG_FILE));

// pick ID at random
$id   = rand(1,79);
$cust = $service->fetchById($id);
$cust = $service->fetchPurchasesForCustomer($cust);
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="php7cookbook.css">
</head>
<body>

<div class="container">

	<!-- Customer Info -->
	<div style="width: 600px;">
	<h1><?= $cust->getname() ?></h1>
	<div class="row">
		<div class="left">Balance</div><div class="right"><?= $cust->getBalance(); ?></div>
	</div>
	<div class="row">
		<div class="left">Email</div><div class="right"><?= $cust->getEmail(); ?></div>
	</div>
	<div class="row">
		<div class="left">Status</div><div class="right"><?= $cust->getStatus(); ?></div>
	</div>
	<div class="row">
		<div class="left">Level</div><div class="right"><?= $cust->getLevel(); ?></div>
	</div>
	</div>

	<!-- Purchases Info -->
	<!-- we can perform the secondary lookups by calling $cust->getpurchases()() -->
	<table>
		<tr>
			<th>Transaction</th><th>Date</th><th>Qty</th><th>Price</th><th>Product</th>
		</tr>
	<?php foreach ($cust->getPurchases() as $purchId => $function) : ?>
		<tr>
			<?php $purchase = $function($purchId, $service); ?>
			<td><?= $purchase->getTransaction() ?></td>
			<td><?= $purchase->getDate() ?></td>
			<td><?= $purchase->getQuantity() ?></td>
			<td><?= $purchase->getSalePrice() ?></td>
			<td><?= $purchase->getProduct()->getTitle() ?></td>
		</tr>
	<?php endforeach; ?>
	</table>

</div>

</body>
</html>

