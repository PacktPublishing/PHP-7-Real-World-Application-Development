<?php
// developing functions library -- using iterators

// example using ArrayIterator
function arrayToIterator(array $array)
{
    return new ArrayIterator($array);
}

// produces <ul><li> ... </li> ... </ul> from iterator
function htmlList($iterator)
{
    $output = '<ul>';
    foreach($iterator as $value) {
        $output .= '<li>' . $value . '</li>';
    }
    $output .= '</ul>';
    return $output;
}

// produces <table> from iterator
function htmlTable($iterator, $across)
{
    $stop   = FALSE;
    $output = '<table><tr>';
    $count  = 0;
    foreach($iterator as $item) {
        if ($count-- == 0) {
            $output .= '</tr><tr>';
            $count = $across - 1;
        }
        $output .= '<td>' . $item . '</td>';
    }
    $output .= '</tr></table>';
    return $output;
}

// takes an array and produces HTML <ul><li>
function arrayToHtml(array $array)
{
    return htmlList(arrayToIterator($array));
}
 
function filteredResultsGenerator(array $array, $filter, $limit = 10, $page = 0)
{
    $max    = count($array);
    $offset = $page * $limit;
    foreach ($array as $key => $value) {
        // apply filter
        if (!stripos($value, $filter) !== FALSE) continue;
        // skip until offset reached
        if (--$offset >= 0) continue;
        // break if limit exceeded
        if (--$limit <= 0) break; 
        // otherwise yield value
        yield $value;
    }
}

function nameFilterIterator($innerIterator, $name)
{
    if (!$name) return $innerIterator;
    $name = trim($name);
    $iterator = new CallbackFilterIterator($innerIterator, 
        function($current, $key, $iterator) use ($name) {
            $pattern = '/' . $name . '/i';
            return (bool) preg_match($pattern, $current);
        }
    );
    return $iterator;
}

function fetchCountryName($sql, $connection)
{
    $iterator = new ArrayIterator();
    $stmt = $connection->pdo->query($sql);
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $iterator->append($row['name']);
    }
    return $iterator;
}

function fetchAllAssoc($sql, $connection)
{
    $iterator = new ArrayIterator();
    $stmt = $connection->pdo->query($sql);
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $iterator->append($row);
    }
    return $iterator;
}

function pagination($iterator, $offset, $limit)
{
    return new LimitIterator($iterator, $offset, $limit);
}
