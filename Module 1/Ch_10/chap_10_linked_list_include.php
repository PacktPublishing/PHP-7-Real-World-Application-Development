<?php
/**
 * Returns a doubly-linked list which lets you iterate forward or reverse
 *
 * @param ArrayIterator $linked
 * @return SplDoublyLinkedList $double
 */
function buildDoublyLinkedList(ArrayIterator $linked)
{
	$double = new SplDoublyLinkedList();
	foreach ($linked as $key => $value) {
		$double->push($value);
	}
	return $double;
}

/**
 * Created linked list in the form of ArrayIterator
 *
 * @param array $primary = [key => [id,xxx,yyy,zzz], key => [id,xxx,yyy,zzz]]
 * @param callable $makeLink = anonymous function which produces a key
 * @param mixed $filterCol = optional column to filter by
 * @param mixed $filterVal = optional allowed value
 * @return ArrayIterator $linked
 */
function buildLinkedList(array $primary,
						callable $makeLink,
						$filterCol = NULL,
						$filterVal = NULL)
{
	$linked = new ArrayIterator();
	$filterVal = trim($filterVal);
	foreach ($primary as $key => $row) {
		// only include in the linked list if level == INT
		if ($filterCol) {
			if (trim($row[$filterCol]) == $filterVal) {
				$linked->offsetSet($makeLink($row), $key);
			}
		} else {
			$linked->offsetSet($makeLink($row), $key);
		}
	}
	$linked->ksort();
	return $linked;
}

function printHeaders($headers)
{
	return sprintf('%4s : %18s : %8s : %32s : %4s' . PHP_EOL,
					ucfirst($headers[0]),
					ucfirst($headers[1]),
					ucfirst($headers[2]),
					ucfirst($headers[3]),
					ucfirst($headers[9]));
}

function printRow($row)
{
	return sprintf('%4d : %18s : %8.2f : %32s : %4s' . PHP_EOL,
					$row[0], $row[1], $row[2], $row[3], $row[9]);
}

// produce output based on linked list
// NOTE: this is the real trick:
//       *don't* iterate through $customer directly!
//       instead, you iterate through the linked list
function printCustomer($headers, $linked, $customer)
{
	$output = '';
	$output .= printHeaders($headers);
	foreach ($linked as $key => $link) {
		// NOTE: use the link to access the appropriate $customer element
		$output .= printRow($customer[$link]);
	}
	return $output;
}

/**
 * Produces an multi-dimensional array from CSV file
 *
 * @param string $fn = filename
 * @param array $headers = NULL upon input
 * @return array $result = [key => [id,xxx,yyy,zzz], key => [id,xxx,yyy,zzz]]
 */
function readCsv($fn, &$headers)
{
	if (!file_exists($fn)) {
		throw new Error('File Not Found');
	}
	$fileObj = new SplFileObject($fn, 'r');
	$result = array();
	$headers = array();
	$firstRow = TRUE;
	while ($row = $fileObj->fgetcsv()) {
		// store 1st row as headers
		if ($firstRow) {
			$firstRow = FALSE;
			$headers = $row;
		} else {
			if ($row && $row[0] !== NULL && $row[0] !== 0) {
				$result[$row[0]] = $row;
			}
		}
	}
	return $result;
}

/**
 * @param ArrayIterator $linked = [key => link] where key = 0 - n and link = key in $primary
 * @param array $primary = [key => [xxx,yyy,zzz]]
 * @param mixed $sortField = field used as sort criteria
 * @param string $order = A = ASC | D = DESC
 */
function bubbleSort(&$linked, $primary, $sortField, $order = 'A')
{
	static $iterations = 0;
	$swaps = 0;
	$iterator = new ArrayIterator($linked);
	while ($iterator->valid()) {
		$currentLink = $iterator->current();
		$currentKey  = $iterator->key();
		if (!$iterator->valid()) break;
		$iterator->next();
		$nextLink = $iterator->current();
		$nextKey  = $iterator->key();
		if ($order == 'A') {
			$expr = $primary[$linked->offsetGet($currentKey)][$sortField]
					> $primary[$linked->offsetGet($nextKey)][$sortField];
		} else {
			$expr = $primary[$linked->offsetGet($currentKey)][$sortField]
					< $primary[$linked->offsetGet($nextKey)][$sortField];
		}
		// swap pointers if expression is true
		// if values are == leave alone
		if ($expr && $currentKey && $nextKey && $linked->offsetExists($currentKey) && $linked->offsetExists($nextKey)) {
			$tmp = $linked->offsetGet($currentKey);
			$linked->offsetSet($currentKey, $linked->offsetGet($nextKey));
			$linked->offsetSet($nextKey, $tmp);
			$swaps++;
		}
	}
	if ($swaps) bubbleSort($linked, $primary, $sortField, $order);
	return ++$iterations;
}

