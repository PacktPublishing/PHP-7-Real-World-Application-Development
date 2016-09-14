<?php
// shows the use of anonymous classes

// you can define properties and methods at will
$a = new class (123.45, 'TEST') {
    public $total = 0;
    public $test  = '';
    public function __construct($total, $test)
    {
        $this->total = $total;
        $this->test  = $test;
    }
};

echo "\nAnonymous Class\n";
echo $a->total;
echo PHP_EOL;
echo $a->test;
echo PHP_EOL;

// you can extend classes and override methods
$b = new ArrayIterator(range(10,100,10));
$f = new class ($b, 50) extends FilterIterator {
    public $limit = 0;
    public function __construct($iterator, $limit)
    {
        $this->limit = $limit;
        parent::__construct($iterator);
    }
    public function accept()
    {
        return ($this->current() <= $this->limit);
    }
};

echo "\nAnonymous Class Extends FilterIterator\n";
foreach ($f as $item) echo $item . ' ';
echo PHP_EOL;

// anonymous classes can also implement interfaces
$d = new class () implements Traversable {
    public function cycle()
    {
        for ($x = 0; $x < 256; $x++) {
            yield sprintf('%03x', $x);
        }
    }
};

$count = 0;
foreach ($d as $color) {
    if ($count % 64) echo '<br>';
    echo '<span style="bg-color: #' . $color . '">&nbsp;</span>';
}
echo PHP_EOL;

