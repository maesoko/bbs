<?php
require_once('BbsThread.php');

class BbsThreadList extends BbsThread {
    private $comments;

    /**
     * BbsThread constructor.
     * @param $id int スレッドID
     * @param $title string スレッドのタイトル
     * @param $creationDate string スレッドの作成日(yyyy-MM-dd)
     * @param $comments int スレッドのレスの数
     */
    public function __construct($id, $title, $creationDate, $comments) {
        parent::__construct($id, $title, $creationDate);
        $this->comments = $comments;
    }

    /**
     * @return int レスの数を返す。
     */
    public function getComments() {
        return $this->comments;
    }

}