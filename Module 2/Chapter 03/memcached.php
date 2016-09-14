<?php 

//Instantiate Memcached Object
$memCached = new Memcached();

//Add server
$memCached->addServer(‘127.0.0.1’, 11211);

//Lets get some data
$data = $memCached->get(‘packt_title’);

//Check if data is available
if($data)
{
	echo $data;
}
else
{
	/*No data is found. Fetch your data from any where and add to   memcached */
	$memCached->set(‘packt_title’, ‘Packt Publishing’);

}
