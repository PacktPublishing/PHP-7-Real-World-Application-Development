<?php // view logic for captcha ?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="php7cookbook.css">
</head>
<body>

<div class="container">

	<!-- Simple Login -->
	<div style="width: 600px;">
	<form name="login" method="post">
	<h1>Login With CAPTCHA</h1>
	Welcome: <?= $loggedUser; ?>
	<table>
	<tr><th>Username</th><td><input type="text" name="user" /></td></tr>
	<tr><th>Password</th><td><input type="password" name="pass" /></td></tr>
	<tr>
		<th><?= $label; ?></th>
		<td><?= $image; ?><input type="text" name="captcha" /></td>
	</tr>
	<tr><th>&nbsp;</th><td><input type="submit" name="login" value="Login" /><input type="submit" name="logout" value="Logout" /></td></tr>
	<tr><th>Secret Info</th><td><?php if ($loggedIn) echo $info; ?></td></tr>
	<tr><th>&nbsp;</th><td><?= $message ?? ''; ?></td></tr>
	</table>
	</form>
	</div>
</div>

</body>
</html>

