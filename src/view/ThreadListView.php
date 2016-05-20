<?php
require_once(dirname(__FILE__) . './../dao/BbsThreadDao.php');
require_once('BaseView.php');

class ThreadListView extends BaseView {
    private $threadDao;
    
    const LIMIT_DISPLAY_SIZE = 10;
    
    /**
     * ThreadListView constructor.
     */
    public function __construct() {
        $this->threadDao = new BbsThreadDao();
    }

    /**
     * 定数:LIMIT_DISPLAY_SIZEで設定した件数分のスレッド一覧を取得する
     * @return string スレッド一覧の情報を<tr>,<td>タグで囲んだ文字列で返す。スレッドが存在しない場合は空文字を返す。
     */
    public function showThreadList() {
        $result = "";
        $offset = self::getLimitDisplaySize() * ($this->getCurrentPageNumber() - 1);
        $threadList = $this->threadDao->getThreadInLimit(self::getLimitDisplaySize(), $offset);

        foreach ((array)$threadList as $thread) {
            $result .= self::convertThreadIntoHtml($thread);
        }

        return $result;
    }

    /**
     * スレッドの情報をタグで囲んだ文字列に変換する
     * <a>タグではスレッドIDをスレッド表示画面にGETで渡している。
     * @param $thread BbsThreadList スレッド情報が入ったBbsThreadListオブジェクト
     * @return string スレッドの情報を<tr>,<td>タグで囲んだ文字列で返す。
     */
    private function convertThreadIntoHtml($thread) {
        $threadRow = "
                <tr>
                <td>{$thread->getId()}</td>
                <td>{$this->getAnchorTagToThread($thread->getId(), $thread->getTitle())}</td>
                <td>{$thread->getComments()}</td>
                <td>{$thread->getCreationDate()}</td>
                </tr>
                " . PHP_EOL;

        return $threadRow;
    }

    /**
     * 総レコード数を取得する
     * @return int Viewで表示している件数ではなく、テーブルに保存されている総レコード数。int型にキャストして返却。
     */
    protected function getMaxRowCount() {
        return (int) $this->threadDao->getMaxRowCount();
    }

    /**
     * スレッド一覧の最大表示数を取得する
     * @return int スレッドやレスポンスの最大表示数を返す。返却時はint型にキャストする。
     */
    public function getLimitDisplaySize() {
        return (int) self::LIMIT_DISPLAY_SIZE;
    }

    /**
     * スレッドページへのアンカータグを取得する
     * @param int $threadId スレッドのID,GETでスレッド表示画面へ渡す
     * @param string $title リンクに表示するスレッドタイトル
     * @return string アンカータグを文字列で返す
     */
    protected function getAnchorTagToThread($threadId, $title) {
        //TODO:BaseView::getAnchorTagToPageと同じような処理を書いてるので、共通化できるように工夫するべき。
        return "<a href='Thread.php?thread-id={$threadId}'>{$title}</a>";
    }

}
