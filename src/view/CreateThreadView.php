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
    
    public function createThread() {
        $title = $_POST['title'];
        $insertId = $this->dao->insertThreadByTitle($title);

        return "スレッド作成: " . $insertId;
    }
    
}