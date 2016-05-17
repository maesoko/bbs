<?php

class BbsResponse {
    private $id;
    private $threadId;
    private $commentNumber;
    private $comment;
    private $name;
    private $mailAddress;
    private $writeDate;

    /**
     * BbsResponse constructor.
     * @param $id int|null
     * @param $threadId int
     * @param $commentNumber int
     * @param $comment string
     * @param $name string|null
     * @param $mailAddress string|null
     * @param $writeDate string|null
     */
    public function __construct($id, $threadId, $commentNumber, $comment, $name, $mailAddress, $writeDate) {
        $this->id = $id;
        $this->threadId = $threadId;
        $this->commentNumber = $commentNumber;
        $this->comment = $comment;
        $this->name = $name;
        $this->mailAddress = $mailAddress;
        $this->writeDate = $writeDate;
    }

    /**
     * @return int|null
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getThreadId() {
        return $this->threadId;
    }

    /**
     * @return int
     */
    public function getCommentNumber() {
        return $this->commentNumber;
    }

    /**
     * @return string
     */
    public function getComment() {
        return $this->comment;
    }

    /**
     * @return null|string
     */
    public function getName() {
        //TODO: 値がnullの場合はデフォルト値を返すようにする
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getMailAddress() {
        //TODO: 値がnullの場合はデフォルト値を返すようにする
        return $this->mailAddress;
    }

    /**
     * @return null|string
     */
    public function getWriteDate() {
        return $this->writeDate;
    }

}