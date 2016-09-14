<?php
define('DB_CONFIG_FILE', __DIR__ . '/../config/db.config.php');
define('LOG_FILE', __DIR__ . '/../data/access.log');
define('ERROR_FILE', __DIR__ . '/../data/error.log');
define('MESSAGE_INSERT', 'INFO: insert operation scheduled');
define('MESSAGE_UPDATE', 'INFO: update operation scheduled');
define('SUCCESS_INSERT', 'SUCCESS: data inserted successfully');
define('ERROR_INSERT', 'ERROR: data error on insert');
define('SUCCESS_UPDATE', 'SUCCESS: data updated successfully');
define('ERROR_UPDATE', 'ERROR: data error on update');
define('ERROR_NOT_FOUND', 'ERROR: unable to locate prospect');
define('ERROR_DATABASE', 'ERROR: database error');

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// include form / filter definitions
include __DIR__ . '/../chapter06/chap_06_post_data_config_messages.php';
include __DIR__ . '/../chapter06/chap_06_post_data_config_callbacks.php';
include __DIR__ . '/../chapter06/chap_06_tying_filters_to_form_definitions.php';

// anchor classes
use Application\Form\ { Factory, Generic };
use Application\Filter\ { Validator, Filter };

// override form / element config
function generateForm($elements, $formConfig, $callbacks, $assignments)
{
	// add id element
	$elements['id'] =
	[
		'class'     => 'Application\Form\Generic',
		// NOTE: had to add this const to Form\Generic!
		'type' 		=> Generic::TYPE_HIDDEN,
		'label' 	=> '',
		'wrappers' 	=> $wrappers
	];

	// assign filter and validator to form
	$form = Factory::generate($elements);
	$form->setFilter(new Filter($callbacks['filters'], $assignments['filters']));
	$form->setValidator(new Validator($callbacks['validators'], $assignments['validators']));
	return $form;
}

// check to see if any $_GET data
function getUri($conn, $pub, &$form)
{
	$id = 0;
	if (isset($_GET['find'])) {
		// lookup prospect
		$id = (int) $_GET['prospect'];
		$stmt = $conn->pdo->prepare('SELECT * FROM prospects_11 WHERE id = ?');
		$stmt->execute([$id]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		// if not found send notification
		if (!$result) {
			$pub->setDataByKey('message', ERROR_NOT_FOUND . ':' . $id);
			$pub->notify();
		} else {
			// otherwise populate $form with data
			$id = $result['id'];
			foreach ($form->getElements() as $element) {
				$value = $result[$element->getName()] ?? FALSE;
				if ($value) {
					$element->setSingleAttribute('value', strip_tags($value));
				}
			}
		}
	}
	return $id;
}

function performDataOp($sql, $conn, $data, $pub)
{
	try {
		$stmt = $conn->pdo->prepare($sql);
		if ($stmt->execute($data)) {
			// send success notification
			$message = SUCCESS_INSERT;
		} else {
			// send failure notification
			$message = ERROR_INSERT;
			$pub->setDataByKey('message', ERROR_INSERT);
		}
	} catch (PDOException $e) {
		// log exception
		$message = ERROR_DATABASE;
		$pub->setDataByKey('message', ERROR_DATABASE . ':' . $e->getMessage());
		$pub->setDataByKey('fatal', TRUE);
	}
}

function generateSqlInsert($data)
{
	$sql = 'INSERT INTO prospects_11 ';
	$sql .= ' ( ' . implode(',', array_keys($data)) . ' ) ';
	$sql .= ' VALUES ';
	$sql .= ' ( :' . implode(',:', array_keys($data)) . ' ) ';
	return $sql;
}

function generateSqlUpdate($data)
{
	$sql = 'UPDATE prospects_11 SET ';
	foreach ($data as $key => $value)
		$sql .= $key . '= :' . $key . ',';
	$sql = substr($sql, 0, -1);
	$sql .= ' WHERE id = :id';
	return $sql;
}

// generate prospects SELECT
function generateSelect($conn)
{
	$stmt = $conn->pdo->query('SELECT id,last_name,first_name FROM prospects_11 ORDER BY last_name');
	$select = '<select name="prospect">' . PHP_EOL;
	$select .= '<option value="0">Add New</option>' . PHP_EOL;
	while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
		if ($data['id'] == $id) {
			$selected = ' selected';
		} else {
			$selected = '';
		}
		$select .= sprintf('<option value="%s" %s>%s, %s</option>' . PHP_EOL,
							$data['id'], $selected, $data['last_name'], $data['first_name']);
	}
	$select .= '</select>' . PHP_EOL;
	return $select;
}
