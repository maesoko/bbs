<?php


class DbConstant {
    /** ▼▼▼ データベース情報 ▼▼▼ */
    const DSN_PREFIX = "mysql";
    const DB_HOST = 'localhost';
    const DB_NAME = 'db_bbs';
    
    /** ▼▼▼ 接続ユーザー情報 ▼▼▼ */
    const DB_USERNAME = 'maesoko';
    const DB_PASSWORD = 'fuga';

    /**
     * クラス内定数で文字列の結合ができないので、ゲッターで置き換えた。
     * >> const DSN = 'mysql:dbhost=localhost;dbname=' . self::DB_NAME; < これがエラーになる。
     * @return string DSNを文字列で返す
     */
    public static function getDSN() {
        return self::DSN_PREFIX . ':'
            . 'dbhost=' . self::DB_HOST . ';'
            . 'dbname=' . self::DB_NAME;
    }
}

