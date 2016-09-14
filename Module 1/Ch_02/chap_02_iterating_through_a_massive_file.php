<?php
// taking advantage of AST
// you need to run this using PHP 7

define('MASSIVE_FILE', '/../../data/files/war_and_peace.txt');

// setup class autoloading
require __DIR__ . '/../../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/../..');

// get iterator class
try {
    $largeFile = new Application\Iterator\LargeFile(__DIR__ . MASSIVE_FILE);
    $iterator = $largeFile->getIterator('ByLine');
    // NOTE: this comes back as an instance of Generator, which implements Iterator
    echo get_class($iterator);
    // iterate through large file; count number of words per line and record average
    $words = 0;
    foreach ($iterator as $line) {
        echo $line;
        $words += str_word_count($line);
    }
    echo str_repeat('-', 52) . PHP_EOL;
    printf("%-40s : %8d\n", 'Total Words', $words);
    printf("%-40s : %8d\n", 'Average Words Per Line', ($words / $iterator->getReturn()));
    echo str_repeat('-', 52) . PHP_EOL;
} catch (Throwable $e) {
    echo $e->getMessage();
}
