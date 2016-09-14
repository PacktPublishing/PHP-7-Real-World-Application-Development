<?php
// embeds code to perform a secondary lookup into database query results

define('DB_CONFIG_FILE', '/../config/db.config.php');
define('ITEMS_PER_PAGE', 4);
define('SUBROWS_PER_PAGE', 4);

include __DIR__ . '/../Application/Database/Connection.php';

use Application\Database\Connection;
$conn = new Connection(include __DIR__ . DB_CONFIG_FILE);

$sql  = 'SELECT c.id,c.name,c.balance,c.email,f.phone, '
	  . 'u.transaction,u.date,u.quantity,u.sale_price,r.title '
	  . 'FROM customer AS c '
	  . 'JOIN profile AS f '
	  . 'ON f.id = c.id '
	  . 'JOIN purchases AS u '
	  . 'ON u.customer_id = c.id '
	  . 'JOIN products AS r '
	  . 'ON u.product_id = r.id '
	  . 'WHERE c.id >= :min AND c.id < :max '
	  . 'ORDER BY c.id ASC, u.date DESC ';

// get page number
$page = $_GET['page'] ?? 1;
$page = (int) $page;
$next = $page + 1;
$prev = $page - 1;
$prev = ($prev >= 0) ? $prev : 0;

// calculate min & max + prepare and execute query
$min  = $prev * ITEMS_PER_PAGE;
$max  = $page * ITEMS_PER_PAGE;
$stmt = $conn->pdo->prepare($sql);
$stmt->execute(['min' => $min, 'max' => $max]);

// build multi-dimensional array from query
$custId = 0;
$result = array();
$grandTotal = 0.0;
//echo '<pre>';
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	//printf('%6s : %20s : %8s : %20s' . PHP_EOL, $row['id'], $row['name'], $row['transaction'], $row['title']);
	// change of ID signals new customer
	if ($row['id'] != $custId) {
		$custId = $row['id'];
		// basic cust info to display
		$result[$custId] = [
			'name' => $row['name'],
			'balance' => $row['balance'],
			'email' => $row['email'],
			'phone' => $row['phone'],
		];
		$result[$custId]['total'] = 0;
	}
	// populate sub-array
	$result[$custId]['purchases'][] = [
		'transaction' => $row['transaction'],
		'date' 		  => $row['date'],
		'quantity' 	  => $row['quantity'],
		'sale_price'  => $row['sale_price'],
		'title' 	  => $row['title'],
	];
	$result[$custId]['total'] += $row['sale_price'];
	$grandTotal += $row['sale_price'];
}
//echo '</pre>'; exit;
//echo '<pre>', var_dump($result), '</pre>'; exit;
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="php7cookbook_html_table.css">
	<script type="text/javascript">
	function showOrHide(id) {
		var div = document.getElementById(id);
		div.style.display = div.style.display == "none" ? "block" : "none";
    }
	</script>
</head>
<body>

<div class="container">

	<!-- Customer Info -->
	<h1>Customer Info</h1>
	<?php foreach ($result as $key => $data) : ?>
	<div class="mainLeft color0">
			<?= $data['name'] ?> [<?= $key ?>]
			<input type="button" value="Purchases" class="buttonRight" onClick="showOrHide('<?= 'purchase' . $key ?>')">
	</div>
	<div class="mainRight">
		<div class="row">
			<div class="left">Balance</div><div class="right"><?= $data['balance']; ?></div>
		</div>
		<div class="row">
			<div class="left color2">Email</div><div class="right"><?= $data['email']; ?></div>
		</div>
		<div class="row">
			<div class="left">Phone</div><div class="right"><?= $data['phone']; ?></div>
		</div>
		<div class="row">
			<div class="left color2">Total Purchases</div><div class="right"><?= number_format($data['total'],2); ?></div>
		</div>
		<!-- Purchases Info -->
		<div class="row" id="<?= 'purchase' . $key ?>" style="display:none;">
			<table>
				<tr>
					<th>Transaction</th><th>Date</th><th>Qty</th><th>Price</th><th>Product</th>
				</tr>
			<?php $count  = 0; ?>
			<?php $first  = TRUE; ?>
			<?php foreach ($data['purchases'] as $purchase) : ?>
				<?php if ($count > SUBROWS_PER_PAGE && $first) : ?>
					<?php     $first = FALSE; ?>
					<?php     $subId = 'subrow' . $key; ?>
					</table>
					<a href="#" onClick="showOrHide('<?= $subId ?>')">More</a>
					<div id="<?= $subId ?>" style="display:none;">
					<table>
				<?php endif; ?>
				<?php $class = ($count++ & 01) ? 'color1' : 'color2'; ?>
				<tr>
					<td class="<?= $class ?>"><?= $purchase['transaction'] ?></td>
					<td class="<?= $class ?>"><?= $purchase['date'] ?></td>
					<td class="<?= $class ?>"><?= $purchase['quantity'] ?></td>
					<td class="<?= $class ?>"><?= $purchase['sale_price'] ?></td>
					<td class="<?= $class ?>"><?= $purchase['title'] ?></td>
				</tr>
			<?php endforeach; ?>
			</table>
			<?php if (!$first) : ?></div><?php endif; ?>
		</div>
		<!-- End Purchases Info -->
		<div class="row color3">&nbsp;</div>
	</div>

	<?php endforeach; ?>
	<h3>Page Total: <?= number_format($grandTotal,2); ?></h3>
	<div class="container">
		<a href="?page=<?= $prev ?>"><input type="button" value="Previous"></a>
		<a href="?page=<?= $next ?>"><input type="button" value="Next" class="buttonRight"></a>
	</div>
	<div class="clearRow"></div>

</div>

</body>
</html>

