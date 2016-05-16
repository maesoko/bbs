<?php
require_once(dirname(__FILE__) . '/src/view/CreateThreadView.php');
$createThreadView = new CreateThreadView();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>JUPIT BBS</title>

    <link rel="stylesheet" href="css/common.css">
</head>
<body>

<p><?php echo $createThreadView->createThread($_POST) ?></p>

<a href="index.php">スレッド一覧に戻る</a>
</body>
</html>
