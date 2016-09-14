<?php
// demonstrates use of cache for time consuming function

// form which is unprotected from CSRF attacks
define('DB_CONFIG_FILE', __DIR__ . '/../config/db.config.php');
define('DB_TABLE', 'cache');
define('CACHE_DIR', __DIR__ . '/cache');
define('MAX_NUM', 100000);

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\Database\Connection;
use Application\Cache\{ Constants, Core, Database, File };
use Application\MiddleWare\ { Request, TextStream };

// generates prime numbers
function generatePrimes($max)
{
    // 1,2,3 are primes
    yield from [1,2,3];
    // skip 4 and move right to 5
    for ($x = 5; $x < $max; $x++)
    {
        // odd numbers == 1
        if($x & 1) {
            $prime = TRUE;
            for($i = 3; $i < $x; $i++) {
                if(($x % $i) === 0) {
                    $prime = FALSE;
                    break;
                }
            }
            if ($prime) yield $x;
        }
    }
}

$conn    = new Connection(include DB_CONFIG_FILE);
$dbCache = new Database($conn, DB_TABLE, 'id', 'key', 'data', 'group');
$core    = new Core($dbCache);

// alternative: use file cache adapter
//$fileCache = new File(CACHE_DIR);
//$core    = new Core($fileCache);

// this is how to clear cache
//$uriString = '/?group=' . Constants::DEFAULT_GROUP;
//$cacheRequest = new Request($uriString, 'get');
//$response = $core->removeByGroup($cacheRequest);
//var_dump($response);
//exit;

$start = time() + microtime(TRUE);
echo "\nTime: " . $start;

echo "\nGet From Cache";
$uriString = '/?key=Test2';
$cacheRequest = new Request($uriString, 'get');
$response = $core->getFromCache($cacheRequest);
$status   = $response->getStatusCode();

if ($status == 200) {

    echo "\nSuccess";
    $primes = json_decode($response->getBody()->getContents());

} else {

    echo "\nFailed";
    echo "\nGenerating Primes to " . MAX_NUM;
    $primes = array();
    foreach (generatePrimes(MAX_NUM) as $num) {
        $primes[] = $num;
    }
    echo "\nSaving to Cache";
    $body = new TextStream(json_encode($primes));
    $response = $core->saveToCache($cacheRequest->withBody($body));
    $primes = json_encode($primes);
}

echo "\nPrime Numbers:\n";
var_dump($primes);

$time = time() + microtime(TRUE);
$diff = $time - $start;
echo "\nTime: $time";
echo "\nDifference: $diff";


