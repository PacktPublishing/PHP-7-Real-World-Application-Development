<?php
// understanding differences in syntax
// you need to run this using PHP 7

/*
                        // old meaning            // new meaning
$$foo['bar']['baz']     ${$foo['bar']['baz']}     ($$foo)['bar']['baz']
$foo->$bar['baz']       $foo->{$bar['baz']}       ($foo->$bar)['baz']
$foo->$bar['bat']()     $foo->{$bar['bat']}()     ($foo->$bar)['bat']()
*/

$types  = ['users', 'admins'];
$users  = ['Alice', 'Ralph', 'Thelma', 'Ed'];
$admins = ['Tommy', 'McGarrity', 'Judy'];
$select = function ($name, $list) {
    $output = '<select name="' . $name . '">';
    foreach ($list as $item) 
        $output .= '<option value="' . $item . '">' . ucfirst($item) . '</option>';
    $output .= '</select>';
    return $output;
};
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<form>
    <?= $select('type', $types); ?>
    <input type="submit" />
</form>
<?php if (isset($_GET['type']) && in_array($_GET['type'], $types)) : ?>
    <?php $type = $_GET['type']; ?>
    <hr>
    <h3>Current <?= ucfirst($type) ?></h3>
    <hr>
    <ul><li>
    <?= implode('<li>', $$type) ?>
    </ul>
<?php endif; ?>
</body>
</html>
