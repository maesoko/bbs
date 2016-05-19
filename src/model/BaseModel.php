<?php

class BaseModel {
    protected $id;
    protected $creation_date;

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getCreationDate() {
        return $this->creation_date;
    }

    
}