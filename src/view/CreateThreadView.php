<?php
require_once('BaseView.php');
require_once(dirname(__FILE__) . './../dao/BbsThreadDao.php');
require_once(dirname(__FILE__) . './../model/BbsResponse.php');
require_once(dirname(__FILE__) . './../dao/BbsResponseDao.php');

class CreateThreadView extends BaseView {

    /**
     * CreateThreadView constructor.
     */
    public function __construct() {
        parent::__construct(new BbsThreadDao());
    }
    
    public function createThread($params) {
        $thread = $this->dao->createThread($params);
        return "スレッド作成:" . $thread->getThreadId();
    }
    
}