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
     * @return BbsResponse レスポンスの情報が入ったBbsResponseオブジェクトを返す。
     */
    public function getResponseById($id) {
        $sql = "SELECT * FROM response WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return new BbsResponse(
            $record['id'], $record['thread_id'], $record['comment_number'], $record['comment'],
            $record['name'], $record['mail_address'], $record['write_date']);
    }

    /**
     * スレッドのレスポンス一覧を取得する
     * @param $threadId int 取得するスレッドのID
     * @return array|null レスポンスの情報が入った配列を返す。|レスポンスが存在しない場合はnullを返す。
     */
    public function getAllResponseByThreadId($threadId) {
        $sql = "SELECT * FROM response WHERE thread_id = :threadId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':threadId', $threadId, PDO::PARAM_INT);
        $stmt->execute();

        $results = null;
        $records = $stmt->fetchAll();
        foreach ($records as $record) {
            $results[] = new BbsResponse($record['id'], $record['thread_id'], 
                $record['comment_number'], $record['comment'],
                $record['name'], $record['mail_address'], $record['write_date']);
        }
        
        return $results;
    }
}