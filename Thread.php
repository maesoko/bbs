<?php
require_once(dirname(__FILE__) . '/src/view/ThreadView.php');

if (isset($_GET['thread-id'])) {
    $threadId = $_GET['thread-id'];
    $threadView = new ThreadView($threadId);
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?php echo $threadView->getThread()->getTitle()?></title>

    <link rel="stylesheet" href="css/common.css">
</head>
<body>
<div class="box-container">
    <div class="box"><a href="index.php">■スレッド一覧へ</a></div>
    <div class="box"><a href="#">＜＜前の10件</a></div>
    <div class="box"><a href="#">次の10件＞＞</a></div>
</div>
<hr />
<h1 id="thread-title"><?php echo $threadView->getThread()->getTitle()?></h1>

<div id="bbs-response">
    <?php
    $responseList = $threadView->getResponseList();
    foreach ((array)$responseList as $response) {

        ?>
        <div class="box-container">
            <div class="box"><?php echo $response->getCommentNumber() ?>:</div>
            <div class="box"><?php echo $response->getName() ?>:</div>
            <div class="box"><?php echo $response->getWriteDate() ?></div>
        </div>

        <p class="comment"><?php echo $response->getComment() ?></p>

        <?php
    }
    ?>
</div>

</body>
</html>
