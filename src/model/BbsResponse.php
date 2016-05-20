<?php
require_once('BaseModel.php');

class BbsResponse extends BaseModel {
    private $thread_id;
    private $comment_number;
    private $comment;
    private $name;
    private $mail_address;

    const DEFAULT_NAME = "名無しさん";

    /**
     * BbsResponse constructor.
     * PDOStatement::fetchAll(PDO::FETCH_CLASS, 'class_name'), PDOStatement::fetchObject('class_name')のO/Rマッピングに
     * 対応するためコンストラクタのパラメータは無しにした。
     */
    public function __construct() {}

    /**
     * BbsResponseクラスのインスタンスを取得
     * @param $thread_id int 書き込むスレッドのID
     * @param $comment_number int レスの番号
     * @param $comment string 書き込む内容
     * @param $name string ハンドルネーム
     * @param $mail_address string Eメールアドレス
     * @return BbsResponse 渡されたパラメータを元にBbsResponseクラスのインスタンス生成して返す
     */
    public static function newInstance($thread_id, $comment_number, $comment, $name, $mail_address) {
        $instance = new BbsResponse();
        $instance->thread_id = $thread_id;
        $instance->comment_number = $comment_number;
        $instance->comment = $comment;
        $instance->name = $name;
        $instance->mail_address = $mail_address;
        
        return $instance;
    }

    /**
     * @return int スレッドID
     */
    public function getThreadId() {
        return $this->thread_id;
    }

    /**
     * @return int レス番号
     */
    public function getCommentNumber() {
        return $this->comment_number;
    }

    /**
     * @return string レスの内容
     */
    public function getComment() {
        return $this->comment;
    }

    /**
     * @return string 名前
     */
    public function getName() {
        return empty($this->name) ? self::DEFAULT_NAME : $this->name;
    }

    /**
     * @return string|null メールアドレス|入力がない場合はnull
     */
    public function getMailAddress() {
        return $this->mail_address;
    }

}