<?php

class BaseView {
    protected $dao;

    /**
     * BaseView constructor.
     * @param $dao
     */
    public function __construct($dao) {
        $this->dao = $dao;
    }

}