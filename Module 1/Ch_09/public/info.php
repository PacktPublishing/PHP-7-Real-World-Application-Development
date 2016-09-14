<?php $x = json_encode(file_get_contents('php://input')); ?>
<!DOCTYPE html>
<head>
	<title>untitled</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.23.1" />
</head>

<body>
<pre>
<?php var_dump($x); ?>
<?php phpinfo(INFO_VARIABLES); ?>
</pre>
</body>

</html>


