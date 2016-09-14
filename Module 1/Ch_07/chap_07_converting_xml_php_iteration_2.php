<?php
// iterating through everything

$wsdl = 'http://graphical.weather.gov/xml/SOAP_server/ndfdXMLserver.php?wsdl';
$xml = new SimpleXMLElement($wsdl, 0, TRUE);

function getKids($xml, $level)
{
	static $level = 0;
	foreach ($xml->children() as $key => $node) {
		for ($x = $level; $x > 0; $x--) echo "\t";
		echo $key . ':' . $node['name'] . PHP_EOL;
		if ($node->count()) {
			getKids($node, ++$level);
			--$level;
		}
	}
	echo PHP_EOL;
}

// iterating through everything
echo "------------------------------------------------------------\n";
echo "graphical.weather.gov/xml/SOAP_server/ndfdXMLserver.php?wsdl\n";
echo "------------------------------------------------------------\n";
getKids($xml, 0);
