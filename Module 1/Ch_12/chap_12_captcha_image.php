<?php
define('IMAGE_DIR', __DIR__ . '/captcha');
define('IMAGE_URL', '/captcha');
define('IMAGE_FONT', __DIR__ . '/FreeSansBold.ttf');

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// classes to use
use Application\Captcha\Image;

session_start();
session_regenerate_id();

function setCaptcha(&$phrase, &$label, &$image)
{
	$captcha = new Image(IMAGE_DIR, IMAGE_URL, IMAGE_FONT);
	$phrase  = $captcha->getPhrase();
	$label   = $captcha->getLabel();
	$image   = $captcha->getImage();
	$_SESSION['phrase'] = $phrase;
	return $captcha;
}

// init vars
$image   = '';
$label   = '';
$phrase  = $_SESSION['phrase'] ?? '';
$message = '';
$info = 'You Can Now See Super Secret Information!!!';

// determine login status
$loggedIn = $_SESSION['isLoggedIn'] ?? FALSE;
$loggedUser = $_SESSION['user'] ?? 'guest';

if (!empty($_POST['login'])) {
	if (empty($_POST['captcha'])) {
		$message = 'Enter Captcha Phrase and Login Information';
	} else {
		if ($_POST['captcha'] == $phrase) {
			// hard-coded to simulate $username lookuop
			$username = 'test';
			$password = 'password';
			// test post user + password against simulated lookup values
			if ($_POST['user'] == $username && $_POST['pass'] == $password) {
				$loggedIn = TRUE;
				$_SESSION['user'] = strip_tags($username);
				$_SESSION['isLoggedIn'] = TRUE;
				$loggedUser = $username;
			} else {
				$message = 'Invalid Login';
			}
		} else {
			$message = 'Invalid Captcha';
		}
	}
} elseif (isset($_POST['logout'])) {
	// wipe out session data
	session_unset();
	// destroy session
	session_destroy();
	// expire session cookie
	setcookie('PHPSESSID', 0, time() - 3600);
	// force a new request cycle
	header('Location: ' . $_SERVER['REQUEST_URI'] );
	exit;
}
$captcha = setCaptcha($phrase, $label, $image);

include __DIR__ . '/chap_12_captcha_view_include.php';
