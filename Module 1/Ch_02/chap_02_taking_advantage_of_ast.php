<?php
// taking advantage of AST
// you need to run this using PHP 7

define('TEXT_DIR', '/../../data/languages/%s/%s.txt');
define('WIKI_PREFIX', 'https://upload.wikimedia.org/wikipedia/commons/thumb');

$cities = [
    'amsterdam' => '/e/e6/RijksmuseumAmsterdamMuseumplein2.50%2C1.jpg/800px-RijksmuseumAmsterdamMuseumplein2.50%2C1.jpg',
    'bangkok'   => '/3/3e/Aerial_view_of_Lumphini_Park.jpg/1024px-Aerial_view_of_Lumphini_Park.jpg',
    'san_francisco' => 'thumb/c/c2/Golden_Gate_Bridge%2C_SF_%28cropped%29.jpg/1024px-Golden_Gate_Bridge%2C_SF_%28cropped%29.jpg'
];

// NOTE: using Unicode Escape Point Syntax to position cedilla and tilda
$languages = [
    'de' => 'Deutsch',
    'en' => 'English',
    'es' => "Espan\u{0303}ol",
    'fr' => "Franc\u{0327}ais"
];

// define callbacks
$name   = function ($key)        { return ucwords(str_replace('_', ' ', $key)); };
$image  = function ($image)      { return WIKI_PREFIX . $image; };
$text   = function ($lang, $key) { return file_get_contents(sprintf(__DIR__ . TEXT_DIR, $lang, $key)); };
$wrap   = function ($tag, $item) { return sprintf('<%s>%s</%s>', $tag, $item, $tag); };
$select = function ($name, $list, $callback = NULL) { 
                    $output = sprintf('<select name="%s">', $name); 
                    foreach($list as $key => $value) {
                        $key   = (ctype_digit($key)) ? $value : $key;
                        $value = ($callback) ? $callback($value) : $value;
                        $output .= sprintf('<li><option value="%s">%s</option></li>', $key, $value); 
                    }
                    $output .= '</select>';
                    return $output;
                };

// get $_POST vals
$lang = $_POST['lang'] ?? 'en';
$city = $_POST['city'] ?? 'bangkok';

// sanitize
$lang = (isset($languages[$lang])) ? $lang : 'en';
$city = (isset($cities[$city]))    ? $city : 'bangkok';
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<form method="post">
    <!-- Language SELECT -->
    <?php echo $select('lang', $languages); ?>
    <!-- Cities SELECT -->
    <?php echo $select('city', array_keys($cities), $name); ?>
    <input type="submit" />
</form>	
<hr>
<?php echo $wrap('h1', $name($city)); ?>
<hr>
<table>
    <tr>
    <td valign="top"><?php printf('<img width=200 src="%s" />', $image($cities[$city])); ?></td>
    <td style="width: 20px;">&nbsp;</td>
    <td valign="top"><?php echo $wrap('p',  $text($lang, $city));?></td>
    </tr>
</table>
<hr>
From wikipedia.org
</body>
</html>
