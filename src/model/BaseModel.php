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
     * @return string 'yyyy-MM-dd'形式で日付を返す
     */
    public function getCreationDate() {
        return $this->creation_date;
    }

    
}