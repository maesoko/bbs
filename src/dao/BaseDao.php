<?php
require_once('../constants/DbConstant.php');

class BaseDao {
    protected $pdo;

    /**
     * BaseDao constructor.
     */
    public function __construct() {
        try {
            self::connect();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function __destruct() {
        $this->disconnect();
    }

    private function connect() {
        $this->pdo = new PDO(DbConstant::getDSN(), DbConstant::DB_USERNAME, DbConstant::DB_PASSWORD);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    private function disconnect() {
        $this->pdo = null;
    }

}