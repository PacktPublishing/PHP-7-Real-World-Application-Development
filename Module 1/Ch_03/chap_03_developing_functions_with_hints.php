<?php
// developing functions -- type hints

// it's a best practice to place all functions definitions 
// in a separate file which is then included
include (__DIR__ . DIRECTORY_SEPARATOR . 'chap_03_developing_functions_type_hints_library.php');


// executes someTypeHint()
echo "\nsomeTypeHint()\n";
try {
    echo someTypeHint([1,2,3], new DateTime(), function () { return 'Callback Return'; });
    // causes a TypeError to be thrown
    echo someTypeHint('A', 'B', 'C');
} catch (TypeError $e) {
    echo $e->getMessage();
    echo PHP_EOL;
}

// executes someScalarHint()
echo "\nsomeScalarHint()\n";
try {
    echo someScalarHint(TRUE, 11, 22.22, 'This is a string');
    // causes a TypeError to be thrown
    echo someScalarHint('A', 'B', 'C', 'D');
} catch (TypeError $e) {
    echo $e->getMessage();
}

// executes someBooleanHint() with values which convert to TRUE or FALSE
echo "\nsomeBooleanHint()\n";
try {
    // boolean type hinting doesn't throw TypeError if you pass in any scalar
    // positive results
    $b = someBoolHint(TRUE);
    $i = someBoolHint(11);
    $f = someBoolHint(22.22);
    $s = someBoolHint('X');
    var_dump($b, $i, $f, $s);
    echo PHP_EOL;
    // negative results
    $b = someBoolHint(FALSE);
    $i = someBoolHint(0);
    $f = someBoolHint(0.0);
    $s = someBoolHint('');
    var_dump($b, $i, $f, $s);
    echo PHP_EOL;
} catch (TypeError $e) {
    echo $e->getMessage();
}

// executes someBooleanHint() catches TypeError
echo "\nsomeBooleanHint()\n";
try {
    // boolean type hinting will throw TypeError if you pass in other data types
    $a = someBooleanHint([1,2,3]);
    $o = someBooleanHint(new stdClass());
    var_dump($a, $o);
    echo PHP_EOL;
} catch (TypeError $e) {
    echo $e->getMessage();
}
