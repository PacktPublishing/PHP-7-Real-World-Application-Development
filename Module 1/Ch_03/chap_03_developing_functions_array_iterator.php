<?php
// developing functions -- using iterators

// it's a best practice to place all functions definitions 
// in a separate file which is then included
include (__DIR__ . DIRECTORY_SEPARATOR . 'chap_03_developing_functions_iterators_library.php');


?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
    <?= arrayToHtml(monthsAsArray()); ?>
</body>
</html>

