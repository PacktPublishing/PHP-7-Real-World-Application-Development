<?php
// shows the use of anonymous classes

define('MAX_COLORS', 256 ** 3);

// anonymous classes can also implement interfaces
$d = new class () implements Countable {
    public $current = 0;
    public $maxRows = 16;
    public $maxCols = 64;
    public function cycle()
    {
        $row = '';
        $max = $this->maxRows * $this->maxCols;
        for ($x = 0; $x < $this->maxRows; $x++) {
            $row .= '<tr>';
            for ($y = 0; $y < $this->maxCols; $y++) {
                $row .= sprintf('<td style="background-color: #%06X;" ', $this->current);
                $row .= sprintf('title="#%06X">&nbsp;</td>', $this->current);
                $this->current++;
                $this->current = ($this->current > MAX_COLORS) ? 0 : $this->current;
            }
            $row .= '</tr>';
        }
        return $row;
    }
    // required by Countable
    public function count()
    {
        return MAX_COLORS;
    }
};

// get current value from URI
$d->current = $_GET['current'] ?? 0;
$d->current = hexdec($d->current);
$factor = ($d->maxRows * $d->maxCols);
$next = $d->current + $factor;
$prev = $d->current - $factor;
$next = ($next < MAX_COLORS) ? $next : MAX_COLORS - $factor;
$prev = ($prev >= 0) ? $prev : 0;
$next = sprintf('%06X', $next);
$prev = sprintf('%06X', $prev);
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<!-- we are able to run count() because $d implements Countable -->
<h1>Total Possible Color Combinations: <?= count($d); ?></h1>
<hr>
<table>
    <?= $d->cycle(); ?>
</table>	
<a href="?current=<?= $prev ?>"><< PREV </a>
<a href="?current=<?= $next ?>">NEXT >></a>
</body>
</html>
