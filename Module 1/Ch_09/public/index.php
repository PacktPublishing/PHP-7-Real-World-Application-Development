<?php
// demos using middleware for authorization

session_start();
session_regenerate_id();
// form which is unprotected from CSRF attacks
define('DB_CONFIG_FILE', __DIR__ . '/../../config/db.config.php');
define('DB_TABLE', 'customer_09');
define('PAGE_DIR', __DIR__ . '/../pages');
define('SESSION_KEY', 'auth');

// setup class autoloading
require __DIR__ . '/../../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/../..');

use Application\Database\Connection;
use Application\Acl\ { Authenticate, Acl, DbTable };
use Application\MiddleWare\ { ServerRequest, Request, Constants, TextStream };

$config = require __DIR__ . '/../chap_09_middleware_acl_config.php';
$acl    = new Acl($config);
$conn   = new Connection(include DB_CONFIG_FILE);
$dbAuth = new DbTable($conn, DB_TABLE);
$auth   = new Authenticate($dbAuth, SESSION_KEY);

$incoming = new ServerRequest();
$incoming->initialize();
$outbound = new Request();

if ($incoming->getMethod() == Constants::METHOD_POST) {
    $body = new TextStream(json_encode($incoming->getParsedBody()));
    $response = $auth->login($outbound->withBody($body));
}

// check to see if authenticated
$info = $_SESSION[SESSION_KEY] ?? FALSE;
// they're logged in ... check their level and status
if (!$info) {

    // otherwise, redirect to login
    $execute = function () use ($auth) {
        include PAGE_DIR . '/auth.php';
    };

} else {

    // process ACL
    $query = $incoming->getServerParams()['QUERY_STRING'] ?? '';
    $outbound->withBody(new TextStream(json_encode($info)));
    $outbound->getUri()->withQuery($query);
    $response = $acl->isAuthorized($outbound);
    $params   = json_decode($response->getBody()->getContents());
    $isAllowed = $params->authorized ?? FALSE;
    if ($isAllowed) {
        $execute = function () use ($response, $params) {
            include PAGE_DIR .'/' . $params->page . '.php';
            echo '<pre>', var_dump($response), '</pre>';
            echo '<pre>', var_dump($_SESSION[SESSION_KEY]), '</pre>';
        };
    } else {
        $execute = function () use ($response, $params) {
            include PAGE_DIR .'/sorry.php';
            echo '<pre>', var_dump($response), '</pre>';
            echo '<pre>', var_dump($_SESSION[SESSION_KEY]), '</pre>';
        };
    }

}
// sets form action
$action   = $incoming->getServerParams()['PHP_SELF'];
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
    <?php include PAGE_DIR . '/menu.php'; ?>
    <?php $execute(); ?>
</body>
</html>
