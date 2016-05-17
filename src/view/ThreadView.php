<?php
require_once(dirname(__FILE__) . './../dao/BbsThreadDao.php');

class ThreadView {
    private $thread;
    private $threadDao;

    /**
     * ThreadView constructor.
     * @param $threadId int $_GET['thread-id']から取得したスレッドID
     */
    public function __construct($threadId) {
        $this->threadDao = new BbsThreadDao();
        $this->thread = $this->threadDao->getThreadById($threadId);
    }

    /**
     * @return BbsThread スレッドの情報が入ったBbsThreadオブジェクトを返す
     */
    public function getThread() {
        return $this->thread;
    }

}