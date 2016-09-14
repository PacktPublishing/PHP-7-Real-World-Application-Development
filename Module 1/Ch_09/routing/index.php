<?php
// performs routing
define('DOC_ROOT', __DIR__);
define('PAGE_DIR', DOC_ROOT . '/../pages');

// setup class autoloading
require_once __DIR__ . '/../../Application/Autoload/Loader.php';
Application\Autoload\Loader::init(__DIR__ . '/../..');
use Application\MiddleWare\ServerRequest;
use Application\Routing\Router;

// routing configuration
$config = [
    'home' => [
        'uri' => '!^(/|/home)$!',
        'exec' => function ($matches) {
            include PAGE_DIR . '/page0.php'; }
    ],
    'page' => [
        'uri' => '!^/(page)/(\d+)(/)?$!',
        'exec' => function ($matches) {
            include PAGE_DIR . '/page' . $matches[2] . '.php'; }
    ],
    Router::DEFAULT_MATCH => [
        'uri' => '!.*!',
        'exec' => function ($matches) {
            include PAGE_DIR . '/sorry.php'; }
    ],
];

$router = new Router((new ServerRequest())->initialize(), DOC_ROOT, $config);
$execute = $router->match();
$params  = $router->getRouteMatch()['match'];

if ($fn = $router->isFileOrDir()
    && $router->getRequest()->getUri()->getPath() != '/') {
    return FALSE;
} else {
    include DOC_ROOT . '/main.php';
}
