<?php
// iterating through 1 level

$wsdl = 'http://graphical.weather.gov/xml/SOAP_server/ndfdXMLserver.php?wsdl';
$xml = new SimpleXMLElement($wsdl, 0, TRUE);

// NOTE: can also load the contents this way:
// $xml = new SimpleXMLElement(file_get_contents($wsdl));

// iterating through just portType
echo "---------------------\n";
echo "portType Children\n";
echo "---------------------\n";
foreach ($xml->portType->children() as $key => $node) {
	echo $key . ':' . $node['name'] . PHP_EOL;
}
echo PHP_EOL;
