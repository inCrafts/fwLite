<?php


namespace vendor\core;


class Db {

    protected $pdo;

    protected static $instance;

    public static $countSql = 0;
    public static $queries = [];

    protected function __construct() {

        $db = require ROOT . '/config/config_db.php';
        require_once LIBS . '/rb.php';
        \R::setup($db['dsn'], $db['user'], $db['pass']);
//        \R::freeze(true);
//        \R::fancyDebug(true);
//        $options = [
//            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
//            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
//        ];
//        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass'], $options);
    }

    public static function instance() {

        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

//    public function execute($sql, $params = []) {
//        self::$countSql++;
//        self::$queries[] = $sql;
//        $stmt = $this->pdo->prepare($sql);
//        return $stmt->execute($params);
//    }
//
//    public function query($sql, $params = []) {
//        self::$countSql++;
//        self::$queries[] = $sql;
//        $stmt = $this->pdo->prepare($sql);
//        $res= $stmt->execute($params);
//        if($res !== false) {
//            return $stmt->fetchAll();
//        }
//        return [];
//    }
}