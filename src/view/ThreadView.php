<?php
require_once(dirname(__FILE__) . './../dao/BbsThreadDao.php');
require_once(dirname(__FILE__) . './../dao/BbsResponseDao.php');

class ThreadView {
    private $threadDao;
    private $responseDao;

    private $thread;
    private $responseList;

    /**
     * ThreadView constructor.
     * @param $threadId int $_GET['thread-id']から取得したスレッドID
     */
    public function __construct($threadId) {
        $this->threadDao = new BbsThreadDao();
        $this->responseDao = new BbsResponseDao();
        
        $this->thread = $this->threadDao->getThreadById($threadId);
        $this->responseList = $this->responseDao->getAllResponseByThreadId($threadId);
    }

    /**
     * @return BbsThread スレッドの情報が入ったBbsThreadオブジェクトを返す
     */
    public function getThread() {
        return $this->thread;
    }

    /**
     * @return array|null スレッドのレスポンスリストを返す
     */
    public function getResponseList() {
        return $this->responseList;
    }

    
}