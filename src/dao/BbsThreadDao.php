<?php
require_once('BaseDao.php');
require_once(dirname(__FILE__) . './../model/BbsThreadList.php');
require_once(dirname(__FILE__) . './../model/BbsResponse.php');
require_once(dirname(__FILE__) . './../model/BbsThread.php');
require_once(dirname(__FILE__) . './../dao/BbsResponseDao.php');

class BbsThreadDao extends BaseDao {

    /**
     * スレッドの一覧を取得する。
     * @return array|null スレッド一覧の情報が入ったBbsThreadListクラスの配列を返す。スレッドが存在しない場合はnullを返す。
     */
    public function getAllThreads() {
        // (スレッドID, スレッドタイトル, レス数, 作成日)を取得するSQL
        $sql = 'SELECT t.id, t.title, COUNT(r.thread_id) "comments", t.creation_date
                FROM thread t LEFT JOIN response r
                ON t.id = r.thread_id
                GROUP BY t.id;';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $result = null;
        $records = $stmt->fetchAll();
        foreach ($records as $record) {
            $result[] = new BbsThreadList(
                $record["id"],
                $record["title"],
                $record["creation_date"],
                $record["comments"]
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
        $sql = "INSERT INTO thread (title)
                VALUES ('{$title}');";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        
        return $this->pdo->lastInsertId();
    }

    /**
     * $paramsに渡された情報を元にスレッドを新規作成し、そのスレッドに1番目のレスを追加
     * @param $params array スレッドタイトルとレスの値が入った配列
     * @return BbsResponse 追加した１番目のレスの情報が入ったBbsResponseオブジェクトを返す。
     */
    public function createThread($params) {
        $threadId = self::insertThreadByTitle($params['title']);
        $response = new BbsResponse(
            null, $threadId, 1, $params['comment'], $params['name'], $params['mail_address'], null);

        $responseDao = new BbsResponseDao();
        return $responseDao->insertResponse($response);
    }

    /**
     * @param $id int 取得したいスレッドのID
     * @return BbsThread スレッドの情報が入ったBbsThreadクラスのインスタントを返す
     */
    public function getThreadById($id) {
        $sql = "SELECT * FROM thread WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return new BbsThread($record['id'], $record['title'], $record['creation_date']);
    }
}
