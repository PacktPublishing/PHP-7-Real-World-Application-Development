<?php
// here are the functions we will test
function add($a = NULL, $b = NULL)
{
	return $a + $b;
}

function sub($a, $b)
{
	return $a - $b;
}

function mult($a, $b)
{
	return $a * $b;
}

function div($a, $b)
{
	if ($b == 0) {
		return 0;
	} else {
		return $a / $b;
	}
}

/**
 * Builds an HTML table out of an array
 */
function table(array $a)
{
	$table = '<table>';
	foreach ($a as $row) {
		$table .= '<tr><td>';
		$table .= implode('</td><td>', $row);
		$table .= '</td></tr>';
	}
	$table .= '</table>';
	return $table;
}
