<?php

namespace App\Core;

use Config\Database as DbConfig;

class Database {
    private static ?\PDO $pdo = null;

    public static function getConnection(): \PDO {
        if (self::$pdo === null) {
            $config = DbConfig::getConfig();
            $dsn = "mysql:host={$config['host']};dbname={$config['name']}";
            
            self::$pdo = new \PDO($dsn, $config['user'], $config['pass'], [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]);
        }
        return self::$pdo;
    }
    
}