<?php
// demonstrates session protection
/*
 * 1. run "php -S localhost:8080"
 * 2. from a browser access this page
 * 3. note the value for PHPSESSID
 * 4. open another browser
 * 5. modify the PHPSESSID cookie setting it to this value
 * 6. notice that you can now see "Super Secret Information"
 */

define('THUMB_PRINT_DIR', __DIR__ . '/../data/');

session_start();
session_regenerate_id();

// init vars
$username = 'test';
$password = 'password';
$info = 'You Can Now See Super Secret Information!!!';

// determine login status
$loggedIn = $_SESSION['isLoggedIn'] ?? FALSE;
$loggedUser = $_SESSION['user'] ?? 'guest';

// session thumbprint
$thumbPrint = md5($_SERVER['REMOTE_ADDR']
				. $_SERVER['HTTP_USER_AGENT']
				. $_SERVER['HTTP_ACCEPT_LANGUAGE']);
$storedPrint = $_SESSION['thumbprint'] ?? '';

if (isset($_POST['login'])) {
	if ($_POST['username'] == $username
		&& $_POST['password'] == $password) {
		$loggedIn = TRUE;
		$_SESSION['user'] = strip_tags($username);
		$_SESSION['isLoggedIn'] = TRUE;
		// store thumbprint
		$_SESSION['thumbprint'] = $thumbPrint;
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
} elseif ($loggedIn && !$thumbPrint == $storedPrint) {
	$info = 'SESSION INVALID!!!';
	error_log('Session Invalid: ' . date('Y-m-d H:i:s'), 0);
	// take appropriate action
}

include __DIR__ . '/chap_12_session_protection_simple_login.php';
