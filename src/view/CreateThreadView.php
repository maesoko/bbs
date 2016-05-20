<?php
require_once(dirname(__FILE__) . './../dao/BbsThreadDao.php');
require_once(dirname(__FILE__) . './../dao/BbsResponseDao.php');

class CreateThreadView {
    private $threadDao;
    private $responseDao;

    private $thread;
    private $response;

    /**
     * CreateThreadView constructor.
     * @param $params array スレッド作成フォームの入力値が入った配列
     */
    public function __construct($params) {
        $this->threadDao = new BbsThreadDao();
        $this->responseDao = new BbsResponseDao();

        $this->thread = $this->createThread($params['title']);
        $this->response = $this->createResponse(
            $this->thread,
            $params['comment'],
            $params['name'],
            $params['mail_address']);
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
     * $titleでスレッドを新規作成
     * @param $title string スレッドタイトル
     * @return BbsThread 作成されたスレッドをBbsThreadオブジェクトとして返す。
     */
    private function createThread($title) {
        return $this->threadDao->insertThreadByTitle($title);
    }

    /**
     * 対象のスレッドに一番目の書き込みを投稿する
     * @param $thread BbsThread 書き込みを投稿するスレッド
     * @param $comment string 書き込む内容
     * @param $name string 投稿者名
     * @param $mailAddress string Eメールアドレス
     * @return BbsResponse 投稿したレスポンスをBbsResponseオブジェクトとして返す。
     */
    private function createResponse($thread, $comment, $name, $mailAddress) {
        $commentNumber = 1;
        $response = BbsResponse::newInstance(
            $thread->getId(),
            $commentNumber,
            $comment,
            $name,
            $mailAddress);

        return $this->responseDao->insertResponse($response);
    }

    /**
     * @return BbsThread 新規作成したスレッド
     */
    public function getThread() {
        return $this->thread;
    }

    /**
     * @return BbsResponse >>1に投稿されたレスポンス
     */
    public function getResponse() {
        return $this->response;
    }

}