<?php
require_once(dirname(__FILE__) . './../model/BbsResponse.php');

class BbsResponseDao extends BaseDao {

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

    public function getResponseById($id) {
        $sql = "SELECT * FROM response WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return new BbsResponse(
            $record['id'], $record['thread_id'], $record['comment_number'], $record['comment'],
            $record['name'], $record['mail_address'], $record['write_date']);
    }
}