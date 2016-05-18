<?php
require_once(dirname(__FILE__) . './../dao/BbsThreadDao.php');
require_once(dirname(__FILE__) . './../dao/BbsResponseDao.php');
require_once(dirname(__FILE__) . './../model/BbsResponse.php');

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

    /**
     * スレッドへの書き込みを行う
     * @param array $params $_POSTから取得したレスの情報
     */
    public function postResponse(array $params) {
        $commentNumber = count(self::getResponseList());

        $response = new BbsResponse(
            null,
            self::getThread()->getId(),
            $commentNumber,
            $params['comment'],
            $params['name'],
            $params['mail_address'],
            null
        );

        $this->responseDao->insertResponse($response);
    }

}
