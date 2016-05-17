<?php
require_once('BaseView.php');
require_once(dirname(__FILE__) . './../dao/BbsThreadDao.php');

class ThreadListView extends BaseView {

    /**
     * ThreadListView constructor.
     */
    public function __construct() {
        parent::__construct(new BbsThreadDao());
    }

    /**
     * @return string スレッド一覧の情報を<tr>,<td>タグで囲んだ文字列で返す。スレッドが存在しない場合は空文字を返す。
     */
    public function showThreadList() {
        $result = "";
        $threadList = $this->dao->getAllThreads();
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
}
