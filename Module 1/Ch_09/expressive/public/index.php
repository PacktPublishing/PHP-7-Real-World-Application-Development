<?php

// Delegate static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server'
    && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))
) {
    return false;
}

chdir(dirname(__DIR__));
// 2016-07-03
session_start();
$_SESSION['time'] = time();
$appDir = realpath(__DIR__ . '/../../..');
$loader = require 'vendor/autoload.php';
$loader->add('Application', $appDir);

/** @var \Interop\Container\ContainerInterface $container */
$container = require 'config/container.php';

/** @var \Zend\Expressive\Application $app */
$app = $container->get(\Zend\Expressive\Application::class);
$app->run();
