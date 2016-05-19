<?php

class BbsThread {
    protected $id;
    protected $title;
    protected $creation_date;

    /**
     * BbsThread constructor.
     * O/Rマッピングに対応するためコンストラクタにはパラメータ設定しないように。
     */
    public function __construct() {}

    /**
     * @return int スレッドIDを返す。
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string スレッドのタイトルを返す。
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @return string スレッドの作成日を'yyyy-MM-dd'形式の文字列で返す。
     */
    public function getCreationDate() {
        return $this->creation_date;
    }

}