<?php
require_once('BaseDao.php');
require_once(dirname(__FILE__) . './../model/BbsThread.php');

class BbsThreadDao extends BaseDao {

    /**
     * スレッドの一覧を取得する。
     * @return array|null スレッド一覧の情報が入ったBbsThreadクラスの配列を返す。スレッドが存在しない場合はnullを返す。
     */
    public function getAllThreads() {
        // (スレッドID, スレッドタイトル, レス数, 作成日)を取得するSQL
        $sql = 'SELECT t.id, t.title, COUNT(r.thread_id) "comments", t.creation_date ';
        $sql .= 'FROM thread t LEFT JOIN response r ';
        $sql .= 'ON t.id = r.thread_id ';
        $sql .= 'GROUP BY t.id;';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $result = null;
        $records = $stmt->fetchAll();
        foreach ($records as $record) {
            $result[] = new BbsThread(
                $record["id"],
                $record["title"],
                $record["comments"],
                $record["creation_date"]
            );
        }

        return $result;
    }

    /**
     * $titleで指定されたタイトル名でスレッドを新規作成する
     * @param $title string 新規作成するスレッドのタイトル
     * @return mixed 追加したレコードのIDを返す
     */
    public function insertThreadByTitle($title) {
        $sql = "INSERT INTO thread (title) ";
        $sql .= "VALUES ('{$title}');";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        
        return $this->pdo->lastInsertId();
    }
}
