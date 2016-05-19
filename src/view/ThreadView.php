<?php
require_once(dirname(__FILE__) . './../dao/BbsThreadDao.php');
require_once(dirname(__FILE__) . './../dao/BbsResponseDao.php');
require_once(dirname(__FILE__) . './../model/BbsResponse.php');
require_once('BaseView.php');

class ThreadView extends BaseView {
    private $threadDao;
    private $responseDao;

    private $thread;

    const LIMIT_DISPLAY_SIZE = 10;

    /**
     * ThreadView constructor.
     * @param $threadId int $_GET['thread-id']から取得したスレッドID
     */
    public function __construct($threadId) {
        $this->threadDao = new BbsThreadDao();
        $this->responseDao = new BbsResponseDao();
        
        $this->thread = $this->threadDao->getThreadById($threadId);
    }

    /**
     * @return BbsThread スレッドの情報が入ったBbsThreadオブジェクトを返す
     */
    public function getThread() {
        return $this->thread;
    }

    /**
     * 定数(LIMIT_DISPLAY_SIZE)に設定した件数分のレスポンスリストを取得する
     * @return array|null スレッドのレスポンスリストを返す
     */
    public function getResponseList() {
        $offset = self::getLimitDisplaySize() * ($this->getCurrentPageNumber() - 1);
        $threadId = self::getThread()->getId();
        return $this->responseDao->getResponseInLimit($threadId, $this->getLimitDisplaySize(), $offset);
    }

    /**
     * スレッドへの書き込みを行う
     * @param array $params $_POSTから取得したレスの情報
     */
    public function postResponse(array $params) {
        $commentNumber = count(self::getResponseList()) + 1;

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

    /**
     * 総レコード数を取得する
     * @return int Viewで表示している件数ではなく、テーブルに保存されている総レコード数。int型にキャストして返却。
     */
    protected function getMaxRowCount() {
        return (int) $this->responseDao->getMaxRowCountByThreadId($this->getThread()->getId());
    }

    /**
     * スレッドやレスポンスの最大表示数を取得する。
     * @return int スレッドやレスポンスの最大表示数を返す。返却時はint型にキャストする。
     */
    public function getLimitDisplaySize() {
        return (int) self::LIMIT_DISPLAY_SIZE;
    }
}
