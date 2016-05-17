<?php
require_once('BaseView.php');
require_once(dirname(__FILE__) . './../dao/BbsThreadDao.php');

class CreateThreadView extends BaseView {

    /**
     * CreateThreadView constructor.
     */
    public function __construct() {
        parent::__construct(new BbsThreadDao());
    }
    
    //TODO:一つの関数に複数の処理が集中しすぎているので、daoを分けて処理する
    public function createThread($params) {
        $thread = $this->dao->createThread($params);
        return "スレッド作成:" . $thread->getThreadId();
    }
    
}