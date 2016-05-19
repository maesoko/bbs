<?php
require_once(dirname(__FILE__) . '/src/view/CreateThreadView.php');
$createThreadView = new CreateThreadView($_POST);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>JUPIT BBS</title>

    <link rel="stylesheet" href="css/common.css">
</head>
<body>

<p><?php echo $createThreadView->showResult() ?></p>

<div class="box-container">
    <div class="box"><p id="bbs-back"><a href="index.php">■掲示板に戻る■</a></p></div>
    <div class="box">
        <p class="page">
            <a href="Thread.php?thread-id=<?php echo $createThreadView->getThread()->getId() ?>">スレッドへ移動</a>
        </p>
    </div>
</div>
</body>
</html>
