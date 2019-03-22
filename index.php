<?php
include_once('./.src/app.php');

$app = new App();

// error_log(print_r($app->list(), 1));

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $app->path(); ?></title>
    </head>
<body>

<h3><?php echo $app->path(); ?></h3>
<ul>
<?php
foreach ($app->list() as $item) {
    if ($item->type == 'd') {
        ?>
    <li type="circle">
        <a href="<?php echo $item->href; ?>" bookdate="<?php echo $item->modifiedAt; ?>">
            <?php echo $item->href; ?>
        </a>
    </li>
        <?php
    } else {
        ?>
    <li>
        <a href="<?php echo $item->href; ?>" booktitle="<?php echo $item->name; ?>" booksize="<?php echo $item->filesize; ?>" bookdate="<?php echo $item->modifiedAt; ?>" bookfile="true">
            <?php echo $item->href; ?>
        </a>
    </li>
        <?php
    }
}
?>
</ul>

</body>
</html>
<?php
