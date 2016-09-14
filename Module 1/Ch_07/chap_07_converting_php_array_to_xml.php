<?php
// array to XML

define('CONFIG_FILE', __DIR__ . '/../data/files/mongo.db.global.php');

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// classes to use
use Application\Parse\ConvertXml;

$convert = new ConvertXml();
header('Content-Type: text/xml');
echo $convert->arrayToXml(include CONFIG_FILE);
