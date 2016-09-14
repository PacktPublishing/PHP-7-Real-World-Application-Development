<?php
$wsdl = 'http://graphical.weather.gov/xml/SOAP_server/ndfdXMLserver.php?wsdl';
$xml = new SimpleXMLElement($wsdl, 0, TRUE);

// xpath queries
echo "---------------------\n";
echo "Operations\n";
echo "---------------------\n";
$ops = $xml->xpath('//' . "-" . 'operation');
foreach ($ops as $node) {
	echo $node['name'] . PHP_EOL;
}
