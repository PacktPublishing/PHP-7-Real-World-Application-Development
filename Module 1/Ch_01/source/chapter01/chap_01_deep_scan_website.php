<?php
// deep scan of a website

// setup class autoloading
require __DIR__ . '/../../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/../..');

// get "deep scan" class
$deep = new Application\Web\Deep();

// modify as needed
define('DEFAULT_URL', 'oreilly.com');
define('DEFAULT_TAG', 'img');

// get URL and tag to search
// NOTE: the PHP 7 null coalesce operator is used
//       doesn't matter of the param is missing or not: no notices are generated
$url = strip_tags($_GET['url'] ?? DEFAULT_URL);
$tag = strip_tags($_GET['tag'] ?? DEFAULT_TAG);
?>
<!DOCTYPE html>
<head>
	<title>Deep Web Scan</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>

<?php
// displays all *.png and *.jpg images from O'Reilly website
foreach ($deep->scan($url, $tag) as $item) {
    $src = $item['attributes']['src'] ?? NULL;
    if ($src && (stripos($src, 'png') || stripos($src, 'jpg'))) {
        printf('<br><img src="%s"/>', $src);
    }
}
?>
	
</body>
</html>
