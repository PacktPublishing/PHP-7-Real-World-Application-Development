<?php
define('TARGET_DIR', __DIR__ . '/uploads');

// setup class autoloading
require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// classes to use
use Application\MiddleWare\ { Constants, UploadedFile };

try {
    $message = '';
    $uploadedFiles = array();
    if (isset($_FILES)) {
        foreach ($_FILES as $key => $info) {
            if ($info['tmp_name']) {
                $uploadedFiles[$key] = new UploadedFile($key, $info, TRUE);
                $uploadedFiles[$key]->moveTo(TARGET_DIR);
            }
        }
    }
} catch (Throwable $e) {
    $message =  $e->getMessage();
}
?>
<!DOCTYPE html>
<head>
	<title>PHP 7 Cookbook</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="php7cookbook.css">
</head>
<body>

<div class="container">
	<h1>Search</h1>
    <form name="search" method="post" enctype="<?= Constants::CONTENT_TYPE_MULTI_FORM ?>">
    <table class="display" cellspacing="0" width="100%">
        <tr><th>Upload 1</th><td><input type="file" name="upload_1" /></td></tr>
        <tr><th>Upload 2</th><td><input type="file" name="upload_2" /></td></tr>
        <tr><th>Upload 3</th><td><input type="file" name="upload_3" /></td></tr>
        <tr><th>&nbsp;</th><td><input type="submit" /></td></tr>
    </table>
    </form>
    <?= ($message) ? '<h1>' . $message . '</h1>' : ''; ?>
    <?php if ($uploadedFiles) : ?>
	<table class="display" cellspacing="0" width="100%">
        <tr>
            <th>Filename</th>
            <th>Size</th>
            <th>Moved Filename</th>
            <th>Text</th>
        </tr>
        <?php foreach ($uploadedFiles as $obj) : ?>
            <?php if ($obj->getMovedName()) : ?>
            <tr>
                <td><?= htmlspecialchars($obj->getClientFilename()) ?></td>
                <td><?= $obj->getSize() ?></td>
                <td><?= $obj->getMovedName() ?></td>
                <td><?= $obj->getStream()->getContents() ?></td>
            </tr>
            <?php endif; ?>
        <?php endforeach; ?>
	</table>
    <?php endif; ?>
    <?php phpinfo(INFO_VARIABLES); ?>
</div>
</body>
</html>
