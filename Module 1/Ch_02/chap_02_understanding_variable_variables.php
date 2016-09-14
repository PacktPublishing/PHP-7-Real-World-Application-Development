<?php
// understanding variable variables
$types  = ['users', 'admins'];
$users  = ['Alice', 'Ralph', 'Thelma', 'Ed'];
$admins = ['Tommy', 'McGarrity', 'Judy'];
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<form>
    <select name="<?= $name ?>">
    <?php foreach ($list as $item) : ?>
        <option value="<?= $item ?>"><?= ucfirst($item) ?></option>
    <?php endforeach; ?>
    </select>
    <input type="submit" />
</form>
<?php if (isset($_GET['type']) && in_array($_GET['type'], $types)) : ?>
    <?php $type = $_GET['type']; ?>
    <hr>
    <h3>Current <?= ucfirst($type) ?></h3>
    <hr>
    <ul>
        <!-- $$type is a variable variable which can be either $users or $admins -->
        <li><?= implode('</li><li>', $$type) ?></li>
    </ul>
<?php endif; ?>
</body>
</html>
