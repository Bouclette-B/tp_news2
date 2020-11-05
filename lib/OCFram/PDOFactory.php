<?php
namespace OCFram;
use \PDO;

class PDOFactory {
    public static function getMySQLConnection() {
        $db = new PDO('mysql:host=localhost;dbname=tp_news2;charset=utf8', 'root', 'root');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
}