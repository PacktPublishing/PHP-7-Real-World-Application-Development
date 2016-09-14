<?php
// uniform way of representing unicode in a string
// {} allows for variable # characters
// only works for double quoted strings or HEREDOC
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<pre>
<?php
// reversed text
echo "\u{202E}Reversed text"; // outputs ‮Reversed text
//echo "\u{202D}"; // stops reverse
echo PHP_EOL;

echo "mañana";	// using pre-composed characters
echo PHP_EOL;

// However, by using an escape sequence to produce the ñ, it becomes clearer: 
echo "ma\u{00F1}ana"; // pre-composed character
echo PHP_EOL;
echo "man\u{0303}ana"; // "n" with combining ~ character (U+0303)
echo PHP_EOL;

// élève
echo "élève";
echo PHP_EOL;
echo "\u{00E9}l\u{00E8}ve";	// pre-composed characters
echo PHP_EOL;
echo "e\u{0301}le\u{0300}ve"; // e + combining characters
echo PHP_EOL;
?>
</pre>
</body>
</html>
	
