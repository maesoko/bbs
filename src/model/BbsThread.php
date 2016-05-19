<?php
require_once('BaseModel.php');

class BbsThread extends BaseModel {
    protected $title;

    /**
     * BbsThread constructor.
     * O/Rマッピングに対応するためコンストラクタにはパラメータ設定しないように。
     */
    public function __construct() {}

    /**
     * @return string スレッドのタイトルを返す。
     */
    public function getTitle() {
        return $this->title;
    }

}