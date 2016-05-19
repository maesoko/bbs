<?php
require_once('BbsThread.php');

class BbsThreadList extends BbsThread {
    private $comments;

    /**
     * BbsThreadList constructor.
     * PDOStatement::fetchAll(PDO::FETCH_CLASS, 'class_name'), PDOStatement::fetchObject('class_name')のO/Rマッピングに
     * 対応するためコンストラクタのパラメータは無しにした。
     */
    public function __construct() {}

    /**
     * @return int レスの数を返す。
     */
    public function getComments() {
        return $this->comments;
    }

}