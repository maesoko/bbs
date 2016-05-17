<?php

class BbsThreadList {
    private $id;
    private $title;
    private $comments;
    private $creationDate;

    /**
     * BbsThread constructor.
     * @param $id int スレッドID
     * @param $title string スレッドのタイトル
     * @param $comments int スレッドのレスの数
     * @param $creationDate string スレッドの作成日(yyyy-MM-dd)
     */
    public function __construct($id, $title, $comments, $creationDate) {
        $this->id = $id;
        $this->title = $title;
        $this->comments = $comments;
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
     * @return int レスの数を返す。
     */
    public function getComments() {
        return $this->comments;
    }

    /**
     * @return string スレッドの作成日を'yyyy-MM-dd'形式の文字列で返す。
     */
    public function getCreationDate() {
        return $this->creationDate;
    }

}