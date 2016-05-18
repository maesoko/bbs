<?php
require_once(dirname(__FILE__) . './../dao/BbsThreadDao.php');
require_once('BaseView.php');

class ThreadListView extends BaseView {
    private $threadDao;

    /**
     * ThreadListView constructor.
     */
    public function __construct() {
        $this->threadDao = new BbsThreadDao();
    }

    /**
     * @return string スレッド一覧の情報を<tr>,<td>タグで囲んだ文字列で返す。スレッドが存在しない場合は空文字を返す。
     */
    public function showThreadList() {
        $result = "";
        $threadList = $this->threadDao->getAllThreads();
        foreach ((array)$threadList as $thread) {
            $result .= self::convertThreadIntoHtml($thread);
        }

        return $result;
    }

    /**
     * タイトルの項目には<a>タグでスレッドIDをスレッド表示画面に渡している。
     * @param $thread BbsThreadList スレッド情報が入ったBbsThreadListオブジェクト
     * @return string スレッドの情報を<tr>,<td>タグで囲んだ文字列で返す。
     */
    private function convertThreadIntoHtml($thread) {
        $threadRow = "
                <tr>
                <td>{$thread->getId()}</td>
                <td><a href='Thread.php?thread-id={$thread->getId()}'>{$thread->getTitle()}</a></td>
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
}
