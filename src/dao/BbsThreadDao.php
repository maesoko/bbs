<?php
require_once('BaseDao.php');
require_once(dirname(__FILE__) . './../model/BbsThread.php');

class BbsThreadDao extends BaseDao {

    /**
     * @return array|null スレッド一覧の情報が入った配列を返す。スレッドが存在しない場合はnullを返す。
     */
    public function getAllThreads() {
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
}
