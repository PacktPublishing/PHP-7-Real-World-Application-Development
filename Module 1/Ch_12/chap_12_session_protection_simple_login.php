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
	<h1>Session Protection</h1>
	Welcome: <?= $loggedUser; ?>
	<table>
	<tr><th>Username</th><td><input type="text" name="username" /></td></tr>
	<tr><th>Password</th><td><input type="password" name="password" /></td></tr>
	<tr><th>&nbsp;</th>
		<td>
			<input type="submit" name="login" value="Login" />
			<input type="submit" name="logout" value="Logout" />
			<input type="submit" name="refresh" value="Refresh" />
		</td>
	</tr>
	<tr><th>$_COOKIE</th><td><pre><?php var_dump($_COOKIE); ?></pre></td></tr>
	<tr><th>$_SESSION</th><td><pre><?php var_dump($_SESSION); ?></pre></td></tr>
	<tr><th>Secret Info</th><td><?php if ($loggedIn) echo $info; ?></td></tr>
	</table>
	</form>
	</div>
	<?php //phpinfo(INFO_VARIABLES); ?>
</div>

</body>
</html>

