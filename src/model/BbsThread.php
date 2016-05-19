<?php

class BbsThread {
    private $id;
    private $title;
    private $creationDate;

    /**
     * BbsThread constructor.
     * @param $id int スレッドID
     * @param $title string スレッドのタイトル
     * @param $creationDate string スレッドの作成日(yyyy-MM-dd)
     */
    public function __construct($id, $title, $creationDate) {
        $this->id = $id;
        $this->title = $title;
        $this->creationDate = $creationDate;
    }

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
        return $this->creationDate;
    }

}