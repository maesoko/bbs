<?php
require_once('BaseView.php');
require_once(dirname(__FILE__) . './../dao/BbsThreadDao.php');
require_once(dirname(__FILE__) . './../dao/BbsResponseDao.php');

class CreateThreadView {
    private $threadDao;
    private $responseDao;

    private $thread;
    private $response;

    /**
     * CreateThreadView constructor.
     * @param $params array $_POSTから取得できるスレッドとレスポンスの情報が入った配列
     */
    public function __construct($params) {
        $this->threadDao = new BbsThreadDao();
        $this->responseDao = new BbsResponseDao();

        self::createThread($params);
    }

    /**
     * @return string スレッドの作成結果を文字列で返す。
     */
    public function showResult() {
        $result = "▼▼▼ 以下の内容でスレッドを作成しました ▼▼▼ <br />";
        $result .= "タイトル => " . self::getThread()->getTitle() . "<br />";
        $result .= "名前 => " . self::getResponse()->getName() . "<br />";
        $result .= "E-mail => " . self::getResponse()->getMailAddress() . "<br />";
        $result .= "本文 => " . self::getResponse()->getComment() . "<br />";

        return $result;
    }

    /**
     * $paramsに渡された情報を元にスレッドを新規作成し、そのスレッドに1番目のレスを追加
     * @param $params array スレッドタイトルとレスの値が入った配列
     */
    public function createThread($params) {
        $this->thread = $this->threadDao->insertThreadByTitle($params['title']);

        $response = new BbsResponse(
            null, $this->thread->getId(), 1, $params['comment'], $params['name'], $params['mail_address'], null);
        $this->response = $this->responseDao->insertResponse($response);
    }

    /**
     * @return BbsThread
     */
    public function getThread() {
        return $this->thread;
    }

    /**
     * @return BbsResponse
     */
    public function getResponse() {
        return $this->response;
    }



}