<?php
// demonstrates classes which use traits

define('DB_CONFIG_FILE', '/../config/db.config.php');

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// get db params
$params = include __DIR__ . DB_CONFIG_FILE;

try {
    
    // build list country class
    echo "\n-------------\n";
    echo "Country List\n";
    echo "------------\n";
    $list = Application\Generic\ListFactory::factory(
        new Application\Generic\CountryListUsingTrait(), $params);
    foreach ($list->list() as $item) echo $item . ' ';
    echo "\n\n\n\n";
    
    // build list customer class
    echo "\n-------------\n";
    echo "Customer List\n";
    echo "-------------\n";
    $list = Application\Generic\ListFactory::factory(
        new Application\Generic\CustomerListUsingTrait(), $params);
    foreach ($list->list() as $item) echo $item . ' ';
    
} catch (Throwable $e) {
    echo $e->getMessage();
}
