<?php

require_once __DIR__ . '/../config/database.php';

class Database
{
    private static ?PDO $db = null;

    public static function connect(): \PDO
    {
        try {
            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
            ];

            if (is_null(self::$db)) {
                self::$db = new PDO('mysql:host=' . DATABASE_HOST . ';dbname=' . DATABASE_NAME . ';charset=utf8', DATABASE_USER, DATABASE_PASSWORD, $options);
            }

            return self::$db;
            
        } catch (\PDOException $e) {
            echo sprintf('La connexion a échoué avec les message %s', $e->getMessage());
            die();
        }
    }
}