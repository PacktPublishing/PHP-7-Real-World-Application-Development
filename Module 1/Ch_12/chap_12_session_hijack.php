<?php
// demonstrates vulnerability of using session as only means of authentication:
/*
 * 1. run "php -S localhost:8080"
 * 2. from a browser access this page
 * 3. note the value for PHPSESSID
 * 4. open another browser
 * 5. modify the PHPSESSID cookie setting it to this value
 * 6. notice that you can now see "Super Secret Information"
 */

session_start();
$loggedUser = $_SESSION['loggedUser'] ?? '';
$loggedIn = $_SESSION['isLoggedIn'] ?? FALSE;
$username = 'test';
$password = 'password';
$info = 'You Can Now See Super Secret Information!!!';

if (isset($_POST['login'])) {
	if ($_POST['username'] == $username
		&& $_POST['password'] == $password) {
		$loggedIn = TRUE;
		$_SESSION['isLoggedIn'] = TRUE;
		$_SESSION['loggedUser'] = $username;
		$loggedUser = $username;
	}
} elseif (isset($_POST['logout'])) {
	session_destroy();
}

include __DIR__ . '/chap_12_session_protection_simple_login.php';
