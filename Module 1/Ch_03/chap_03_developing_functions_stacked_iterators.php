<?php
// developing functions -- using "stacked" iterators

function showElements($iterator)
{
    foreach($iterator as $item) echo $item . ' ';
    echo PHP_EOL;
}

$a = range('A','Z');
$i = new ArrayIterator($a);

// just using ArrayIterator
// A B C D E F G H I J K L M N O P Q R S T U V W X Y Z 
echo "\nArrayIterator\n";
showElements($i);

// just using ArrayIterator + FilterIterator
// B D F H J L N P R T V X Z 
// NOTE: illustrates use of PHP 7 anonymous class support
$f = new class ($i) extends FilterIterator {
    public function accept()
    {
        $current = $this->current();
        // returns letters with "even" ASCII codes
        return !(ord($current) & 1);
    }
};
echo "\nArrayIterator + FilterIterator\n";
showElements($f);

// just using ArrayIterator + FilterIterator + LimitIterator
// F H J L N P 
$l = new LimitIterator($f, 2, 6);   // $f = iterator, 2 = offset, 6 = length
echo "\nArrayIterator + FilterIterator + LimitIterator\n";
showElements($l);

