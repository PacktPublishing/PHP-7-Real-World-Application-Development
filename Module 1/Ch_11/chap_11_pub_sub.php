<?php
include __DIR__ . '/chap_11_pub_sub_include.php';

use Application\Database\Connection;
use Application\PubSub\ { Publisher, Subscriber };

// set connection
$conn = new Connection(include DB_CONFIG_FILE);

$pubError = new Publisher('error');

// set up subscribers
$subAccess = new Subscriber(
	'access',
	function ($pub) {
		file_put_contents($pub->getData()['filename'], $pub->getData()['message'] . PHP_EOL, FILE_APPEND);
	}
);
$subError = new Subscriber(
	'error',
	function ($pub) {
		file_put_contents($pub->getData()['filename'], $pub->getData()['message'] . PHP_EOL, FILE_APPEND);
	},
	1
);
$subFatal = new Subscriber(
	'fatal',
	function ($pub) {
		$fatal = $pub->getData()['fatal'] ?? FALSE;
		if ($fatal)
			die($pub->getData()['message']);
	},
	99
);

// set log publisher
$pubLog   = new Publisher('log');
$pubLog->attach($subAccess);
$pubLog->setDataByKey('filename', LOG_FILE);
$pubLog->setDataByKey('message', $_SERVER['REMOTE_ADDR'] . ':' . date('Y-m-d H:i:s'));
$pubLog->notify();

// set up error publisher
$pubErr = new Publisher('error');
$pubErr->setDataByKey('filename', ERROR_FILE);
$pubErr->attach($subError);
$pubErr->attach($subFatal);

// form: $elements + $formConfig come from include files
$form = generateForm($elements, $formConfig, $callbacks, $assignments);

// modify form action
$formConfig['attributes'] = ['method'=>'post','action'=>'#'];

// check to see if any $_GET data
$id = getUri($conn, $pubErr, $form);

// check to see if any $_POST data
$message = '';
if (isset($_POST['submit'])) {
	$form->setData($_POST);
	if (!$form->validate()) {
		$message = VALIDATE_FAILURE;
		$pubErr->setDataByKey('message', VALIDATE_FAILURE);
	} else {
		$message = VALIDATE_SUCCESS;
		$pubLog->setDataByKey('message', VALIDATE_SUCCESS);
		$pubLog->notify();
		// filter results
		$form->filter();
		// NOTE: had to add getFilter() to Form\Factory
		$goodData = $form->getFilter()->getItemsAsArray();
		// lookup prospect
		$id = (int) ($_POST['id'] ?? 0);
		$stmt = $conn->pdo->prepare('SELECT * FROM prospects_11 WHERE id = ?');
		$stmt->execute([$id]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		// get rid of unwanted fields
		if (isset($goodData['submit'])) unset($goodData['submit']);
		// if not found, insert
		if (!$result) {
			$pubLog->setDataByKey('message', MESSAGE_INSERT);
			if (isset($goodData['id'])) unset($goodData['id']);
			$sql = generateSqlInsert($goodData);
		} else {
			// otherwise update + send notification
			$pubLog->setDataByKey('message', MESSAGE_UPDATE);
			$sql = generateSqlUpdate($goodData);
		}
		$pubLog->notify();
		performDataOp($sql, $conn, $goodData, $pubErr);
	}
	$pubErr->notify();
	$form->filter();
}

// generate prospects SELECT
$select = generateSelect($conn);

// view logic
include __DIR__ . '/chap_11_pub_sub_view_logic.php';
