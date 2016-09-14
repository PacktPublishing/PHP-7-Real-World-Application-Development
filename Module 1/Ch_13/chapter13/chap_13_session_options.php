<?php
// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\Security\SessOptions;

$options = [
	SessOptions::SESS_OP_USE_ONLY_COOKIES => 1,
	SessOptions::SESS_OP_COOKIE_LIFETIME => 300,
	SessOptions::SESS_OP_COOKIE_HTTPONLY => 1,
	SessOptions::SESS_OP_NAME => 'UNLIKELYSOURCE',
	SessOptions::SESS_OP_SAVE_PATH => __DIR__ . '/session'
];
$sessOpt = new SessOptions($options);
$sessOpt->start();
$_SESSION['test'] = 'TEST';
phpinfo(INFO_VARIABLES);
