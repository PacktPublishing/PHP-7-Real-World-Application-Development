<?php
// implementing a filtering/validation class taking advantage of AST

// setup class autoloading
require __DIR__ . '/../../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/../..');

// get filter/validator security instance    
$security = new Application\Web\Security();

// test data
$data = [
    '<ul><li>Lots</li><li>of</li><li>Tags</li></ul>',
    12345,
    'This is a string',
    'String with number 12345',
];

foreach ($data as $item) {
    echo 'ORIGINAL: ' . $item . PHP_EOL;
    echo 'FILTERING' . PHP_EOL;
    printf('%12s : %s' . PHP_EOL, 'Strip Tags', $security->filterStripTags($item));
    printf('%12s : %s' . PHP_EOL, 'Digits',     $security->filterDigits($item));
    printf('%12s : %s' . PHP_EOL, 'Alpha',      $security->filterAlpha($item));
    
    echo 'VALIDATORS' . PHP_EOL;
    printf('%12s : %s' . PHP_EOL, 'Alnum',  ($security->validateAlnum($item))  ? 'T' : 'F');
    printf('%12s : %s' . PHP_EOL, 'Digits', ($security->validateDigits($item)) ? 'T' : 'F');
    printf('%12s : %s' . PHP_EOL, 'Alpha',  ($security->validateAlpha($item))  ? 'T' : 'F');
}
