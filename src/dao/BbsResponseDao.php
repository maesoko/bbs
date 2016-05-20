<?php
require_once(dirname(__FILE__) . './../model/BbsResponse.php');

class BbsResponseDao extends BaseDao {

    /**
     * レスポンステーブルにレスポンスを追加する
     * @param BbsResponse $response 追加するレスポンスの情報が入ったBbsResponseオブジェクト
     * @return BbsResponse 追加した結果レコード情報が入ったBbsResponseオブジェクトを返す。
     */
    public function insertResponse(BbsResponse $response) {
        $sql = "INSERT INTO response (thread_id, comment_number, comment, name, mail_address)
                VALUES (:thread_id, :comment_number, :comment, :name, :mail_address)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':thread_id', $response->getThreadId());
        $stmt->bindParam(':comment_number', $response->getCommentNumber());
        $stmt->bindParam(':comment', $response->getComment());
        $stmt->bindParam(':name', $response->getName());
        $stmt->bindParam(':mail_address', $response->getMailAddress());
        $stmt->execute();

        return $this->getResponseById($this->pdo->lastInsertId());
    }

    /**
     * $idで指定されたレスポンスを取得する。
     * @param $id int 取得したいレスポンスのID
     * @return BbsResponse BbsResponseオブジェクトを返す。
     */
    public function getResponseById($id) {
        $sql = "SELECT * FROM response WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        return $stmt->fetchObject('BbsResponse');
    }

    /**
     * スレッドのレスポンス一覧を取得する
     * @param $threadId int 取得するスレッドのID
     * @return array|false BbsResponseオブジェクトの配列を返す。|レスポンスの取得に失敗した場合はfalseを返す。
     */
    public function getAllResponseByThreadId($threadId) {
        $sql = "SELECT * FROM response WHERE thread_id = :threadId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':threadId', $threadId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, "BbsResponse");
    }

    /**
     * スレッドのレスポンスを開始位置$offsetから$limit件数分取得する
     * @param $threadId int 対象のスレッドID
     * @param $limit int 表示件数
     * @param $offset int 取得開始位置
     * @return array|false BbsResponseオブジェクトの配列を返す。|レスポンスの取得に失敗した場合はfalseを返す。
     */
    public function getResponseInLimit($threadId, $limit, $offset) {
        $sql = "SELECT * FROM response WHERE thread_id = :threadId
                LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':threadId', $threadId, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, "BbsResponse");
    }

    /**
     * @param $threadId int 取得する対象スレッドのID
     * @return int 対象スレッドの総レス数を返す
     */
    public function getMaxRowCountByThreadId($threadId) {
        $sql = 'SELECT * FROM response WHERE thread_id = :threadId';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':threadId', $threadId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount();
    }
}