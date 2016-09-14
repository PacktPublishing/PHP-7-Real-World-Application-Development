<?php
define('DB_CONFIG_FILE', '/../config/db.config.php');

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// classes to use
use Application\Database\Connection;
use Application\Database\Search\ { Engine, Criteria };
use Application\Form\Generic;
use Application\Form\Element\Select;

// database columns to include in search
$dbCols = [
	'cname' => 'Customer Name',
	'cbal' => 'Account Balance',
	'cmail' => 'Email Address',
	'clevel' => 'Level'
];

$mapping = [
	'cname' => 'name',
	'cbal' => 'balance',
	'cmail' => 'email',
	'clevel' => 'level'
];

// get customer data
$conn = new Connection(include __DIR__ . DB_CONFIG_FILE);
$engine = new Engine($conn, 'customer', $dbCols, $mapping);

// define "wrappers"
$wrappers = [
	Generic::INPUT => ['type' => 'td', 'class' => 'content'],
	Generic::LABEL => ['type' => 'th', 'class' => 'label'],
	Generic::ERRORS => ['type' => 'td', 'class' => 'error']
];

// define elements
$fieldElement = new Select('field',
					Generic::TYPE_SELECT,
					'Field',
					$wrappers,
					['id' => 'field']);
$opsElement = new Select('ops',
					Generic::TYPE_SELECT,
					'Operators',
					$wrappers,
					['id' => 'ops']);
$itemElement = new Generic('item',
					Generic::TYPE_TEXT,
					'Searching For ...',
					$wrappers,
					['id' => 'item','title' => 'If more than one item, separate with commas']);
$submitElement = new Generic('submit',
					Generic::TYPE_SUBMIT,
					'Search',
					$wrappers,
					['id' => 'submit','title' => 'Click to Search','value' => 'Search']);

// grab input params
$key  = (isset($_GET['field'])) ? strip_tags($_GET['field']) : NULL;
$op   = (isset($_GET['ops'])) ? $_GET['ops'] : NULL;
$item = (isset($_GET['item'])) ? strip_tags($_GET['item']) : NULL;
// set form elements
$fieldElement->setOptions($dbCols, $key);
$itemElement->setSingleAttribute('value', $item);
$opsElement->setOptions($engine->getOperators(), $op);
// set up search
$criteria = new Criteria($key, $op, $item);
$results = $engine->search($criteria);
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="php7cookbook.css">
</head>
<body>

<div class="container">
	<h1>Search</h1>
	<form name="search" method="get">
	<table class="display" cellspacing="0" width="100%">
		<tr><?= $fieldElement->render(); ?></tr>
		<tr><?= $opsElement->render(); ?></tr>
		<tr><?= $itemElement->render(); ?></tr>
		<tr><?= $submitElement->render(); ?></tr>
		<tr>
			<th class="label" style="background-color:#BFDEFB;">Results</th>
			<td class="content" colspan=2 style="background-color:#D5CBCB;">
			<span style="font-size: 10pt;font-family:monospace;line-height:12px;">
			<table>
			<?php foreach ($results as $row) : ?>
				<tr>
					<td><?= $row['id'] ?></td>
					<td><?= $row['name'] ?></td>
					<td><?= $row['balance'] ?></td>
					<td><?= $row['email'] ?></td>
					<td><?= $row['level'] ?></td>
				</tr>
			<?php endforeach; ?>
			</table>
			</span>
			</td>
		</tr>
	</table>
	</form>
	<?php //phpinfo(INFO_VARIABLES); ?>
</div>
</body>
</html>
