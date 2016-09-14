<?php
// XML to array
// see http://php.net/manual/en/class.simplexmliterator.php

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// classes to use
use Application\Parse\ConvertXml;

$wsdl = 'http://graphical.weather.gov/xml/SOAP_server/ndfdXMLserver.php?wsdl';
$xml = new SimpleXMLIterator($wsdl, 0, TRUE);
$convert = new ConvertXml();
var_dump($convert->xmlToArray($xml));
