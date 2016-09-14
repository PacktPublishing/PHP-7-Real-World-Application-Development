<?php
// shows the use of anonymous classes

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

