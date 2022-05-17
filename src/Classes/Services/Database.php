<?php

namespace CarpeDiem\Classes\Services;

class Database
{
    private \PDO $pdo;
    private static ?Database $instance = null;

    private function __construct()
    {
        $host = 'db';
        $db = 'carsdb';
        $user = 'root';
        $pass = 'password';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        $options = [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new \PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $exception) {
            throw new \PDOException($exception->getMessage(), (int)$exception->getCode());
        }
    }

    public static function getInstance(): Database
    {
        if (!self::$instance)
        {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getConnection(): \PDO
    {
        return $this->pdo;
    }
}